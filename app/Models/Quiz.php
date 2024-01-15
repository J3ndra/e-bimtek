<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id', 'title', 'type', 'amount', 'min'
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }

    public function scores()
    {
        return $this->hasMany('App\Models\Score');
    }
}
