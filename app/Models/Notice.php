<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;
    protected $fillable=['notice','title','notice_date','created_by'];

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by')->select(['id', 'name']);
    }

}
