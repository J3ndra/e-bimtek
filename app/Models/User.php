<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar', 'name', 'email', 'password', 'email_verified_at', 'telp'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getInitialAttribute()
    {
        return ucwords(substr($this->name, 0, 2));
    }

    public function score($type = null)
    {
        if ($type == 'average') {
            return Score::where('user_id', $this->id)->avg('score');
        } else {
            return Score::where('user_id', $this->id)->get();
        }
    }

    public function payment()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function certificates()
    {
        return $this->hasMany('App\Models\Certificate');
    }

    public function paided()
    {
        return $this->hasMany('App\Models\Payment', 'user_id', 'id')
            ->where('approval_status', 1);
    }
}
