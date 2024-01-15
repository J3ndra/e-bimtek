<?php

namespace Services\Quiz;

use App\Models\Answer;

class AnswerService
{
    public function model()
    {
        return Answer::with('user', 'quiz', 'question');
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

    public function create($quiz, $question)
    {
        return $this->model()->create([
            'user_id'     => auth('web')->id(),
            'quiz_id'     => $quiz,
            'question_id' => $question,
        ]);
    }

    public function findQuestionWithUser($id)
    {
        return $this->model()->where(['user_id' => auth('web')->id(), 'id' => $id])->firstOrFail();
    }

    public function firstQuestion($quiz)
    {
        return $this->model()
            ->where(['user_id' => auth('web')->id(), 'quiz_id' => $quiz])
            ->whereNull('score_id')
            ->first();
    }

    public function allByQuiz($quiz)
    {
        return $this->model()
            ->where(['user_id' => auth('web')->id(), 'quiz_id' => $quiz])
            ->whereNull('score_id')
            ->get();
    }

    public function set($answer, $id)
    {
        return $this->findQuestionWithUser($id)->update(['answer' => $answer]);
    }

    public function next($quiz, $id)
    {
        return $this->model()
            ->where(['user_id' => auth('web')->id(), 'quiz_id' => $quiz])
            ->where('id', '>', $id)
            ->min('id');
    }

    public function previous($quiz, $id)
    {
        return $this->model()
            ->where(['user_id' => auth('web')->id(), 'quiz_id' => $quiz])
            ->where('id', '<', $id)
            ->max('id');
    }

    public function isThere($quiz)
    {
        $answers = $this->model()
            ->where(['quiz_id' => $quiz, 'user_id' => auth('web')->id()])
            ->whereNull('score_id')
            ->count();

        // dd($answers);

        if ($answers > 0) {
            return true;
        } else {
            return false;
        }
    }
}
