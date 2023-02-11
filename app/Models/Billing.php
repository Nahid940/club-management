<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $fillable=['member_name','member_id','member_code',
        'lounge_cash_amount',
        'lounge_card_amount',
        'restaurant_cash_amount',
        'restaurant_card_amount',
        'date','payment_ref_no','remarks','created_at','created_by'];
}
