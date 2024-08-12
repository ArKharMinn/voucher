<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_name',
        'unit',
        'item_code',
        'price',
        'cus_id',
        'qty',
        'amount',
    ];
}
