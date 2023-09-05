<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    const NOT_INCLUDE_VENUE = 1;
    const INCLUDE_VENUE = 2;

    use HasFactory, CreatedUpdatedBy;

    protected $fillable = ['code','name','price','image','description','with_venue'];

    public function promo()
    {
        $now_date = Carbon::now();
        
        return $this->hasMany(Promo::class)->whereDate('period_start', '<=', $now_date)->whereDate('period_end', '>=', $now_date)->latest();
    }

    public function transactions()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function getActivePromoAttribute()
    {
        return $this->promo->first();
    }

    public function getDiscountedPriceAttribute()
    {
        $promo = $this->active_promo;
        
        if($promo) {
            $discount = $this->price * $promo->discount / 100;
    
            if($discount > $promo->max_discount) $promo->discount = $promo->max_discount;
    
            return $this->price - $promo->discount;
        }

        return $this->price;
    }
}
