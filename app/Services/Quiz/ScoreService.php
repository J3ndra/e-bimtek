<?php

namespace Services\Quiz;

use App\Models\Score;

class ScoreService
{
    public function model()
    {
        return Score::with('user', 'quiz.course');
    }

    public function all()
    {
        return $this->model()->get();
    }

    public function allByUser($id)
    {
        return $this->model()->whereUserId($id)->get();
    }

    public function allByCourse($id)
    {
        return $this->model()->whereHas('quiz', function ($q) use ($id) {
            $q->where('course_id', $id);
        })->get();
    }

    public function find($id)
    {
        return $this->model()->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model()->findOrFail($id);
    }

    public function user($score)
    {
        return $this->model()->where(['user_id' => auth('web')->id(), 'id' => $score])->firstOrFail();
    }

    public function create($quiz, $score)
    {
        return $this->model()->create([
            'user_id' => auth('web')->id(),
            'quiz_id' => $quiz,
            'score'   => $score
        ]);
    }

    public function check($quiz, $min)
    {
        return $this->model()
            ->where(['quiz_id' => $quiz, 'user_id' => auth('web')->id()])
            ->where('score', '>=', $min)
            ->first();
    }
}
