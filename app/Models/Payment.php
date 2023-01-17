<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable=['member_id','payment_type','payment_date','amount','currency_rate','currency',
        'payment_method','payment_ref_no','remarks','purpose_id','payment_month',
        'payment_year','created_at','created_by','is_payment'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function donor()
    {
        return $this->belongsTo(Donor::class,'member_id','id');
    }

    public function paymentType()
    {
        return $this->hasOne(PaymentType::class,'id','payment_type');
    }

    public function purpose()
    {
        return $this->hasOne(DonationPurpose::class,'id','purpose_id');
    }

    public function scopeInfo($query)
    {
        return $query->with('member:id,first_name,member_code,email,member_type,mobile_number', 'paymentType','purpose');
    }
}
