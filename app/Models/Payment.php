<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    const PAYMENT_EDIT = 'payment-edit';
    const PAYMENT_INDEX = 'payment-index';

    const STATUS_PAID = 'paid';
    const STATUS_UNPAID = 'unpaid';
    const STATUS_CANCELED = 'canceled';

    protected $fillable = [
        'order_id',
        'status',
        'resnumber',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
