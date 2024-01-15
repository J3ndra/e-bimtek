<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\StatisticService;
use Carbon\Carbon;

class ReportController extends Controller
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

    public function index(Request $request)
    {
    	$data = $this->statistic->report($request->date_range);

    	return view('admin.report.index', $data);
    }

    public function view($date)
    {
        $data = $this->statistic->report($date);

        $date  = explode(' to ', $date);
        $data['start'] = Carbon::parse($date[0])->format('d-m-Y');
        $data['end']   = Carbon::parse($date[1])->format('d-m-Y');

        return view('admin.report.download', $data);
    }

    public function download($date)
    {
    	$data = $this->statistic->report($date);

        $date  = explode(' to ', $date);
        $data['start'] = Carbon::parse($date[0])->format('d-m-Y');
        $data['end']   = Carbon::parse($date[1])->format('d-m-Y');

        return view('admin.report.download', $data);
    }
}
