<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table      = 'activity';
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
            'path',
            'game_id',
            'status',
            'time_created',
            'time_updated'
        ];

}
