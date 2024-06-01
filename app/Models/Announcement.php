<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Announcement extends Model implements Searchable
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'announcements';

    protected $casts = [
        'published_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function getSearchResult(): SearchResult
    {
        $url = route('announcements.show', ['announcement' => $this->slug]);

        return new SearchResult(
            $this,
            $this->title,
            $url
        );
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
