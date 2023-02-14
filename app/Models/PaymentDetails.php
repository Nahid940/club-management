<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetails extends Model
{
    use HasFactory;
    protected $fillable=['payment_id','member_id','payment_date','amount','currency_rate',
        'currency','payment_month','payment_year','is_payment',
        'created_at','created_by','updated_at','updated_by'];
}
