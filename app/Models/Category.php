<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'category_name',
        'category_slug',
        'category_desc'
    ];

    public function posts():HasMany
    {
        return $this->hasMany(Post::class);
    }
}
