<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpVarify extends Model
{
    use HasFactory;

    protected $fillable = [
        'otp',
        'user_id',
    ];
}
