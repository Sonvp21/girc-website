<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'categories';

    /*
     * -------------------------------------------------------------------------------------
     * RELATIONSHIPS
     * -------------------------------------------------------------------------------------
    */

    /**
     * @return HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class)
            ->select('id', 'slug', 'title', 'category_id', 'published_at');
    }

    /**
     * @param  $limit
     * @return HasMany
     */
    public function newsWithLimit()
    {
        return $this->hasMany(Post::class)

            ->orderBy('published_at', 'desc')->limit(5);
    }

    protected function createddAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->created_at)->format('d.m.Y h:i'),
        );
    }

    protected function updatedAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->updated_at)->format('d.m.Y h:i'),
        );
    }
}
