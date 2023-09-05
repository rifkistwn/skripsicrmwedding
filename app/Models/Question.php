<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    const NOT_ANSWERED = 0;
    const ANSWERED = 1;

    protected $guarded = [
        'id'
    ];
}
