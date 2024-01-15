<?php

namespace Services\Quiz;

use App\Models\Certificate;
use App\Models\Design;
use Services\Course\CourseService;

class CertificateService
{
    protected $course;

    public function __construct(CourseService $course)
    {
        $this->course = $course;
    }

    public function model()
    {
        return Certificate::with('user', 'course');
    }

    public function design()
    {
        return new Design;
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

    public function findByUser($user)
    {
        return $this->model()->where('user_id', $user)->paginate(10);
    }

    public function create($course)
    {
        return $this->model()->create([
            'user_id'    => auth('web')->id(),
            'course_id'  => $course,
            'credential' => uniqid()
        ]);
    }

    public function check($course)
    {
        return $this->model()->where(['user_id' => auth('web')->id(), 'course_id' => $course])->count();
    }

    public function download($course)
    {
        $certificate = $this->check($course);

        if ($certificate) {
            return $certificate;
        } else {
            $hasPostTest = $this->course->hasPostTest($course);

            if (isSold($course)) {
                return $this->create($course);
            } else {
                abort(404);
            }
        }
    }
}
