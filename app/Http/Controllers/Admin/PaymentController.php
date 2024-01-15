<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Services\Payment\PaymentService;

class PaymentController extends Controller
{
    protected $payment;

    public function __construct(PaymentService $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type = null)
    {
        $payments = $this->payment->data($type);

        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = $this->payment->find($id);

        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        $this->payment->approve($id);

        return back()->with([
            'status' => 'success',
            'message' => 'Pembayaran berhasil diterima'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject($id)
    {
        $this->payment->reject($id);

        return back()->with([
            'status' => 'success',
            'message' => 'Pembayaran berhasil ditolak'
        ]);
    }
}
