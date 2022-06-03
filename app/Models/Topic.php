<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table      = 'topic';
    public    $timestamps = false;

    CONST IS_NOT_ACTIVE = 0;
    CONST IS_ACTIVE     = 1;
    CONST IS_CANCEL     = 2;

    CONST LIST_STATUS = [
        'IS_ACTIVE' => self::IS_ACTIVE,
        'IS_NOT_ACTIVE' => self::IS_NOT_ACTIVE,
    ];

    protected $fillable =
        [
            'id',
            'name',
            'thumb',
            'status',
            'time_created',
            'time_updated'
        ];

}
