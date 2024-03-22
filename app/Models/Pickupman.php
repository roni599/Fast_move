<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickupman extends Model
{
    use HasFactory;

    protected $fillable = [
        'pickupman_name',
        'phone',
        'alt_phone',
        'email',
        'password',
        'full_address',
        'police_station',
        'district',
        'division',
        'nid_front',
        'nid_back',
        'profile_img',
        'phone_number',
        'disputant_name',
        'details',
        'fast_move_parcel_id',
        'user_id',
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function frauds()
    {
        return $this->hasMany(Fraud::class);
    }
}
