<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;
    protected $fillable=['name','origin','donor_type','email','phone','reference_person_phone','reference_person_name','address',
        'created_at','created_by'];
}
