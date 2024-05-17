<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type'];
    protected $table = 'albums';

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
    public function videos()
    {
        return $this->hasMany(Video::class);
    }

}
