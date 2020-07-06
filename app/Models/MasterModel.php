<?php 

namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class MasterModel extends Model
{
    protected $table_board = 'ac_ms_board_cor_info';
    protected $table_extra = 'tbl_extracurricular';
    protected $table_lang = 'tbl_languages';
    
    /* BOARD */
	public function saveBoard($data)
	{
		$query = $this->db->table($this->table_board)->insert($data);
        return $query;
    }

    public function updateBoard($data, $id)
    {
        $query = $this->db->table($this->table_board)->update($data, array('board_cor_id_pk' => $id));
        return $query;
    }

    public function getBoard($data)
    {
        return  $this->db->table($this->table_board)->where($data)
        ->first();
    }

    public function getBoards($status = false)
    {
        $query = $this->db->query('select * from '.$this->table_board.' order by board_cor_id_pk asc');
        return $query->getResult();
        //$query = $this->db->table($this->table_board)->findAll();
        //return $query;
    }

    public function delBoard($id)
    {
       return $this->db->table($this->table_board)->where($data)->delete(); 
    }


    /* Extra Activity */
    public function saveActivity($data)
	{
		$query = $this->db->table($this->table_extra)->insert($data);
        return $query;
    }

    public function updateActivity($data, $id)
    {
        $query = $this->db->table($this->table_extra)->update($data, array('Id' => $id));
        return $query;
    }

    public function getActivity($data)
    {
        return  $this->db->table($this->table_extra)->where($data)
        ->first();
    }

    public function getActivities($status = false)
    {
        $query = $this->db->query('select * from '.$this->table_extra.' order by Id asc');
        return $query->getResult();
        //$query = $this->db->table($this->table_extra)->findAll();
        //return $query;
    }

    public function delActivity($id)
    {
       return $this->db->table($this->table_extra)->where($data)->delete(); 
    }

    /* LANGUAGE */
    public function saveLanguage($data)
	{
		$query = $this->db->table($this->table_lang)->insert($data);
        return $query;
    }

    public function updateLanguage($data, $id)
    {
        $query = $this->db->table($this->table_lang)->update($data, array('Id' => $id));
        return $query;
    }

    public function getLanguage($data)
    {
        return  $this->db->table($this->table_lang)->where($data)
        ->first();
    }

    public function getLanguages($status = false)
    {
        $query = $this->db->query('select * from '.$this->table_lang.' order by Id asc');
        return $query->getResult();
        //$query = $this->db->table($this->table_lang)->findAll();
        //return $query;
    }

    public function delLanguage($id)
    {
       return $this->db->table($this->table_lang)->where($data)->delete(); 
    }
 

}