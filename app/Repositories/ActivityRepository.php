<?php


namespace App\Repositories;


use App\Models\Activity;

class ActivityRepository extends EloquentRepository
{
    public function getModel()
    {
        return Activity::class;
    }

    public function getList()
    {
        return $this->_model
            ->join('topic_has_activity', 'topic_has_activity.activity_id', 'activity.id')
            ->join('game', 'game.id', 'activity.game_id')
            ->select(
                'topic_id',
                'activity.id as activity_id',
                'activity.name as name_activity',
                'activity.path as path_activity',
                'activity.game_id',
                'game.name as name_game',
                'game.thumb as thumb_game',
                'game.path as path_game'
            )
            ->where('activity.status', 1)
            ->get();
    }

    public function getListAct($status)
    {
        return $this->_model
            ->select('*')
            ->whereIn('status', $status)
            ->get();
    }

    public function getByGameId($gameId)
    {
        return $this->_model
            ->select('*')
            ->where('game_id', $gameId)
            ->first();
    }

}
