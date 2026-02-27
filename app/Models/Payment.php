<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'amount',
        'paid_at',
        'payer_id',
        'expense_id',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }

    public function expense()
    {
        return $this->belongsTo(Expense::class, 'expense_id');
    }
}
