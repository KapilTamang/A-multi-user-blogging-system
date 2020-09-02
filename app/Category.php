<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = ['name', 'slug'];

    public function blog() {
        return $this->belongsToMany(Blog::class);
    }
}
