<?php

namespace PHPZen\LaravelRbac\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    public function users()
    {
        return $this->belongsToMany(config('auth.model'));
    }
}
