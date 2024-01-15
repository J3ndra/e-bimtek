<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubLesson extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lesson_id', 'title', 'description', 'duration', 'video', 'pdf'
    ];

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson');
    }

    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz');
    }
}
