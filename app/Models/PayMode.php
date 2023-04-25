<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayMode extends Model
{
    use HasFactory;
    protected $fillable = [
        'upi',
        'cash',
        'pending',
        'date',
        'updated_at',
        'created_at'
    ];
}
