<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicHasActivity extends Model
{
    protected $table      = 'topic_has_activity';
    public    $timestamps = false;

    protected $fillable =
        [
            'topic_id',
            'activity_id'
        ];

}
