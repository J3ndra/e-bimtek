<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Facades\Services\PaymentService as Payment;

class ExpiredPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check expired payment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Payment::expired();
    }
}
