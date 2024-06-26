<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Queue extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'queue_date',
        'loket',
        'queue_number',
        'is_called',
        'called_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->slug = Str::uuid();
        });
    }

    public function queueLoket(): BelongsTo
    {
        return $this->belongsTo(QueueLoket::class, 'loket', 'loket_number');
    }
}
