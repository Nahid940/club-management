<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_setting extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=["user_id","template_color","font_size"];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
