<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fraud extends Model
{
    use HasFactory;
    protected $fillable = ['phone_number', 'disputant_name', 'details', 'steadfast_parcel_id', 'user_id'];
}
