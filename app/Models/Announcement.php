<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'announcements';

    public function getPublishedAtViAttribute()
    {
        return ucfirst(Carbon::parse($this->created_at)->translatedFormat('l, d/m/Y'));
    }
}
