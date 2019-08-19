<?php

namespace JePaFe\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'body'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function path()
    {
        return '/admin/posts/' . $this->slug;
    }
}
