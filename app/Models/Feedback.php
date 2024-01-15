<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'feedback', 'stars', 'course_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
}
