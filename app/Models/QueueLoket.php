<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QueueLoket extends Model
{
    use HasFactory;

    protected $fillable = [
        'loket_number',
        'name',
    ];

    // public function queue(): BelongsTo
    // {
    //     return $this->belongsTo(Queue::class, 'loket');
    // }

}
