<?php namespace App\Models;

use CodeIgniter\Model;

class GroupModel extends Model
{
    protected $table = 'gn_ms_usergroups';

    public function getRows()
    {
         return $this->findAll();
    }

    public function getRow($id)
    {
        $query = $this->db->query('select * from '.$this->table.' where grps_id_pk='.$id.' order by grps_id_pk asc');
        return $query->getResult();
        
    }

//save, update, delete
    public function delRow($id)
    {
        $query = $this->db->query('delete from '.$this->table_year.' where grps_id_pk='.$id.'');
        return $query->getResult();
        
    //return $this->db->table($this->table_board)->where($data)->delete(); 
    } 


    public function saveGroup($data)
    {
        $query = $this->db->table($this->table_board)->insert($data);
        return $query;
    }

    public function updateGroup($data, $id)
    {
        $query = $this->db->table($this->table_board)->update($data, array('grps_id_pk' => $id));
        return $query;
    }

}

