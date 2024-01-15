<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\QuizRequest;
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

        return view('team.quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = $this->course->allByTeam();

        return view('team.quizzes.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Team\QuizRequest  $request
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

        $quiz = $this->quiz->createWithTeam($request);

        return redirect()->route('team.quizzes.edit', $quiz->id)->with([
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

        return view('team.quizzes.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = $this->quiz->findWithTeam($id);
        $courses = $this->course->allByTeam();

        return view('team.quizzes.edit', compact('quiz', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Team\QuizRequest  $request
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

        $this->quiz->updateWithTeam($request, $id);

        return redirect()->route('team.quizzes.index')->with([
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
        $this->quiz->deleteWithTeam($id);

        return back()->with([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
