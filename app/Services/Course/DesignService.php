<?php

namespace Services\Course;

use App\Models\Design;
use Services\FileService;

class DesignService
{
    protected $file;
    protected $course;

    public function __construct(FileService $file, CourseService $course)
    {
        $this->file = $file;
        $this->course = $course;
    }

    public function model()
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

    public function paginate($amount = 8)
    {
        return $this->model()->paginate($amount);
    }

    public function create($request)
    {
        return $this->model()->create([
            'name' => $request->name,
            'file' => $this->file->image($request->file('file'))
        ]);
    }
    public function update($request, $id)
    {
        return $this->find($id)->update([
            'horizontal'  => $request->horizontal,
            'vertical' => $request->vertical,
            'margin_left' => $request->margin_left,
            'margin_right' => $request->margin_right,
        ]);
    }
    public function delete($id)
    {
        $course = $this->course
            ->model()
            ->whereDesignId($id)
            ->get();

        if (count($course) > 0) {
            return false;
        } else {
            $this->find($id)->delete();
            return true;
        }
    }
}
