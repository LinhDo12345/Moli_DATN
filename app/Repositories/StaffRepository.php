<?php


namespace App\Repositories;


use App\Models\Staff;

class StaffRepository extends EloquentRepository
{
    public function getModel()
    {
        return Staff::class;
    }

    public function getList()
    {
        return $this->_model
            ->select('*')
            ->whereIn('status', [Staff::IS_ACTIVE, Staff::IS_NOT_ACTIVE])
            ->get();
    }

    public function getStaffByEmail($email)
    {
        return $this->_model
            ->select('*')
            ->where('email', $email)
            ->first();
    }

    public function getStaffByIdStaff($idStaff)
    {
        return $this->_model
            ->select('*')
            ->where('code_staff', $idStaff)
            ->first();
    }

    public function countAll()
    {
        return $this->_model
            ->select('*')
            ->whereIn('status', [Staff::IS_ACTIVE, Staff::IS_NOT_ACTIVE])
            ->count();
    }


}
