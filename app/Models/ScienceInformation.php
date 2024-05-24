<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ScienceInformation extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['user_id', 'title_en', 'title', 'slug', 'keep_on_top', 'content', 'published_at'];

    protected $table = 'science_informations';

    protected $casts = [
        'published_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('lg')
            ->crop(1020, 603)
            ->sharpen(5)
            ->format('jpg')
            ->performOnCollections('science_information_photo');

        $this->addMediaConversion('md')
            ->crop(541, 320)
            ->sharpen(5)
            ->format('jpg')
            ->performOnCollections('science_information_photo');

        $this->addMediaConversion('thumb')
            ->crop(368, 276)
            ->sharpen(10)
            ->format('jpg')
            ->performOnCollections('science_information_photo');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('science_information_photo')
            ->singleFile()
            ->useDisk('scienceinfor');
    }

    public function scopePublished($query)
    {
        return $query->whereDate('published_at', '<=', now());
    }

    public function publishedAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->published_at)->translatedFormat('l, d/m/Y'),
        );
    }

    protected function updatedAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->updated_at)->format('d.m.Y h:i'),
        );
    }
}
