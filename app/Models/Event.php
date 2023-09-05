<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, CreatedUpdatedBy;

    protected $guarded = ['id'];

    public function transaction()
    {
        return $this->hasOne(TransactionDetail::class, 'id' , 'transaction_detail_id');
    }

    public function gallery()
    {
        return $this->hasOne(Gallery::class, 'event_id', 'id');
    }
}
