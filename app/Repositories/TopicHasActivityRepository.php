<?php


namespace App\Repositories;


use App\Models\Game;
use App\Models\TopicHasActivity;


class TopicHasActivityRepository extends EloquentRepository
{
    public function getModel()
    {
        return TopicHasActivity::class;
    }

    public function deleteByTopicId($topicId)
    {
        return $this->_model
            ->where('topic_id', $topicId)
            ->delete();
    }


}
