<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table      = 'game';
    public    $timestamps = false;

    const IN_ACTIVE   = 0;
    const IS_ACTIVE   = 1;
    const CANCEL      = 2;

    const LIST_STATUS = [
        'IS_ACTIVE'     => self::IS_ACTIVE,
        'IS_NOT_ACTIVE' => self::IN_ACTIVE
    ];

    protected $fillable =
        [
            'id',
            'name',
            'thumb',
            'path',
            'status',
            'time_created',
            'time_updated'
        ];

}
