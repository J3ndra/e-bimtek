<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Quiz\QuizService;
use Services\Quiz\QuestionService;
use Services\Quiz\AnswerService;
use Services\Quiz\ScoreService;

class QuizController extends Controller
{
    protected $quiz;
    protected $question;
    protected $answer;
    protected $score;

    public function __construct(QuizService $quiz, QuestionService $question, AnswerService $answer, ScoreService $score)
    {
        $this->quiz     = $quiz;
        $this->question = $question;
        $this->answer   = $answer;
        $this->score    = $score;
    }

    public function start($quiz)
    {
        $question =  $this->quiz->start($quiz);

        return redirect()->route('quiz.question', [$quiz, $question->id]);
    }

    public function question($quiz, $id)
    {
        $answer = $this->answer->findQuestionWithUser($id);
        $next     = $this->answer->next($quiz, $id);
        $previous = $this->answer->previous($quiz, $id);

        return view('user.quiz.question', compact('answer', 'next', 'previous'));
    }

    public function answer(Request $request, $quiz, $id)
    {
        $this->answer->set($request->answer, $id);

        return response()->json(true);
    }

    public function finish($id)
    {
        $finish = $this->quiz->finish($id);

        return redirect()->route('quiz.score', $finish->id)->with([
            'status' => 'success',
            'message' => 'Skor Berhasil Ditampilkan'
        ]);
    }

    public function score($id)
    {
        $score = $this->score->user($id);

        return view('user.quiz.score', compact('score'));
    }
}
