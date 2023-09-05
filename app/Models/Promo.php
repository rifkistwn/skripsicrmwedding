<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory, CreatedUpdatedBy;

    protected $guarded = ['id'];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function packet()
    {
        return $this->belongsTo(Packet::class);
    }

    public function transactions()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function getDiscountedPriceAttribute()
    {
        $discount = $this->packet->price * $this->discount / 100;

        if($discount > $this->max_discount) $this->discount = $this->max_discount;

        return $this->packet->price - $this->discount;
    }
}
