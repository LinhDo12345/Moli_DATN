<?php


namespace App\Repositories;


use App\Models\Topic;
use Illuminate\Support\Facades\DB;

class TopicRepository extends EloquentRepository
{
    public function getModel()
    {
        return Topic::class;
    }

    public function getList()
    {
        return $this->_model
            ->select('*')
            ->where('status', 1)
            ->get();
    }

    public function getListTopic()
    {
        return $this->_model
            ->select('*')
            ->whereIn('status', [0, 1])
            ->get();
    }

}
