<?php

namespace Services\Course;

use App\Models\Lesson;
use Services\Course\CourseService;
use Services\FileService;
use Carbon\Carbon;
use App\Models\User;

class LessonService
{
    protected $course;
    protected $file;

    public function __construct(CourseService $course, FileService $file)
    {
        $this->course = $course;
        $this->file = $file;
    }

    public function model()
    {
        return Lesson::with('course');
    }

    public function find($id)
    {
        return $this->model()->find($id);
    }

    public function findWithCourse($course, $id)
    {
        return $this->model()->where(['course_id' => $course, 'id' => $id])->firstOrFail();
    }

    public function findWithTeam($course, $id)
    {
        $course = $this->course->findWithTeam($course);

        return $this->model()->where([
            'course_id' => $course->id,
            'id' => $id
        ])->firstOrFail();
    }

    public function findWithSlug($course, $id)
    {
        $course = $this->course->findBySlug($course);

        return $this->model()->where([
            'course_id' => $course->id,
            'id' => $id
        ])->firstOrFail();
    }

    public function create($request, $course)
    {
        return $this->model()->create([
            'title'       => $request->title,
            'description' => $this->file->editor($request->description),
            'date'        => Carbon::parse($request->date)->format('Y-m-d'),
            'course_id'   => $course
        ]);
    }

    public function createWithTeam($request, $course)
    {
        $course = $this->course->findWithTeam($course);

        return $course->lessons()->create([
            'title'       => $request->title,
            'description' => $this->file->editor($request->description),
            'date'        => Carbon::parse($request->date)->format('Y-m-d'),
        ]);
    }

    public function update($request, $course, $id)
    {
        $lesson = $this->findWithCourse($course, $id);

        $lesson->update([
            'title'       => $request->title,
            'description' => $this->file->editor($request->description),
            'date'        => Carbon::parse($request->date)->format('Y-m-d'),
        ]);

        return $this->find($id);
    }

    public function updateWithTeam($request, $course, $id)
    {
        $lesson = $this->findWithTeam($course, $id);

        $lesson->update([
            'title'       => $request->title,
            'description' => $this->file->editor($request->description),
            'date'        => Carbon::parse($request->date)->format('Y-m-d'),
        ]);
    }

    public function delete($course, $id)
    {
        $lesson = $this->findWithTeam($course, $id);

        return $lesson->delete();
    }

    public function deleteWithTeam($course, $id)
    {
        $lesson = $this->findWithTeam($course, $id);
        
        return $lesson->delete();
    }

    public function init()
    {
        return $this->model()->insert([
            [
                'title'       => 'Pengenalan',
                'description' => 'Laravel adalah kerangka kerja aplikasi web berbasis PHP yang sumber terbuka, menggunakan konsep Model-View-Controller. Laravel berada dibawah lisensi MIT, dengan menggunakan GitHub sebagai tempat berbagi kode.',
                'date'        => now()->addDays(1)->format('Y-m-d'),
                'course_id'   => 1
            ],
            [
                'title'       => 'Materi',
                'description' => 'Laravel adalah kerangka kerja aplikasi web berbasis PHP yang sumber terbuka, menggunakan konsep Model-View-Controller. Laravel berada dibawah lisensi MIT, dengan menggunakan GitHub sebagai tempat berbagi kode.',
                'date'        => now()->addDays(2)->format('Y-m-d'),
                'course_id'   => 1
            ],
            [
                'title'       => 'Pengulangan',
                'description' => 'Laravel adalah kerangka kerja aplikasi web berbasis PHP yang sumber terbuka, menggunakan konsep Model-View-Controller. Laravel berada dibawah lisensi MIT, dengan menggunakan GitHub sebagai tempat berbagi kode.',
                'date'        => now()->addDays(3)->format('Y-m-d'),
                'course_id'   => 1
            ],
        ]);
    }
}
