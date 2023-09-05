<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory, CreatedUpdatedBy;

    protected $guarded = ['id'];

    public function packet()
    {
      return $this->belongsTo(Packet::class);
    }
    
    public function venue()
    {
      return $this->belongsTo(Venue::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function promo()
    {
      return $this->belongsTo(Promo::class);
    }
}
