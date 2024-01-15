<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use Services\StatisticService;
use Illuminate\Http\Request;

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
    	$chart = $this->statistic->courseByTeam();

        return view('team.home', compact('chart'));
    }

    public function redirect()
    {
        return redirect()->route('team.home');
    }
}
