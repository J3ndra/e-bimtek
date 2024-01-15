<?php

namespace Services\Course;

use App\Models\Course;
use Services\FileService;
use Carbon\Carbon;
use Str;

class CourseService
{
    protected $file;

    public function __construct(FileService $file, CategoryService $category)
    {
        $this->file     = $file;
        $this->category = $category;
    }

    public function model()
    {
        return Course::with('category', 'team', 'payments', 'certificates');
    }

    public function all()
    {
        return $this->model()->get();
    }

    public function published($paginate = 9)
    {
        return $this->model()->whereIsDraft(0)->latest()->paginate($paginate);
    }

    public function find($id)
    {
        return $this->model()->findOrFail($id);
    }

    public function findWithTeam($id)
    {
        return $this->model()->where([
            'team_id' => auth('team')->id(),
            'id' => $id
        ])->firstOrFail();
    }

    public function allByCategory($name)
    {
        $category = $this->category->findByName($name);

        return $this->model()->where('is_draft', 0)->whereCategoryId($category->id)->paginate(9);
    }

    public function latest()
    {
        return $this->model()->latest()->where('is_draft', 0)->first();
    }

    public function take($take = 6)
    {
        return $this->model()
            ->where('is_draft', 0)
            ->latest()
            ->take($take)
            ->get();
    }

    public function paginate($paginate = 10)
    {
        return $this->model()->latest()->paginate($paginate);
    }

    public function allByTeam($id = null)
    {
        if (is_null($id)) {
            $id = auth('team')->id();
        }

        return $this->model()->where('team_id', $id)->latest()->paginate(12);
    }

    public function findBySlug($slug)
    {
        return $this->model()->whereSlug($slug)->whereIsDraft(0)->firstOrFail();
    }

    public function create($request)
    {
        return $this->model()->create([
            'thumbnail'   => $this->file->image($request->file('thumbnail')),
            'slug'        => Str::slug($request->title),
            'title'       => $request->title,
            'description' => $this->file->editor($request->description),
            'start_date'  => daterange($request->date_course, 'start'),
            'end_date'    => daterange($request->date_course, 'end'),
            'trailer'     => $request->trailer,
            'category_id' => $request->category_id,
            'design_id'   => $request->design_id,
            'price'       => $request->price,
            'duration'    => $request->duration,
            'team_id'     => $request->team_id
        ]);
    }

    public function init()
    {
        return $this->model()->create([
            'thumbnail'   => 'public/uploads/images/admin/1/1604039246.png',
            'slug'        => 'laravel',
            'title'       => 'Laravel + VueJs Fullstack',
            'description' => 'Laravel adalah kerangka kerja aplikasi web berbasis PHP yang sumber terbuka, menggunakan konsep Model-View-Controller. Laravel berada dibawah lisensi MIT, dengan menggunakan GitHub sebagai tempat berbagi kode.',
            'trailer'     => 'https://www.youtube.com/embed/eRZFGSCkAnw',
            'duration'    => '2 Jam',
            'start_date'  => now()->format('Y-m-d'),
            'end_date'    => now()->addDays(7)->format('Y-m-d'),
            'price'       => 50000,
            'category_id' => 1,
            'team_id'     => 1,
        ]);
    }

    public function update($request, $id)
    {
        $data = $this->model()->find($id);

        return $data->update([
            'thumbnail'   => $this->file->image($request->file('thumbnail'), $data->thumbnail),
            'slug'        => Str::slug($request->title),
            'title'       => $request->title,
            'description' => $this->file->editor($request->description),
            'start_date'  => daterange($request->date_course, 'start'),
            'end_date'    => daterange($request->date_course, 'end'),
            'trailer'     => $request->trailer,
            'category_id' => $request->category_id,
            'design_id'   => $request->design_id,
            'price'       => $request->price,
            'duration'    => $request->duration,
            'team_id'     => $request->team_id
        ]);
    }

    public function updateWithTeam($request, $id)
    {
        $data = $this->findWithTeam($id);

        return $data->update([
            'thumbnail'   => $this->file->image($request->file('thumbnail'), $data->thumbnail),
            'slug'        => Str::slug($request->title),
            'title'       => $request->title,
            'description' => $this->file->editor($request->description),
            'start_date'  => daterange($request->date_course, 'start'),
            'end_date'    => daterange($request->date_course, 'end'),
            'trailer'     => $request->trailer,
            'category_id' => $request->category_id,
            'price'       => $request->price,
            'duration'    => $request->duration,
        ]);
    }

    public function isDraft($bool = 1, $id)
    {
        return $this->find($id)->update(['is_draft' => $bool]);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    public function paided()
    {
        return $this->model()->whereHas('payments', function ($query) {
            return $query->where([
                'user_id' => auth('web')->id(),
                'approval_status' => 1
            ]);
        })->get();
    }

    public function finished()
    {
        return $this->model()->whereHas('certificates', function ($query) {
            return $query->where(['user_id' => auth('web')->id()]);
        })->get();
    }

    public function recomended()
    {
        if (auth('web')->check()) {
            $data = $this->model()->whereDoesntHave('payments', function ($query) {
                return $query->where([
                    'user_id'         => auth('web')->id(),
                    'approval_status' => 1
                ]);
            })->limit(5)->whereIsDraft(0)->get();
        } else {
            $data = $this->model()->inRandomOrder()->whereIsDraft(0)->limit(5)->get();
        }

        return $data;
    }

    public function isSold($course)
    {
        return $this->model()->find($course)->whereHas('payments', function ($query) {
            return $query->where([
                'user_id' => auth('web')->id(),
                'approval_status' => 1
            ]);
        })->count();
    }

    public function hasPostTest($course)
    {
        return $this->model()->find($course)->whereHas('quizzes', function ($query) {
            return $query->where([
                'type' => 'Post Test'
            ]);
        })->count();
    }
}
