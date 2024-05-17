<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'videos';

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
