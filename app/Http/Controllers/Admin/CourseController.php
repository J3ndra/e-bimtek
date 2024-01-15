<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseRequest;
use App\Models\Category;
use Services\Course\CategoryService;
use Services\Course\CourseService;
use Services\Course\DesignService;
use Services\TeamService;

class CourseController extends Controller
{
    protected $course;
    protected $category;
    protected $team;
    protected $design;

    /**
     * Construct
     * @param CategoryService  $category  Service category layer
     * @param CourseService  $course  Service course layer
     * @param TeamService  $team  Service team layer
     */
    public function __construct(Category $category, CourseService $course, TeamService $team, DesignService $design)
    {
        $this->category = $category;
        $this->course   = $course;
        $this->team     = $team;
        $this->design   = $design;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->course->paginate();

        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->all();
        $teams = $this->team->all();
        $designs = $this->design->all();

        return view('admin.courses.create', compact('categories', 'teams', 'designs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\CourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $course = $this->course->create($request);

        return redirect()->route('admin.courses.edit', $course->id)->with([
            'status' => 'success',
            'message' => 'Data course berhasil ditambahkan!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = $this->course->find($id);

        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = $this->course->find($id);
        $categories = $this->category->all();
        $teams = $this->team->all();
        $designs = $this->design->all();

        return view('admin.courses.edit', compact('course', 'categories', 'teams', 'designs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\CourseRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        $this->course->update($request, $id);
        $this->course->isDraft($request->isDraft, $id);

        return redirect()->route('admin.courses.index')->with([
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

        return redirect()->route('admin.courses.index')->with([
            'status' => 'success',
            'message' => 'Data course berhasil dihapus!'
        ]);
    }
}
