<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table      = 'user';
    public    $timestamps = false;

    protected $hidden = [
      'password'
    ];

    protected $fillable =
        [
            'id',
            'name',
            'email',
            'email_verified_at',
            'password',
            'remember_token',
            'time_created'
        ];

}
