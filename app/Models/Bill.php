<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'title',
        'amount',
        'due_date',
        'user_id',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
