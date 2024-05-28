<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'loket_is_enabled',
        'loket_length'
    ];

    function loket_is_enabled() {
        return 1;
    }
}
