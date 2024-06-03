<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QueueLoket extends Model
{
    use HasFactory;

    protected $fillable = [
        'loket_number',
        'name',
    ];

    public function queue(): HasMany
    {
        return $this->hasMany(Queue::class, 'loket_number', 'loket');
    }
}
