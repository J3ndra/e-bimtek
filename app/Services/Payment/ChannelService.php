<?php

namespace Services\Payment;

use App\Models\Channel;
use Services\Payment\TripayService;

class ChannelService
{
    protected $tripay;

    public function __construct(TripayService $tripay)
    {
        $this->tripay = $tripay;
    }

    public function model()
    {
        return new Channel;
    }

    public function sync()
    {
        $channels = $this->tripay->channel();

        if ($channels) {
            foreach ($channels as $channel) {
                $this->model()->updateOrCreate([
                    'code' => $channel['code'],
                ], [
                    'name'         => $channel['name'],
                    'group'        => $channel['group'],
                    'fee_flat'     => $channel['fee']['flat'],
                    'fee_percent'  => $channel['fee']['percent'],
                    'deactived_at' => $channel['active'] == true ? NULL : now()
                ]);
            }
        }

        $this->model()->updateOrCreate([
            'code' => 'MANUAL',
        ], [
            'name'         => 'Transfer Manual',
            'group'        => 'Bank Tranfer',
            'fee_flat'     => 0,
            'fee_percent'  => 0,
            'deactived_at' => NULL
        ]);

        return true;
    }

    public function all()
    {
        return $this->model()->get();
    }

    public function active()
    {
        return $this->model()->whereNull('deactived_at')->get();
    }

    public function paginate($int = 10)
    {
        return $this->model()->paginate($int);
    }

    public function find($id)
    {
        return $this->model()->find($id);
    }

    public function findByCode($code)
    {
        return $this->model()->whereCode($code)->first();
    }

    public function update($request, $id)
    {
        return $this->find($id)->update([
            'name' => $request->name,
            'deactived_at' => $request->status == NULL ? now() : NULL,
        ]);
    }
}
