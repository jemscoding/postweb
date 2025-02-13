<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    //
    protected $fillable =
    [
        'tag_name',
        'tag_slug'
    ];


    public function posts(): BelongsToMany
    {
        return $this->BalongsToMany(Post::class ,'post_tags', 'tag_id');
    }
}
