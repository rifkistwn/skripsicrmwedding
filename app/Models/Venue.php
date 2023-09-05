<?php

namespace App\Models;

use App\Http\Controllers\Admin\Venue\VenueImageController;
use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory, CreatedUpdatedBy;
    
    protected $guarded = ['id'];

    public function images()
    {
        return $this->hasMany(VenueImage::class);
    }

    public function transactions()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function promo()
    {
        return $this->hasMany(Promo::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($venue) {
            if($venue->images) {
                foreach ($venue->images as $value) {
                    (new VenueImageController())->deleteStorageImage($value);
                }
            }
            $venue->images()->delete();
        });
    }
}
