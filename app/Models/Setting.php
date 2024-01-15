<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'title', 'value'
    ];

    public function getTypeAttribute()
    {
        $slug = $this->slug;
        if (
            $slug == 'logo' ||
            $slug == 'favicon'
        ) {
            return 'file';
        } else {
            return 'text';
        }
    }

    public function getCanDeleteAttribute()
    {
        $slug = $this->slug;
        if (
            $slug == 'f_link'
        ) {
            return true;
        } else {
            return false;
        }
    }
}
