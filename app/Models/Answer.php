<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'answer', 'user_id', 'quiz_id', 'score_id', 'question_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz');
    }

    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }
}
