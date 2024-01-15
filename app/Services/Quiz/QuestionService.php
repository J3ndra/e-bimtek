<?php

namespace Services\Quiz;

use App\Models\Question;
use Services\FileService;
use Services\Quiz\QuizService;

class QuestionService
{
    protected $file;
    protected $quiz;

    public function __construct(FileService $file, QuizService $quiz)
    {
        $this->file = $file;
        $this->quiz = $quiz;
    }

    public function model()
    {
        return Question::with('quiz');
    }

    public function all()
    {
        return $this->model()->get();
    }

    public function find($id)
    {
        return $this->model()->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model()->findOrFail($id);
    }

    public function findWithQuiz($quiz, $id)
    {
        return $this->model()->where(['quiz_id' => $quiz, 'id' => $id])->firstOrFail();
    }

    public function findWithTeam($quiz, $id)
    {
        $quiz = $this->quiz->findWithTeam($quiz);

        return $this->model()->where(['quiz_id' => $quiz->id, 'id' => $id])->firstOrFail();
    }

    public function create($request, $quiz)
    {
        $quiz = $this->quiz->findOrFail($quiz);

        return $quiz->questions()->create([
            'question' => $this->file->editor($request->question),
            'selection' => json_encode($request->selection),
            'answer' => $request->answer,
        ]);
    }

    public function createWithTeam($request, $quiz)
    {
        $quiz = $this->quiz->findWithTeam($quiz);

        return $quiz->questions()->create([
            'question' => $this->file->editor($request->question),
            'selection' => json_encode($request->selection),
            'answer' => $request->answer,
        ]);
    }

    public function update($request, $quiz, $id)
    {
        $question = $this->findWithQuiz($quiz, $id);

        return $question->update([
            'question' => $this->file->editor($request->question),
            'selection' => json_encode($request->selection),
            'answer' => $request->answer,
        ]);
    }

    public function updateWithTeam($request, $quiz, $id)
    {
        $question = $this->findWithTeam($quiz, $id);

        return $question->update([
            'question' => $this->file->editor($request->question),
            'selection' => json_encode($request->selection),
            'answer' => $request->answer,
        ]);
    }

    public function delete($quiz, $id)
    {
        return $this->findWithQuiz($quiz, $id)->delete();
    }

    public function deleteWithTeam($quiz, $id)
    {
        return $this->findWithTeam($quiz, $id)->delete();
    }
}
