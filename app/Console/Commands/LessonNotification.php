<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Facades\Services\StatisticService;
use Facades\Services\WhatsappService;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;

class LessonNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:lesson';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'notification Lessons Today';

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
        $data = StatisticService::usersLessonToday();

        foreach ($data as $row) {
            $user = User::find($row['user_id']);
            $course = Course::find($row['course_id']);
            $lesson = Lesson::where('course_id', $course->id)->whereDate('date', now()->format('Y-m-d'))->first();

            WhatsappService::send($user->telp, 'Akan ada pembelajaran *' . $course->title . '* mengenai *' . $lesson->title . '* hari ini, silahkan cek: ' . route('course', $course->slug));
        }

        return true;
    }
}
