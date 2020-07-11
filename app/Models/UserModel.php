<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'gn_ms_users';

    public function getRows()
    {
         return $this->findAll();
    }

    public function getRow($id)
    {
        $query = $this->db->query('select * from '.$this->table.' where grps_id_pk='.$id.' order by grps_id_pk asc');
        return $query->getResult();
        
    }


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