<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Course\CategoryService;
use Services\Course\CourseService;
use Services\Course\FeedbackService;
use Services\PageService;
use Services\Quiz\CertificateService;
use Services\Quiz\ScoreService;

class CertificateController extends Controller
{
    protected $category;
    protected $course;
    protected $feedback;
    protected $page;
    protected $score;
    protected $certificate;

    /**
     * Construct
     * @param CategoryService  $category  Category service layer
     * @param CourseService  $course  Course service layer
     * @param FeedbackService  $feedback  Feedback service layer
     * @param PageService  $page  Page service layer
     * @param ScoreService  $score  Score service layer
     */
    public function __construct(
        CategoryService $category,
        CourseService $course,
        FeedbackService $feedback,
        PageService $page,
        ScoreService $score,
        CertificateService $certificate
    ) {
        $this->category = $category;
        $this->course   = $course;
        $this->feedback = $feedback;
        $this->page     = $page;
        $this->score     = $score;
        $this->certificate     = $certificate;
    }

    public function index()
    {
        $courses = $this->course->paided();
        $finished = $this->course->finished();
        $scores = $this->score->allByUser(auth('web')->id());
        $certificates = $this->certificate->findByUser(auth('web')->id());

        return view('user.certificate', compact('courses', 'finished', 'scores', 'certificates'));
    }
}
