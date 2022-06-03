<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use Notifiable;

    protected $guard = 'staff';

    protected $table      = 'staff';
    public    $timestamps = false;

    const IS_ACTIVE     = 1;
    const IS_NOT_ACTIVE = 0;
    const IS_CANCEL     = 2;

    const MANAGEMENT = 1;
    const EMPLOYEE   = 2;

    const ROLE = [
        self::MANAGEMENT => 'Admin',
        self::EMPLOYEE   => 'Chuyên viên'
    ];

    protected $fillable =
        [
            'id',
            'name',
            'email',
            'password',
            'role',
            'status',
            'time_created',
            'time_updated'
        ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

}
