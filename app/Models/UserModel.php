<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'gn_ms_users';

    public function checkUsers($data)
    {
    
        return $this->where($data)
                ->first();
    }
    
    public function getUsers($status = false)
    {
    if ($status === false)
    {
        return $this->findAll();
    }

    return $this->asArray()
                ->where(['status' => $status])
                ->first();
    }
}