<?php

namespace App\Models;

use App\Http\Controllers\Admin\News\NewsImageController;
use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory, CreatedUpdatedBy;

    protected $guarded = ['id'];

    public function images()
    {
        return $this->hasMany(NewsImage::class);
    }

    public function getShortDescriptionAttribute()
    {
        return Str::limit(nl2br(strip_tags($this->description)), 50 );
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($news) {
            if($news->images) {
                foreach ($news->images as $value) {
                    (new NewsImageController())->deleteStorageImage($value);
                }
            }
            $news->images()->delete();
        });
    }
}
