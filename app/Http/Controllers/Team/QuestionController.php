<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\QuestionRequest;
use Services\Quiz\QuizService;
use Services\Quiz\QuestionService;

class QuestionController extends Controller
{
    protected $quiz;
    protected $question;

    /**
     * Construct
     * @param QuizService  $quiz  Service quiz layer
     */
    public function __construct(QuizService $quiz, QuestionService $question)
    {
        $this->quiz     = $quiz;
        $this->question = $question;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($quiz)
    {
        $quiz = $this->quiz->findWithTeam($quiz);

        return view('team.questions.create', compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Team\QuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request, $quiz)
    {
        $this->question->createWithTeam($request, $quiz);

        return redirect()->route('team.quizzes.edit', $quiz)->with([
            'status' => 'success',
            'message' => 'Kuis berhasil disimpan!'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($quiz, $id)
    {
        $question = $this->question->findWithTeam($quiz, $id);
        $quiz = $this->quiz->findWithTeam($quiz);

        return view('team.questions.edit', compact('quiz', 'question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Team\QuestionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, $quiz, $id)
    {
        $this->question->updateWithTeam($request, $quiz, $id);

        return redirect()->route('team.quizzes.edit', $quiz)->with([
            'status' => 'success',
            'message' => 'Kuis berhasil diupdate!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($quiz, $id)
    {   
        $this->question->deleteWithTeam($quiz, $id);

        return redirect()->route('team.quizzes.edit', $quiz)->with([
            'status' => 'success',
            'message' => 'Pertanyaan berhasil dihapus!'
        ]);
    }
}
