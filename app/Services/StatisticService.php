<?php

namespace Services;

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Payment;
use App\Models\Feedback;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class StatisticService
{
    public function user()
    {
        return User::count();
    }

    public function courses()
    {
        return Course::count();
    }

    public function earnings()
    {
        return $this->num(Payment::where(['approval_status' => 1])->sum('amount_received'));
    }

    public function sales()
    {
        return Payment::where(['approval_status' => 1])->count();
    }

    public function latestPayments()
    {
        return Payment::with('user', 'course')
        ->where(['approval_status' => 1])
        ->latest()
        ->limit(3)
        ->get();
    }

    public function averageStar($course)
    {
        return Feedback::where([
            'course_id' => $course,
        ])->average('stars');
    }

    public function report($dateRange)
    {
        if (is_null($dateRange)) {
            $start = Carbon::now()->startOfMonth()->format('Y-m-d');
            $end   = Carbon::now()->endOfMonth()->format('Y-m-d');
        }else{
            $date  = explode(' to ', $dateRange);
            $start = Carbon::parse($date[0])->format('Y-m-d');
            $end   = Carbon::parse($date[1])->format('Y-m-d');
        }

        $period = CarbonPeriod::create($start, $end);
        $labels = [];
        $income = [];

        foreach ($period as $date) {
            $labels[] = $date->format('d-m-y');
            $income[] = Payment::where(['approval_status' => 1])
            ->whereDate('created_at', $date->format('Y-m-d'))
            ->sum('amount_received');
        }

        $data['chart'] = app()->chartjs
        ->name('income')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels($labels)
        ->datasets([
            [
                "label"                     => "Penghasilan",
                'backgroundColor'           => "rgba(38, 185, 154, 0.31)",
                'borderColor'               => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor"          => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor"      => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor"     => "rgba(220,220,220,1)",
                'data'                      => $income,
            ],
        ])
        ->options([]);

        $start .= ' 00:00:00';
        $end   .= ' 23:59:59';

        $data['customer'] = User::whereNotNull('email_verified_at')
        ->whereBetween('created_at', [$start, $end])
        ->count();

        $data['sold'] = Payment::where(['approval_status' => 1])
        ->whereBetween('created_at', [$start, $end])
        ->count();

        $data['income'] = $this->num(Payment::where(['approval_status' => 1])
            ->whereBetween('created_at', [$start, $end])
            ->sum('amount_received'));

        return $data;
    }

    public function num($num) 
    {
        if($num>1000) {

            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('k', 'm', 'b', 't');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];

            return $x_display;

        }

        return $num;
    }

    public function courseByTeam()
    {
        $data = Course::where('team_id', auth('team')->id())->get();

        $labels = [];
        $income = [];
        foreach ($data as $key => $row) {
            $labels[] = $row->title;
            $income[] = $row->income;
        }

        return app()->chartjs
        ->name('income')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels($labels)
        ->datasets([
            [
                "label"                     => "Penghasilan",
                'backgroundColor'           => "rgba(38, 185, 154, 0.31)",
                'borderColor'               => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor"          => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor"      => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor"     => "rgba(220,220,220,1)",
                'data'                      => $income,
            ],
        ])
        ->options([]);
    }

    public function usersLessonToday()
    {
        $lessons = Lesson::with('course')->whereDate('date', now()->format('Y-m-d'))->get();
        
        $courses = [];
        foreach ($lessons as $lesson) {
            $courses[] = $lesson->course->id;
        }

        $data = Payment::whereIn('course_id', $courses)
        ->where('approval_status', 1)
        ->select('user_id', 'course_id')
        ->get()
        ->toArray();

        return $data;
    }
}
