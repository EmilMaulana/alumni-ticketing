<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'user_id',
        'amount',
        'status',
        'payment_type',
        'va_number',
        'qr_code_url',
        'payment_details'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function check()
    {
        return $this->hasOne(Check::class);
    }

    protected $casts = [
        'payment_details' => 'array'
    ];
}
