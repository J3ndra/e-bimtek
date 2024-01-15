<?php

namespace Services\Payment;

use App\Models\Payment;
use Services\Course\CourseService;
use Services\Payment\TripayService;
use Services\Payment\ChannelService;
use Services\UserService;
use Services\WhatsappService;

class PaymentService
{
    protected $course;
    protected $tripay;
    protected $user;
    protected $channel;
    protected $wa;

    public function __construct(CourseService $course, TripayService $tripay, UserService $user, ChannelService $channel, WhatsappService $wa)
    {
        $this->course = $course;
        $this->tripay = $tripay;
        $this->user = $user;
        $this->channel = $channel;
        $this->wa = $wa;
    }

    public function model()
    {
        return Payment::with('user', 'course', 'channel');
    }

    public function all()
    {
        return $this->model()->get();
    }

    public function paginate($amount = 10)
    {
        return $this->model()->latest()->paginate($amount);
    }

    public function data($type = null, $paginate = 10)
    {
        if (is_null($type)) {
            $data = $this->paginate($paginate);
        } else {
            $data = $this->model()->where('approval_status', $type)->paginate($paginate);
        }

        return $data;
    }

    public function find($id)
    {
        return $this->model()->find($id);
    }

    public function create($request = [])
    {
        return $this->model()->create($request);
    }

    public function pay($course, $method)
    {
        $user    = $this->user->auth();
        $course  = $this->course->find($course);
        $channel = $this->channel->findByCode($method);

        $check = $this->model()->where([
            'user_id'    => $user->id,
            'course_id'  => $course->id,
            'channel_id' => $channel->id
        ])->first();

        if ($check) {

            return $check->code;

        }else{
            $payment = $this->create([
                'user_id'         => $user->id,
                'course_id'       => $course->id,
                'amount_received' => $course->price,
                'channel_id'      => $channel->id,
                'approval_at'     => now()->format('Y-m-d H:i:s')
            ]);

            if ($channel->code == 'MANUAL') {
                $this->find($payment->id)->update([
                    'amount'    => $course->price,
                ]);

                $this->wa->send($user->telp, 'Silahkan membayar tagihan *' . $payment->code . '*. Upload bukti transfernya disini. Detail: ' . route('payment.detail', $payment->code));
            }else{
                $request = $this->tripay->request([
                    'merchant_ref'   => $payment->code,
                    'method'         => $method,
                    'amount'         => $course->price,
                    'customer_name'  => $user->name,
                    'customer_email' => $user->email,
                    'order_items'    => [
                        [
                            'sku'      => $course->slug,
                            'name'     => $course->title,
                            'price'    => $course->price,
                            'quantity' => 1,
                            'subtotal' => $course->price,
                        ],
                    ],
                ]);

                $this->find($payment->id)->update([
                    'reference' => $request['reference'],
                    'amount'    => $request['amount'],
                ]);

                $this->wa->send($user->telp, 'Silahkan membayar tagihan *' . $payment->code . '*. Detail: ' . route('payment.detail', $payment->code));
            }

            return $payment->code;
        }
    }

    public function approve($id)
    {
        $payment = $this->find($id);

        $this->model()->whereNotIn('id', [$payment->id])
        ->where([
            'user_id' => $payment->user_id,
            'course_id' => $payment->course_id
        ])->delete();

        $this->wa->send($payment->user->telp, 'Tagihan dengan kode *' . $payment->code . '* berhasil dibayar. Terimakasih.');

        return $this->find($id)->update(['approval_status' => 1, 'approval_at' => now()]);
    }

    public function reject($id)
    {
        return $this->find($id)->update(['approval_status' => 2, 'approval_at' => now()]);
    }

    public function findByCode($code)
    {
        return $this->model()->whereCode($code)
        ->where('approval_status', 0)
        ->firstOrFail();
    }

    public function detail($id)
    {
        $payment = $this->find($id);

        return $payment->channel->code == 'MANUAL' ? NULL : $this->tripay->detail($payment->reference);
    }

    public function expired()
    {
        $data = $this->model()->where('approval_status', 0)
        ->whereDate('approval_at', '<=', now()->subDays()->format('Y-m-d H:i:s'))
        ->get();

        foreach ($data as $row) {
            $this->find($id)->update(['approval_status' => 2, 'approval_at' => now()]);
        }

        return true;
    }

    public function callback($code)
    {
        $data = $this->model()->whereCode($code)
        ->where('approval_status', 0)
        ->first();

        if ($data) {
            $this->approve($data->id);
        }

        return true;
    }

    public function isPaided($course)
    {
        return $this->model()->where([
            'user_id'         => auth('web')->id(), 
            'course_id'       => $course, 
            'approval_status' => 1])
        ->count();
    }
}
