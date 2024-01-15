<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Payment extends Model
{
    use AutoNumberTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'course_id', 'code', 'reference', 'amount', 'approval_status', 'approval_at', 'channel_id', 'amount_received'
    ];

    /**
     * Return the autonumber configuration array for this model.
     *
     * @return array
     */
    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'BTK' . time() . '?',
                'length' => 5
            ]
        ];
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'approval_at' => 'datetime',
    ];

    public function getApprovalAttribute()
    {
        switch ($this->approval_status) {
            case 1:
                return 'Success';
                break;

            case 2:
                return 'Failed';
                break;

            default:
                return 'Pending';
                break;
        }
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function channel()
    {
        return $this->belongsTo('App\Models\Channel');
    }
}
