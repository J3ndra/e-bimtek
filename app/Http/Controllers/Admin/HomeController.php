<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\StatisticService;

class HomeController extends Controller
{
	protected $statistic;

    /**
     * Construct
     * @param StatisticService  $statistic  Service statistic layer
     */
    public function __construct(StatisticService $statistic)
    {
        $this->statistic = $statistic;
    }

    public function index()
    {
    	$users = $this->statistic->user();
    	$courses = $this->statistic->courses();
    	$latestPayments = $this->statistic->latestPayments();

        return view('admin.home', compact('users', 'courses', 'latestPayments'));
    }

    public function redirect()
    {
        return redirect()->route('admin.home');
    }
}
