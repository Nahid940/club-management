<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    public function classifications($related, $foreignKey = null, $localKey = null)
    {
        $this->hasMany(MemberClassification::class);
    }
}
