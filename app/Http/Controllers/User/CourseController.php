<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\FeedbackRequest;
use Illuminate\Support\Facades\Auth;
use Services\Payment\ChannelService;
use Services\Course\CourseService;
use Services\Quiz\QuizService;
use Services\Quiz\ScoreService;
use Services\Payment\PaymentService;
use Services\Course\FeedbackService;
use Services\Course\SubLessonService;
use Services\Quiz\CertificateService;
use PDF;

class CourseController extends Controller
{
    protected $channel;
    protected $course;
    protected $quiz;
    protected $payment;
    protected $feedback;
    protected $subLesson;
    protected $certificate;

    /**
     * Construct
     * @param ChannelService  $channel  Channel service layer
     * @param CourseService  $course  Course service layer
     * @param QuizService  $quiz  Quiz service layer
     * @param ScoreService  $score  Score service layer
     * @param PaymentService  $payment  Payment service layer
     * @param FeedbackService  $feedback  Feedback service layer
     * @param SubLessonService  $feedback  SubLesson service layer
     * @param CertificateService  $feedback  Certificate service layer
     */
    public function __construct(ChannelService $channel, CourseService $course, QuizService $quiz, ScoreService $score, PaymentService $payment, FeedbackService $feedback, SubLessonService $subLesson, CertificateService $certificate)
    {
        $this->channel   = $channel;
        $this->course    = $course;
        $this->quiz      = $quiz;
        $this->score     = $score;
        $this->payment   = $payment;
        $this->feedback  = $feedback;
        $this->subLesson = $subLesson;
        $this->certificate = $certificate;
    }

    public function courses()
    {
        $courses = $this->course->published(9);

        return view('user.course.list', compact('courses'));
    }

    public function course($slug)
    {
        $course = $this->course->findBySlug($slug);
        $channels = $this->channel->active();
        $preQuiz = $this->quiz->isStartQuiz($course->id);
        $postQuiz = $this->quiz->isStartQuiz($course->id, 'Post Test');
        $feedback = $this->feedback->byUser($course->id);

        return view('user.course.detail', compact('course', 'channels', 'preQuiz', 'postQuiz', 'feedback'));
    }

    public function pay($course, $method)
    {
        $code = $this->payment->pay($course, $method);

        return redirect()->route('payment.detail', $code);
    }

    public function paymentDetail($code)
    {
        $payment = $this->payment->findByCode($code);
        $tripay = $this->payment->detail($payment->id);

        return view('user.course.payment', compact('payment', 'tripay'));
    }

    public function subLesson($course, $lesson, $subLesson)
    {
        $isPaided = isSold($this->course->findBySlug($course)->id);
        $isCanAccess = $this->subLesson->isCanAccess($subLesson);

        if ($isPaided && $isCanAccess) {
            $subLesson = $this->subLesson->findWithSlug($course, $lesson, $subLesson);
            $subLessons = $this->subLesson->allByLesson($lesson);

            return view('user.course.sublesson', compact('subLesson', 'subLessons'));
        } else {
            abort(404);
        }
    }

    public function feedback(FeedbackRequest $request, $course)
    {
        $this->feedback->course($request, $course);

        return back()->with([
            'status' => 'success',
            'message' => 'Feedback Berhasil Diberikan!'
        ]);
    }

    public function certificate($slug)
    {
        $course = $this->course->findBySlug($slug);
        if ($course->design_id == 0) {
            return back()->with([
                'status' => 'danger',
                'message' => 'Kursus tidak memiliki sertifikat.'
            ]);
        }
        $design = $this->certificate->design()->find($course->design_id);
        $certificate = $this->certificate->download($course->id);

        $data['data'] = $design;
        $data['user'] = Auth::user();
        $data['course'] = $course;

        $pdf = PDF::loadView('admin.designs.templatesertif', $data);
        $file_name = Auth::user()->name . ' - ' . $course->title . '.pdf';
        return $pdf->download($file_name);
    }
}
