<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;

class VenueImage extends Model
{
    use HasFactory, CreatedUpdatedBy;

    protected $guarded = ['id'];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}
