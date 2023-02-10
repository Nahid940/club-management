<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $fillable=['member_name','member_id','member_code','lounge_amount','restaurant_amount','date','payment_method','payment_ref_no','remarks','created_at','created_by'];
}
