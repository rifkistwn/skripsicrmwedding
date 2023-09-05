<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory, CreatedUpdatedBy;

    protected $guarded = ['id'];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
