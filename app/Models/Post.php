<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'content',
        'published_at',
    ];

    protected $table = 'posts';

    /*
    * -------------------------------------------------------------------------------------
    * RELATIONSHIPS
    * -------------------------------------------------------------------------------------
    */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    /*
    * -------------------------------------------------------------------------------------
    * SCOPES
    * -------------------------------------------------------------------------------------
    */
    public function scopePublished($query)
    {
        return $query->whereDate('published_at', '<=', now());
    }

    public function scopeexcludeCurrent($query, $id)
    {
        return $query->whereNotIn('id', [$id]);
    }

    /*
    * -------------------------------------------------------------------------------------
    * ACCESSOR & MUTATOR
    * -------------------------------------------------------------------------------------
    */
    public function getPublishedAtViAttribute()
    {
        return ucfirst(Carbon::parse($this->published_at)->translatedFormat('l, d/m/Y'));
    }

    public function getUpdatedAtViAttribute()
    {
        return Carbon::parse($this->updated_at)->format('d.m.Y h:i');
    }

    public function getPublishedDateAttribute()
    {
        return Carbon::parse($this->published_at)->format('M d, Y H:i');
    }

    public function getPublishedDateSearchAttribute()
    {
        return Carbon::parse($this->published_at)->diffForHumans();
    }
}
