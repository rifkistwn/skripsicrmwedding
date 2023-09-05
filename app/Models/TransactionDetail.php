<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function packet()
    {
        return $this->belongsTo(Packet::class);
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }

    public function event()
    {
        return $this->hasOne(Event::class, 'transaction_detail_id' , 'id');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'id', 'review_id');
    }
}
