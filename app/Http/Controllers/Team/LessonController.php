<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\LessonRequest;
use Services\Course\CourseService;
use Services\Course\LessonService;

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
        $course = $this->course->findWithTeam($course);

        return view('team.lessons.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Team\LessonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonRequest $request, $course)
    {
        $lesson = $this->lesson->createWithTeam($request, $course);

        return redirect()->route('team.courses.edit', $course)->with([
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
    public function edit($course, $lesson)
    {
        $lesson = $this->lesson->findWithTeam($course, $lesson);

        return view('team.lessons.edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Team\LessonRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LessonRequest $request, $course, $id)
    {
        $lesson = $this->lesson->updateWithTeam($request, $course, $id);

        return redirect()->route('team.courses.edit', $course)->with([
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
        $lesson = $this->lesson->deleteWithTeam($course, $id);

        return redirect()->route('team.courses.edit', $course)->with([
            'status' => 'success',
            'message' => 'Pembelajaran berhasil dihapus!'
        ]);
    }
}
