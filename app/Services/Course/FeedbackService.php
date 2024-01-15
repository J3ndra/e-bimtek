<?php

namespace Services\Course;

use App\Models\Feedback;

class FeedbackService
{

    public function model()
    {
        return Feedback::with('user', 'course');
    }

    public function all()
    {
        return $this->model()->get();
    }

    public function take($take = 3)
    {
        return $this->model()->latest()->get();
    }

    public function create($request)
    {
        return $this->model()->create([
            'user_id' => auth()->id,
            'feedback' => $request->feedback,
            'stars' => $request->stars,
        ]);
    }

    public function course($request, $id)
    {
        $feedback = $this->model()->where([
            'user_id' => auth('web')->id(),
            'course_id' => $id,
        ])->first();

        if ($feedback) {
            return $feedback->update([
                'feedback' => $request->feedback,
                'stars' => $request->stars,
            ]);
        }else{
            return $this->model()->create([
                'user_id' => auth('web')->id(),
                'feedback' => $request->feedback,
                'stars' => $request->stars,
                'course_id' => $id,
            ]);
        }
    }

    public function init()
    {
        return $this->model()->create([
            'user_id' => 1,
            'feedback' => 'Kursus yang diberikan sangat ringkas dan mudah dipahami',
            'stars' => 5,
            'course_id' => 1,
        ]);
    }

    public function byUser($course)
    {
        return $this->model()->where([
            'user_id' => auth('web')->id(),
            'course_id' => $course,
        ])->first();
    }
}
