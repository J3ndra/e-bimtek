<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'score', 'user_id', 'quiz_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz');
    }

    public function answer($question_id)
    {
        return Answer::where([
            'score_id' => $this->id,
            'question_id' => $question_id
        ])->first();
    }
}
