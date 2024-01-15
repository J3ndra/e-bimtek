<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use Services\Course\CourseService;
use Services\Quiz\ScoreService;
use Services\UserService;

class UserController extends Controller
{
    protected $user;
    protected $courses;
    protected $score;

    /**
     * Construct
     * @param UserService  $user  Service user layer
     */
    public function __construct(UserService $user, CourseService $courses, ScoreService $score)
    {
        $this->user = $user;
        $this->courses = $courses;
        $this->score = $score;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->verified();

        // dd($users[0]->paided);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->user->create($request);

        return redirect()->route('admin.users.index')->with([
            'status' => 'success',
            'message' => 'Data user berhasil ditambahkan!'
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
        $user = $this->user->find($id);
        $paided = $user->paided;

        return view('admin.users.show', compact('user', 'paided'));
    }

    /**
     * Display the score data resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function score($id)
    {
        $score = $this->score->allByCourse($id);

        return $score;
    }

    public function detail($id)
    {
        $score = $this->score->findOrFail($id);
        $question_count = count($score->quiz->questions);
        return view('admin.users.scoreDetail', compact('score', 'question_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $this->user->update($request, $id);

        return redirect()->route('admin.users.index')->with([
            'status' => 'success',
            'message' => 'Data user berhasil diupdate!'
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
        $this->user->delete($id);

        return back()->with([
            'status' => 'success',
            'message' => 'Data user berhasil dihapus!'
        ]);
    }
}
