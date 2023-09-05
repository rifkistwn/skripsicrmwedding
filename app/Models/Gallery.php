<?php

namespace App\Models;

use App\Http\Controllers\GalleryImageController;
use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory, CreatedUpdatedBy;

    protected $guarded = ['id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function images()
    {
        return $this->hasMany(GalleryImage::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($gallery) {
            if($gallery->images) {
                foreach ($gallery->images as $value) {
                    (new GalleryImageController)->deleteStorageImage($value);
                }
            }
            $gallery->images()->delete();
        });
    }
}
