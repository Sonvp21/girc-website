<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Announcement extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'announcements';

    public function scopePublished($query)
    {
        return $query->whereDate('published_at', '<=', now());
    }

    public function getPublishedAtViAttribute()
    {
        return ucfirst(Carbon::parse($this->published_at)->translatedFormat('l, d/m/Y'));
    }

    protected function updatedAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->updated_at)->format('d.m.Y h:i'),
        );
    }
}
