<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'bill_id',
        'amount_paid',
        'payment_method',
        'payment_date',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
