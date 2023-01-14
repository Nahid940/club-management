<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailConfig extends Model
{
    use HasFactory;

    protected $fillable=['send_payment_approval_email','send_payment_decline_email','send_application_approval_email',
        'email_greeting','email_footer','email_addressing'];
}
