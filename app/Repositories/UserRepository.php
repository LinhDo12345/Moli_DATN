<?php


namespace App\Repositories;


use App\Models\User;

class UserRepository extends EloquentRepository
{
    public function getModel()
    {
        return User::class;
    }

    public function getUser($email)
    {
        return $this->_model
            ->select('*')
            ->where('email', $email)
            ->first();
    }
}
