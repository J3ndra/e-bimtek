<?php

namespace Services\Course;

use App\Models\SubLesson;
use Services\Course\LessonService;
use Services\FileService;
use Carbon\Carbon;

class SubLessonService
{
    protected $lesson;
    protected $file;

    public function __construct(LessonService $lesson, FileService $file)
    {
        $this->lesson = $lesson;
        $this->file = $file;
    }

    public function model()
    {
        return SubLesson::with('lesson');
    }

    public function allByLesson($id)
    {
        return $this->model()->where(['lesson_id' => $id])->get();
    }

    public function find($id)
    {
        return $this->model()->find($id);
    }

    public function findWithLesson($course, $lesson, $id)
    {
        $data = $this->lesson->findWithCourse($course, $lesson);

        return $this->model()->where(['lesson_id' => $data->id, 'id' => $id])->firstOrFail();
    }

    public function findWithTeam($course, $lesson, $id)
    {
        $lesson = $this->lesson->findWithTeam($course, $lesson);

        return $this->model()->where(['lesson_id' => $lesson->id,  'id'=> $id])->firstOrFail();
    }

    public function findWithSlug($course, $lesson, $id)
    {
        $lesson = $this->lesson->findWithSlug($course, $lesson);

        return $this->model()->where(['lesson_id' => $lesson->id,  'id'=> $id])->firstOrFail();
    }

    public function create($request, $course, $lesson)
    {
        $lesson = $this->lesson->findWithCourse($course, $lesson);

        return $lesson->subLessons()->create([
            'title'       => $request->title,
            'description' => $this->file->editor($request->description),
            'duration'    => $request->duration,
            'video'       => $request->video,
            'pdf'         => $this->file->upload($request->file('pdf')),
        ]);
    }

    public function createWithTeam($request, $course, $lesson)
    {
        $lesson = $this->lesson->findWithTeam($course, $lesson);

        return $lesson->subLessons()->create([
            'title'       => $request->title,
            'description' => $this->file->editor($request->description),
            'duration'    => $request->duration,
            'video'       => $request->video,
            'pdf'         => $this->file->upload($request->file('pdf')),
        ]);
    }

    public function update($request, $course, $lesson, $id)
    {
        $subLesson = $this->findWithLesson($course, $lesson, $id);

        return $subLesson->update([
            'title'       => $request->title,
            'description' => $this->file->editor($request->description),
            'duration'    => $request->duration,
            'video'       => $request->video,
            'pdf'         => $request->video ? NULL : $this->file->upload($request->file('pdf'), $subLesson->pdf),
        ]);
    }

    public function updateWithTeam($request, $course, $lesson, $id)
    {
        $subLesson = $this->findWithTeam($course, $lesson, $id);

        return $subLesson->update([
            'title'       => $request->title,
            'description' => $this->file->editor($request->description),
            'duration'    => $request->duration,
            'video'       => $request->video,
            'pdf'         => $request->video ? NULL : $this->file->upload($request->file('pdf'), $subLesson->pdf),
        ]);
    }

    public function delete($course, $lesson, $id)
    {
        return $this->findWithLesson($course, $lesson, $id)->delete();
    }

    public function deleteWithTeam($course, $lesson, $id)
    {
        return $this->findWithTeam($course, $lesson, $id)->delete();
    }

    public function isCanAccess($subLesson)
    {
        return $this->model()->whereHas('lesson', function ($query) {
            return $query->whereDate('date', '<=', now()->format('Y-m-d'));
        })->whereId($subLesson)->count();
    }
}
