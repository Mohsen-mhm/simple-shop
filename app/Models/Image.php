<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'imgable_type',
        'imgable_id',
        'image',
    ];

    public function image(): MorphTo
    {
        return $this->morphTo('imgable');
    }
}
