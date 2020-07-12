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
        $query = $this->db->query('select * from '.$this->table.' where users_id_pk='.$id.' order by users_id_pk asc');
        return $query->getResult();
        
    }

//save, update, delete
public function delRow($id)
{
    $query = $this->db->query('delete from '.$this->table.' where users_id_pk='.$id.'');
    return $query->getResult();
    
//return $this->db->table($this->table_board)->where($data)->delete(); 
} 


public function saveUser($data)
{
    $query = $this->db->table($this->table)->insert($data);
    return $query;
}

public function updateUser($data, $id)
{
    $query = $this->db->table($this->table)->update($data, array('users_id_pk' => $id));
    return $query;
}

public function checkUsers($data)
    {
    
        return $this->where($data)
                ->first();
    }
	
}