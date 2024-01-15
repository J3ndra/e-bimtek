<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'group', 'fee_flat', 'fee_percent', 'deactived_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getStatusAttribute()
    {
        if ($this->deactived_at == NULL) {
            return 'Aktif';
        } else {
            return 'Tidak Aktif';
        }
    }
}
