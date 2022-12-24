<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable=['member_id','payment_type','payment_date','amount',
        'payment_method','payment_ref_no','remarks','payment_month',
        'payment_year','created_at','created_by'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
