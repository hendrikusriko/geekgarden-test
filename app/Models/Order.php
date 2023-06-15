<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    protected $fillable = [
        'invoice_number',
        'user_id',
        'total_price',
        'order_status'
    ];

    use HasFactory;
}
