<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'phone',
        'alt_phone',
        'email',
        'address',
        'ps',
        'district',
        'divisions',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
