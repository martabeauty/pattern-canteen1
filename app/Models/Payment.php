<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'mode',
        'payment',
        'amount',
        'date',
        'updated_at',
        'created_at'
    ];
}
