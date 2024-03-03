<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_category',
        'customer_name',
        'customer_phone',
        'full_address',
        'divisions',
        'district',
        'police_station',
        'order_tracking_id',
        'delivery_type',
        'cod_amount',
        'invoice',
        'note',
        'product_weight',
        'exchange_status',
        'delivery_charge',
        'user_id',
        'deliveryman_id',
        'pickupman_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function deliveryman(){
        return $this->belongsTo(Deliveryman::class);
    }

    public function pickupman(){
        return $this->belongsTo(Pickupman::class);
    }
}
