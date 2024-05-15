<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'tags';

    public $timestamps = false;

    /**
     * @return BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags');
    }

    public function getNameUcFistAttribute()
    {
        return Str::ucfirst($this->name);
    }
}
