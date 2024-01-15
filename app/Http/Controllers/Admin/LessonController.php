<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LessonRequest;
use Services\Course\CourseService;
use Services\Course\LessonService;
use App\Models\Lesson;

class LessonController extends Controller
{
    protected $course;
    protected $lesson;

    /**
     * Construct
     * @param LessonService  $lesson  Service lesson layer
     */
    public function __construct(CourseService $course, LessonService $lesson)
    {
        $this->course = $course;
        $this->lesson = $lesson;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($course)
    {
        $course = $this->course->find($course);

        return view('admin.lessons.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\LessonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonRequest $request, $course)
    {
        $lesson = $this->lesson->create($request, $course);

        return redirect()->route('admin.courses.edit', $lesson->course->id)->with([
            'status' => 'success',
            'message' => 'Pembelajaran berhasil ditambahkan!'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($course, $id)
    {
        $lesson = $this->lesson->findWithCourse($course, $id);

        return view('admin.lessons.edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\LessonRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LessonRequest $request, $course, $id)
    {
        $lesson = $this->lesson->update($request, $course, $id);

        return redirect()->route('admin.courses.edit', $course)->with([
            'status' => 'success',
            'message' => 'Pembelajaran berhasil diupdate!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($course, $id)
    {
        $lesson = $this->lesson->find($id);
        if ($lesson->course_id == $course) {
            $lesson->delete();
            $message = 'Pembelajaran berhasil dihapus!';
        }else{
            $message = 'Pembelajaran gagal dihapus!';
        }
        
        return redirect()->route('admin.courses.edit', $course)->with([
            'status' => 'success',
            'message' => $message
        ]);
    }
}
