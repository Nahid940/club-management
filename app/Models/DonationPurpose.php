<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationPurpose extends Model
{
    use HasFactory;

    protected $fillable=['purpose','created_at','created_by'];
}
