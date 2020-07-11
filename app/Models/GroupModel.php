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


}

