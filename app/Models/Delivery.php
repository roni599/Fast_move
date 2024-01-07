<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Ramsey\Uuid\Uuid;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_tracking_id',
        'category_type',
        'delivery_type',
        'name',
        'phone',
        'address',
        'divisions',
        'district',
        'police_station',
        'category_type',
        'delivery_type',
        'cod_amount',
        'invoice',
        'note',
        'weight',
        'exchange_parcel',
        'order_tracking_id',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

}
