<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

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

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('lg')
            ->crop(1020, 603)
            ->sharpen(5)
            ->format('jpg')
            ->performOnCollections('featured_image');

        $this->addMediaConversion('md')
            ->crop(541, 320)
            ->sharpen(5)
            ->format('jpg')
            ->performOnCollections('featured_image');

        $this->addMediaConversion('thumb')
            ->crop(368, 276)
            ->sharpen(10)
            ->format('jpg')
            ->performOnCollections('featured_image');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->useDisk('post');
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
