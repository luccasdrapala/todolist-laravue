<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    const UPDATED_AT = 'null'; //updated_at não foi criado no migration

    protected $fillable = [
        'email', 'token'
    ];
}
