<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\CourseRequest;
use Services\Course\CourseService;
use Services\Course\CategoryService;

class CourseController extends Controller
{
    protected $course;
    protected $category;

    /**
     * Construct
     * @param CourseService  $course  Service course layer
     * @param CategoryService  $category  Service category layer
     */
    public function __construct(CourseService $course, CategoryService $category)
    {
        $this->course = $course;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->course->allByTeam();

        return view('team.courses.index', compact('courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = $this->course->findWithTeam($id);
        $categories = $this->category->all();

        return view('team.courses.edit', compact('course', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Team\CourseRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        $this->course->updateWithTeam($request, $id);
        $this->course->isDraft($request->isDraft, $id);

        return redirect()->route('team.courses.index')->with([
            'status' => 'success',
            'message' => 'Data course berhasil diupdate!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->course->delete($id);

        return back()->with([
            'status' => 'success',
            'message' => 'Data course berhasil dihapus!'
        ]);
    }
}
