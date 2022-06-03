<?php


namespace App\Repositories;


use App\Models\Game;


class GameRepository extends EloquentRepository
{
    public function getModel()
    {
        return Game::class;
    }

    public function getList($status)
    {
        return $this->_model
            ->select('*')
            ->whereIn('status', $status)
            ->get();
    }


}
