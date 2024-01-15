<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubLessonRequest;
use Services\Course\CourseService;
use Services\Course\LessonService;
use Services\Course\SubLessonService;

class SubLessonController extends Controller
{
    protected $course;
    protected $lesson;
    protected $subLesson;

    /**
     * Construct
     * @param SubLessonService  $subLesson  Service subLesson layer
     */
    public function __construct(CourseService $course, LessonService $lesson, SubLessonService $subLesson)
    {
        $this->course = $course;
        $this->lesson = $lesson;
        $this->subLesson = $subLesson;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($course, $lesson)
    {
        $lesson = $this->lesson->findWithCourse($course, $lesson);
        $course = $this->course->find($course);

        return view('admin.sublessons.create', compact('course', 'lesson'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\SubLessonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubLessonRequest $request, $course, $lesson)
    {
        $subLesson = $this->subLesson->create($request, $course, $lesson);

        return redirect()->route('admin.courses.edit', $course)->with([
            'status' => 'success',
            'message' => 'Sub pembelajaran berhasil disimpan!'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($course, $lesson, $id)
    {
        $subLesson = $this->subLesson->findWithLesson($course, $lesson, $id);

        return view('admin.sublessons.edit', compact('subLesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\SubLessonRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubLessonRequest $request, $course, $lesson, $id)
    {
        $this->subLesson->update($request, $course, $lesson, $id);

        return redirect()->route('admin.courses.edit', $course)->with([
            'status' => 'success',
            'message' => 'Sub pembelajaran berhasil diupdate!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($course, $lesson, $id)
    {
        $this->subLesson->delete($course, $lesson, $id);

        return redirect()->route('admin.courses.edit', $course)->with([
            'status' => 'success',
            'message' => 'Sub pembelajaran berhasil dihapus!'
        ]);
    }
}
