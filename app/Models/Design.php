<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'file', 'horizontal', 'vertical', 'is_horizontal_center', 'is_vertical_center', 'is_active'
    ];
}
