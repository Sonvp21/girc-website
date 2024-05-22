<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tonysm\RichTextLaravel\Casts\AsRichTextContent;

class Department extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    
    protected $guarded = [];

    protected $table = 'departments';

    public function staffs()
    {
        return $this->belongsToMany(Staff::class, 'staff_departments', 'department_id', 'staff_id');
    }

    protected function updatedAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->updated_at)->format('d.m.Y h:i'),
        );
    }
    protected function createdAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->created_at)->format('d.m.Y h:i'),
        );
    }
}
