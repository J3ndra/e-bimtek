<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QuizRequest;
use Services\Quiz\QuizService;
use Services\Course\CourseService;

class QuizController extends Controller
{
    protected $quiz;
    protected $course;

    public function __construct(QuizService $quiz, CourseService $course)
    {
        $this->quiz = $quiz;
        $this->course = $course;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = $this->quiz->paginate();

        return view('admin.quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = $this->course->all();

        return view('admin.quizzes.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\QuizRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizRequest $request)
    {
        if ($this->quiz->validation($request->course_id, $request->type)){
            return back()->withInput($request->input())->with([
                'status' => 'danger',
                'message' => 'Kuis untuk kursus ini telah dibuat!'
            ]);
        }

        $quiz = $this->quiz->create($request);

        return redirect()->route('admin.quizzes.edit', $quiz->id)->with([
            'status' => 'success',
            'message' => 'Kuis berhasil dibuat!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = $this->quiz->find($id);

        return view('admin.quizzes.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = $this->quiz->find($id);
        $courses = $this->course->all();

        return view('admin.quizzes.edit', compact('quiz', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\QuizRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizRequest $request, $id)
    {
        if ($this->quiz->validation($request->course_id, $request->type, $id)){
            return back()->withInput($request->input())->with([
                'status' => 'danger',
                'message' => 'Kuis untuk kursus ini telah dibuat!'
            ]);
        }

        $this->quiz->update($request, $id);

        return redirect()->route('admin.quizzes.index')->with([
            'status' => 'success',
            'message' => 'Data berhasil diupdate'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->quiz->delete($id);

        return back()->with([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
