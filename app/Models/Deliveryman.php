<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveryman extends Model
{
    use HasFactory;

    protected $fillable = [
        'deliveryman_name',
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
    ];

    public function product(){
        return $this->hasMany(Product::class);
    }
}
