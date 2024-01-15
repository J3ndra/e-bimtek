<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Services\Course\CategoryService;
use Services\Course\CourseService;
use Services\Course\FeedbackService;
use Services\PageService;
use Services\Quiz\ScoreService;

class FrontController extends Controller
{
    protected $category;
    protected $course;
    protected $feedback;
    protected $page;
    protected $score;

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
        ScoreService $score
    ) {
        $this->category = $category;
        $this->course   = $course;
        $this->feedback = $feedback;
        $this->page     = $page;
        $this->score     = $score;
    }

    public function home()
    {
        $sliders = Slider::get();
        $latestCourse = $this->course->latest();
        $courses = $this->course->take(4);
        $categories = $this->category->all();
        $feedback = $this->feedback->take();

        return view('user.home', compact('sliders', 'latestCourse', 'courses', 'categories', 'feedback'));
    }

    public function dashboard()
    {
        $courses = $this->course->paided();
        $finished = $this->course->finished();
        $scores = $this->score->allByUser(auth('web')->id());

        return view('user.dashboard', compact('courses', 'finished', 'scores'));
    }

    public function page($slug)
    {
        $page = $this->page->findBySlug($slug);

        return view('user.page', compact('page'));
    }

    public function category($name)
    {
        $courses = $this->course->allByCategory($name);

        return view('user.category', compact('courses'));
    }
}
