<?php namespace App\Models;

use CodeIgniter\Model;

class MasterModel extends Model
{
    protected $board_table = 'ac_ms_board_cor_info';
	
	public function saveBoard($data)
	{
		$query = $this->db->table($this->table)->insert($data);
        return $query;
	}
    /* public function viewRow($data)
    {
    
        return $this->where($data)
                ->first();
    }
    
	
	public function saveStudent($data)
	{
		$query = $this->db->table($this->table)->insert($data);
        return $query;
	}
	
    public function getRows($status = false)
    {

    if ($status === false)
    {
        return $this->findAll();
    }

    } */


}