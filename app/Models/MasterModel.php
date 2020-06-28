<?php namespace App\Models;

use CodeIgniter\Model;

class MasterModel extends Model
{
    protected $board_table = 'ac_ms_board_cor_info';
	
	public function saveBoard($data)
	{
		$query = $this->db->table($this->board_table)->insert($data);
        return $query;
    }
    public function updateBoard($data, $id)
    {
        $query = $this->db->table($this->board_table)->update($data, array('board_cor_id_pk' => $id));
        return $query;
    }

    public function getRows($status = false)
    {

        //$query = $this->db->table($this->board_table);
        $query = $this->db->query('select * from '.$this->board_table.' order by board_cor_id_pk desc');
        return $query->getResult();

    }

    public function delRow($id)
    {
       return $this->db->table($this->board_table)->where('board_cor_id_pk', $id)->delete(); 
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