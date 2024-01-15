<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'date', 'course_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function subLessons()
    {
        return $this->hasMany('App\Models\SubLesson');
    }
}
