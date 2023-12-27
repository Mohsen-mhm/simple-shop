<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    const ORDER_EDIT = 'order-edit';
    const ORDER_INDEX = 'order-index';

    const STATUS_UNPAID = 'unpaid';
    const STATUS_PREPARATION = 'preparation';
    const STATUS_POSTED = 'posted';
    const STATUS_RECEIVED = 'received';
    const STATUS_CANCELED = 'canceled';

    protected $fillable = [
        'user_id',
        'price',
        'status',
        'tracking_serial',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function setStatus(string $status): bool
    {
        return $this->update(['status' => $status]);
    }
}
