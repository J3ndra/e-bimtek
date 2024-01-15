<?php

namespace Services;

use App\Models\Page;
use Services\FileService;
use Hash;
use Str;

class PageService
{
    protected $file;

    public function __construct(FileService $file)
    {
        $this->file = $file;
    }

    public function model()
    {
        return new Page;
    }

    public function all()
    {
        return $this->model()->get();
    }

    public function paginate($int = 10)
    {
        return $this->model()->paginate($int);
    }

    public function find($id)
    {
        return $this->model()->find($id);
    }

    public function findBySlug($slug)
    {
        return $this->model()->where('slug', $slug)->firstOrFail();
    }

    public function create($request)
    {
        return $this->model()->create([
            'slug'        => Str::slug($request->title, '-'),
            'title'       => $request->title,
            'description' => $this->file->editor($request->description),
        ]);
    }

    public function update($request, $id)
    {
        return $this->find($id)->update([
            'slug'        => Str::slug($request->title, '-'),
            'title'       => $request->title,
            'description' => $this->file->editor($request->description),
        ]);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
