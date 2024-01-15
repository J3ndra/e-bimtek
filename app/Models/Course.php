<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'thumbnail', 'slug', 'title', 'description', 'trailer', 'duration', 'start_date', 'end_date', 'price', 'category_id', 'team_id', 'design_id', 'is_draft'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }

    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }

    public function feedbacks()
    {
        return $this->hasMany('App\Models\Feedback');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function certificates()
    {
        return $this->hasMany('App\Models\Certificate');
    }

    public function quizzes()
    {
        return $this->hasMany('App\Models\Quiz');
    }

    public function getStarsAttribute()
    {
        return round($this->feedbacks()->average('stars'), 1) ?? 0.0;
    }

    public function percentageStar($star)
    {
        $amount = $this->feedbacks()->count();
        $count = $this->feedbacks()->where('stars', $star)->count();

        if ($count == 0) {
            $result = 0;
        } else {
            $result = round($count / $amount * 100, 1);
        }

        return $result;
    }

    public function getStatusAttribute()
    {
        switch ($this->is_draft) {
            case 0:
                return 'Published';
                break;

            default:
                return 'Draft';
                break;
        }
    }

    public function getSoldAttribute()
    {
        return $this->payments()->where('approval_status', 1)->count();
    }

    public function getIncomeAttribute()
    {
        return $this->payments->where('approval_status', 1)->sum('amount');
    }

    public function post_test()
    {
        return $this->belongsTo('App\Models\Quiz', 'id', 'course_id')
            ->where('type', 'Post Test');
    }
}
