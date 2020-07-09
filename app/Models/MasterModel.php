<?php 

namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class MasterModel extends Model
{
    protected $table_board = 'ac_ms_board_cor_info';
    protected $table_extra = 'tbl_extracurricular';
    protected $table_lang = 'tbl_languages';
    protected $table_year= 'ac_ms_academic_year_detail';
    
  
 /*Citizen */
 public function saveCertificateName($data)
 {
     $query = $this->db->table($this->table_Standard)->insert($data);
     return $query;
 }

 public function updateCertificateName($data, $id)
 {
     $query = $this->db->table($this->table_Standard)->update($data, array('board_cor_id_pk' => $id));
     return $query;
 }

 public function getCertificateName($data)
 {
     $query = $this->db->query('select * from '.$this->table_Standard.' where board_cor_id_pk='.$data.' order by Id asc');
     return $query->getResult();
     /*
     return  $this->db->table($this->table_board)->where($data)
     ->first();
     */
 }

 public function getCertificateNames($status = false)
 {
     $query = $this->db->query('select * from '.$this->table_Standard.' order by board_cor_id_pk asc');
     return $query->getResult();
     //$query = $this->db->table($this->table_board)->findAll();
     //return $query;
 }

 public function delCertificateName($id)
 {
     $query = $this->db->query('delete from '.$this->table_Standard.' where board_cor_id_pk='.$id.'');
     return $query->getResult();
     
    //return $this->db->table($this->table_board)->where($data)->delete(); 
 } 
 
 
 
 
 /*Citizen */
	public function saveCitizen($data)
	{
		$query = $this->db->table($this->table_Standard)->insert($data);
        return $query;
    }

    public function updateCitizen($data, $id)
    {
        $query = $this->db->table($this->table_Standard)->update($data, array('board_cor_id_pk' => $id));
        return $query;
    }

    public function getCitizen($data)
    {
		$query = $this->db->query('select * from '.$this->table_Standard.' where board_cor_id_pk='.$data.' order by Id asc');
        return $query->getResult();
		/*
        return  $this->db->table($this->table_board)->where($data)
        ->first();
		*/
    }

    public function getCitizens($status = false)
    {
        $query = $this->db->query('select * from '.$this->table_Standard.' order by board_cor_id_pk asc');
        return $query->getResult();
        //$query = $this->db->table($this->table_board)->findAll();
        //return $query;
    }

    public function delCitizen($id)
    {
		$query = $this->db->query('delete from '.$this->table_Standard.' where board_cor_id_pk='.$id.'');
        return $query->getResult();
		
       //return $this->db->table($this->table_board)->where($data)->delete(); 
    } 





    /*Community */
	public function saveCommunity($data)
	{
		$query = $this->db->table($this->table_Standard)->insert($data);
        return $query;
    }

    public function updateCommunity($data, $id)
    {
        $query = $this->db->table($this->table_Standard)->update($data, array('board_cor_id_pk' => $id));
        return $query;
    }

    public function getCommunity($data)
    {
		$query = $this->db->query('select * from '.$this->table_Standard.' where board_cor_id_pk='.$data.' order by Id asc');
        return $query->getResult();
		/*
        return  $this->db->table($this->table_board)->where($data)
        ->first();
		*/
    }

    public function getCommunitys($status = false)
    {
        $query = $this->db->query('select * from '.$this->table_Standard.' order by board_cor_id_pk asc');
        return $query->getResult();
        //$query = $this->db->table($this->table_board)->findAll();
        //return $query;
    }

    public function delCommunity($id)
    {
		$query = $this->db->query('delete from '.$this->table_Standard.' where board_cor_id_pk='.$id.'');
        return $query->getResult();
		
       //return $this->db->table($this->table_board)->where($data)->delete(); 
    } 




  
  
    /*Religion*/
	public function saveReligion($data)
	{
		$query = $this->db->table($this->table_Standard)->insert($data);
        return $query;
    }

    public function updateReligion($data, $id)
    {
        $query = $this->db->table($this->table_Standard)->update($data, array('board_cor_id_pk' => $id));
        return $query;
    }

    public function getReligion($data)
    {
		$query = $this->db->query('select * from '.$this->table_Standard.' where board_cor_id_pk='.$data.' order by Id asc');
        return $query->getResult();
		/*
        return  $this->db->table($this->table_board)->where($data)
        ->first();
		*/
    }

    public function getReligions($status = false)
    {
        $query = $this->db->query('select * from '.$this->table_Standard.' order by board_cor_id_pk asc');
        return $query->getResult();
        //$query = $this->db->table($this->table_board)->findAll();
        //return $query;
    }

    public function delReligion($id)
    {
		$query = $this->db->query('delete from '.$this->table_Standard.' where board_cor_id_pk='.$id.'');
        return $query->getResult();
		
       //return $this->db->table($this->table_board)->where($data)->delete(); 
    } 
  
  
    /*Blood Group*/
	public function saveBloodGroup($data)
	{
		$query = $this->db->table($this->table_Standard)->insert($data);
        return $query;
    }

    public function updateBloodGroup($data, $id)
    {
        $query = $this->db->table($this->table_Standard)->update($data, array('board_cor_id_pk' => $id));
        return $query;
    }

    public function getBloodGroup($data)
    {
		$query = $this->db->query('select * from '.$this->table_Standard.' where board_cor_id_pk='.$data.' order by Id asc');
        return $query->getResult();
		/*
        return  $this->db->table($this->table_board)->where($data)
        ->first();
		*/
    }

    public function getBloodGroups($status = false)
    {
        $query = $this->db->query('select * from '.$this->table_Standard.' order by board_cor_id_pk asc');
        return $query->getResult();
        //$query = $this->db->table($this->table_board)->findAll();
        //return $query;
    }

    public function delBloodGroup($id)
    {
		$query = $this->db->query('delete from '.$this->table_Standard.' where board_cor_id_pk='.$id.'');
        return $query->getResult();
		
       //return $this->db->table($this->table_board)->where($data)->delete(); 
    } 



  /*Standard */
	public function saveStandard($data)
	{
		$query = $this->db->table($this->table_Standard)->insert($data);
        return $query;
    }

    public function updateStandard($data, $id)
    {
        $query = $this->db->table($this->table_Standard)->update($data, array('board_cor_id_pk' => $id));
        return $query;
    }

    public function getStandard($data)
    {
		$query = $this->db->query('select * from '.$this->table_Standard.' where board_cor_id_pk='.$data.' order by Id asc');
        return $query->getResult();
		/*
        return  $this->db->table($this->table_board)->where($data)
        ->first();
		*/
    }

    public function getStandards($status = false)
    {
        $query = $this->db->query('select * from '.$this->table_Standard.' order by board_cor_id_pk asc');
        return $query->getResult();
        //$query = $this->db->table($this->table_board)->findAll();
        //return $query;
    }

    public function delStandard($id)
    {
		$query = $this->db->query('delete from '.$this->table_Standard.' where board_cor_id_pk='.$id.'');
        return $query->getResult();
		
       //return $this->db->table($this->table_board)->where($data)->delete(); 
    } 

  
  
    /*Group Name */
	public function saveGroupname($data)
	{
		$query = $this->db->table($this->table_Groupname)->insert($data);
        return $query;
    }

    public function updateGroupname($data, $id)
    {
        $query = $this->db->table($this->table_Groupname)->update($data, array('board_cor_id_pk' => $id));
        return $query;
    }

    public function getGroupname($data)
    {
		$query = $this->db->query('select * from '.$this->table_Groupname.' where board_cor_id_pk='.$data.' order by Id asc');
        return $query->getResult();
		/*
        return  $this->db->table($this->table_board)->where($data)
        ->first();
		*/
    }

    public function getGroupnames($status = false)
    {
        $query = $this->db->query('select * from '.$this->table_Groupname.' order by board_cor_id_pk asc');
        return $query->getResult();
        //$query = $this->db->table($this->table_board)->findAll();
        //return $query;
    }

    public function delGroupname($id)
    {
		$query = $this->db->query('delete from '.$this->table_Groupname.' where board_cor_id_pk='.$id.'');
        return $query->getResult();
		
       //return $this->db->table($this->table_board)->where($data)->delete(); 
    } 

  
  
    /* Academic Year */
	public function saveYear($data)
	{
		$query = $this->db->table($this->table_year)->insert($data);
        return $query;
    }

    public function updateYear($data, $id)
    {
        $query = $this->db->table($this->table_year)->update($data, array('board_cor_id_pk' => $id));
        return $query;
    }

    public function getYear($data)
    {
		$query = $this->db->query('select * from '.$this->table_year.' where board_cor_id_pk='.$data.' order by Id asc');
        return $query->getResult();
		/*
        return  $this->db->table($this->table_board)->where($data)
        ->first();
		*/
    }

    public function getYears($status = false)
    {
        $query = $this->db->query('select * from '.$this->table_year.' order by board_cor_id_pk asc');
        return $query->getResult();
        //$query = $this->db->table($this->table_board)->findAll();
        //return $query;
    }

    public function delYear($id)
    {
		$query = $this->db->query('delete from '.$this->table_year.' where board_cor_id_pk='.$id.'');
        return $query->getResult();
		
       //return $this->db->table($this->table_board)->where($data)->delete(); 
    } 





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
		$query = $this->db->query('select * from '.$this->table_board.' where board_cor_id_pk='.$data.' order by Id asc');
        return $query->getResult();
		/*
        return  $this->db->table($this->table_board)->where($data)
        ->first();
		*/
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
		$query = $this->db->query('delete from '.$this->table_board.' where board_cor_id_pk='.$id.'');
        return $query->getResult();
		
       //return $this->db->table($this->table_board)->where($data)->delete(); 
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
		$query = $this->db->query('select * from '.$this->table_extra.' where Id='.$data.' order by Id asc');
        return $query->getResult();
		/*
        return  $this->db->table($this->table_extra)->where($data)
        ->first();
		*/
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
		$query = $this->db->query('delete from '.$this->table_extra.' where Id='.$id.'');
        return $query->getResult();
		
       //return $this->db->table($this->table_extra)->where($data)->delete(); 
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
		$query = $this->db->query('select * from '.$this->table_lang.' where Id='.$data.' order by Id asc');
        return $query->getResult();
		
		/*
		return  $this->db->table($this->table_extra)->where($data)
        ->first();
		*/
		
        //return  $this->db->table($this->table_lang)->getWhere($data);
	
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
		$query = $this->db->query('delete from '.$this->table_lang.' where Id='.$id.'');
        return $query->getResult();
		
       //return $this->db->table($this->table_lang)->where($data)->delete(); 
    }
 

}