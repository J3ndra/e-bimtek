<?php

namespace Services\Course;

use App\Models\Category;
use Services\FileService;

class CategoryService
{
    protected $file;

    public function __construct(FileService $file)
    {
        $this->file = $file;
    }

    public function model()
    {
        return Category::with('courses');
    }

    public function all()
    {
        return $this->model()->get();
    }

    public function paginate($item = 10)
    {
        return $this->model()->paginate($item);
    }

    public function find($id)
    {
        return $this->model()->findOrFail($id);
    }

    public function findByName($name)
    {
        return $this->model()->whereName($name)->firstOrFail();
    }

    public function create($request)
    {
        return $this->model()->create([
            'icon' => $this->file->image($request->file('icon')),
            'name' => $request->name
        ]);
    }

    public function update($request, $id)
    {
        $category = $this->find($id);

        return $category->update([
            'icon' => $this->file->image($request->file('icon'), $category->icon),
            'name' => $request->name,
        ]);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    public function init()
    {
        return $this->model()->insert([
            [
                'icon' => 'public/uploads/images/admin/1/1604039246.png',
                'name' => 'Pemrograman'
            ],
            [
                'icon' => 'public/uploads/images/admin/1/1604039246.png',
                'name' => 'Marketing'
            ],
            [
                'icon' => 'public/uploads/images/admin/1/1604039246.png',
                'name' => 'Memasak'
            ],
        ]);
    }
}
