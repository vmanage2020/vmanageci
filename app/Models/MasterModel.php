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
    protected $table_Groupname= 'ac_ms_board_group_info';
    protected $table_BloodGroup= 'gn_ms_blood_grp';
    protected $table_Religion = 'gn_ms_religion';
    protected $table_Community = 'gn_ms_community';
    protected $table_Certificate = 'ac_ms_cert_master';
    protected $table_Citizen = 'tbl_citizen';
    protected $table_Standard = 'ac_ms_com_stds';
    protected $table_Section = 'ac_ms_sections';
	protected $table_School = 'ac_ms_college';
      
    protected $table_Catagorytype = "hr_ms_staff_catg";
    protected $table_Designationtype = "hr_ms_staff_designation";
    protected $table_Stafftype = "hr_ms_staff_type";
    protected $table_Department = "hr_ms_dept_master";

    protected $table_Degree = "hr_ms_course_master";
    protected $table_Grade = "hr_ms_grade_master";


 /*Certificate */
 public function saveCertificateName($data)
 {
     $query = $this->db->table($this->table_Certificate)->insert($data);
     return $query;
 }

 public function updateCertificateName($data, $id)
 {
     $query = $this->db->table($this->table_Certificate)->update($data, array('crt_ms_id_pk' => $id));
     return $query;
 }

 public function getCertificateName($data)
 {
     $query = $this->db->query('select * from '.$this->table_Certificate.' where crt_ms_id_pk='.$data.' order by crt_ms_id_pk asc');
     return $query->getResult();
     /*
     return  $this->db->table($this->table_board)->where($data)
     ->first();
     */
 }

 public function getCertificateNames($status = false)
 {
     $query = $this->db->query('select * from '.$this->table_Certificate.' order by crt_ms_id_pk asc');
     return $query->getResult();
     //$query = $this->db->table($this->table_board)->findAll();
     //return $query;
 }

 public function delCertificateName($id)
 {
     $query = $this->db->query('delete from '.$this->table_Certificate.' where crt_ms_id_pk='.$id.'');
     return $query->getResult();
     
    //return $this->db->table($this->table_board)->where($data)->delete(); 
 } 
 
 
 
 
 /*Citizen */
	public function saveCitizen($data)
	{
		$query = $this->db->table($this->table_Citizen)->insert($data);
        return $query;
    }

    public function updateCitizen($data, $id)
    {
        $query = $this->db->table($this->table_Citizen)->update($data, array('Id' => $id));
        return $query;
    }

    public function getCitizen($data)
    {
		$query = $this->db->query('select * from '.$this->table_Citizen.' where Id='.$data.' order by Id asc');
        return $query->getResult();
		/*
        return  $this->db->table($this->table_board)->where($data)
        ->first();
		*/
    }

    public function getCitizens($status = false)
    {
        $query = $this->db->query('select * from '.$this->table_Citizen.' order by Id asc');
        return $query->getResult();
        //$query = $this->db->table($this->table_board)->findAll();
        //return $query;
    }

    public function delCitizen($id)
    {
		$query = $this->db->query('delete from '.$this->table_Citizen.' where Id='.$id.'');
        return $query->getResult();
		
       //return $this->db->table($this->table_board)->where($data)->delete(); 
    } 





    /*Community */
	public function saveCommunity($data)
	{
		$query = $this->db->table($this->table_Community)->insert($data);
        return $query;
    }

    public function updateCommunity($data, $id)
    {
        $query = $this->db->table($this->table_Community)->update($data, array('com_id_pk' => $id));
        return $query;
    }

    public function getCommunity($data)
    {
		$query = $this->db->query('select * from '.$this->table_Community.' where com_id_pk='.$data.' order by com_id_pk asc');
        return $query->getResult();
		/*
        return  $this->db->table($this->table_board)->where($data)
        ->first();
		*/
    }

    public function getCommunitys($status = false)
    {
        $query = $this->db->query('select * from '.$this->table_Community.' order by com_id_pk asc');
        return $query->getResult();
        //$query = $this->db->table($this->table_board)->findAll();
        //return $query;
    }

    public function delCommunity($id)
    {
		$query = $this->db->query('delete from '.$this->table_Community.' where com_id_pk='.$id.'');
        return $query->getResult();
		
       //return $this->db->table($this->table_board)->where($data)->delete(); 
    } 




  
  
    /*Religion*/
	public function saveReligion($data)
	{
		$query = $this->db->table($this->table_Religion)->insert($data);
        return $query;
    }

    public function updateReligion($data, $id)
    {
        $query = $this->db->table($this->table_Religion)->update($data, array('rel_id_pk' => $id));
        return $query;
    }

    public function getReligion($data)
    {
		$query = $this->db->query('select * from '.$this->table_Religion.' where rel_id_pk='.$data.' order by rel_id_pk asc');
        return $query->getResult();
		/*
        return  $this->db->table($this->table_board)->where($data)
        ->first();
		*/
    }

    public function getReligions($status = false)
    {
        $query = $this->db->query('select * from '.$this->table_Religion.' order by rel_id_pk asc');
        return $query->getResult();
        //$query = $this->db->table($this->table_board)->findAll();
        //return $query;
    }

    public function delReligion($id)
    {
		$query = $this->db->query('delete from '.$this->table_Religion.' where rel_id_pk='.$id.'');
        return $query->getResult();
		
       //return $this->db->table($this->table_board)->where($data)->delete(); 
    } 
  
  
    /*Blood Group*/
	public function saveBloodGroup($data)
	{
		$query = $this->db->table($this->table_BloodGroup)->insert($data);
        return $query;
    }

    public function updateBloodGroup($data, $id)
    {
        $query = $this->db->table($this->table_BloodGroup)->update($data, array('bld_id_pk' => $id));
        return $query;
    }

    public function getBloodGroup($data)
    {
		$query = $this->db->query('select * from '.$this->table_BloodGroup.' where bld_id_pk='.$data.' order by bld_id_pk asc');
        return $query->getResult();
		/*
        return  $this->db->table($this->table_board)->where($data)
        ->first();
		*/
    }

    public function getBloodGroups($status = false)
    {
        $query = $this->db->query('select * from '.$this->table_BloodGroup.' order by bld_id_pk asc');
        return $query->getResult();
        //$query = $this->db->table($this->table_board)->findAll();
        //return $query;
    }

    public function delBloodGroup($id)
    {
		$query = $this->db->query('delete from '.$this->table_BloodGroup.' where bld_id_pk='.$id.'');
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
        $query = $this->db->table($this->table_Standard)->update($data, array('cst_id_pk' => $id));
        return $query;
    }

    public function getStandard($data)
    {
		$query = $this->db->query('select * from '.$this->table_Standard.' where cst_id_pk='.$data.' order by cst_id_pk asc');
        return $query->getResult();
		/*
        return  $this->db->table($this->table_board)->where($data)
        ->first();
		*/
    }

    public function getStandards($status = false)
    {
        $query = $this->db->query('select * from '.$this->table_Standard.' order by cst_id_pk asc');
        return $query->getResult();
        //$query = $this->db->table($this->table_board)->findAll();
        //return $query;
    }

    public function delStandard($id)
    {
		$query = $this->db->query('delete from '.$this->table_Standard.' where cst_id_pk='.$id.'');
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
        $query = $this->db->table($this->table_Groupname)->update($data, array('brd_grp_id_pk' => $id));
        return $query;
    }

    public function getGroupname($data)
    {
		$query = $this->db->query('select * from '.$this->table_Groupname.' where brd_grp_id_pk='.$data.' order by brd_grp_id_pk asc');
        return $query->getResult();
		/*
        return  $this->db->table($this->table_board)->where($data)
        ->first();
		*/
    }

    public function getGroupnames($status = false)
    {
        $query = $this->db->query('select * from '.$this->table_Groupname.' order by brd_grp_id_pk asc');
        return $query->getResult();
        //$query = $this->db->table($this->table_board)->findAll();
        //return $query;
    }

    public function delGroupname($id)
    {
		$query = $this->db->query('delete from '.$this->table_Groupname.' where brd_grp_id_pk='.$id.'');
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
        $query = $this->db->table($this->table_year)->update($data, array('ayd_id_pk' => $id));
        return $query;
    }

    public function getYear($data)
    {
		$query = $this->db->query('select * from '.$this->table_year.' where ayd_id_pk='.$data.' order by ayd_id_pk asc');
        return $query->getResult();
		/*
        return  $this->db->table($this->table_board)->where($data)
        ->first();
		*/
    }

    
    public function getYears($status = false)
    {
        $query = $this->db->query('select * from '.$this->table_year.' order by ayd_id_pk asc');
        return $query->getResult();
        //$query = $this->db->table($this->table_board)->findAll();
        //return $query;
    }

    public function delYear($id)
    {
		$query = $this->db->query('delete from '.$this->table_year.' where ayd_id_pk='.$id.'');
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
		$query = $this->db->query('select * from '.$this->table_board.' where board_cor_id_pk='.$data.' order by board_cor_id_pk asc');
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
 

     /* Section */
     public function saveSection($data)
     {
         $query = $this->db->table($this->table_Section)->insert($data);
         return $query;
     }
 
     public function updateSection($data, $id)
     {
         $query = $this->db->table($this->table_Section)->update($data, array('sec_id_pk' => $id));
         return $query;
     }
 
     public function getSection($data)
     {
         $query = $this->db->query('select * from '.$this->table_Section.' where sec_id_pk='.$data.' order by sec_id_pk asc');
         return $query->getResult();
         /*
         return  $this->db->table($this->table_Section)->where($data)
         ->first();
         */
     }
 
     public function getSections($status = false)
     {
         $query = $this->db->query('select * from '.$this->table_Section.' order by sec_id_pk asc');
         return $query->getResult();
         //$query = $this->db->table($this->table_Section)->findAll();
         //return $query;
     }
 
     public function delSection($id)
     {
         $query = $this->db->query('delete from '.$this->table_Section.' where sec_id_pk='.$id.'');
         return $query->getResult();
         
        //return $this->db->table($this->table_Section)->where($data)->delete(); 
     }
	 
	 
	  /* School */
     public function saveSchool($data)
     {
         $query = $this->db->table($this->table_School)->insert($data);
         return $query;
     }
 
     public function updateSchool($data, $id)
     {
         $query = $this->db->table($this->table_School)->update($data, array('col_code_pk' => $id));
         return $query;
     }
 
     public function getSchool($data)
     {
         $query = $this->db->query('select * from '.$this->table_Section.' where col_code_pk='.$data.' order by col_code_pk asc');
         return $query->getResult();
         /*
         return  $this->db->table($this->table_School)->where($data)
         ->first();
         */
     }
 
     public function getSchools($status = false)
     {
         $query = $this->db->query('select * from '.$this->table_School.' order by col_code_pk asc');
         return $query->getResult();
         //$query = $this->db->table($this->table_School)->findAll();
         //return $query;
     }
 
     public function delSchool($id)
     {
         $query = $this->db->query('delete from '.$this->table_School.' where col_code_pk='.$id.'');
         return $query->getResult();
         
        //return $this->db->table($this->table_School)->where($data)->delete(); 
     }
 


     /* Catagorytype */
     public function saveCatagorytype($data)
     {
         $query = $this->db->table($this->table_Catagorytype)->insert($data);
         return $query;
     }
 
     public function updateCatagorytype($data, $id)
     {
         $query = $this->db->table($this->table_Catagorytype)->update($data, array('sct_id_pk' => $id));
         return $query;
     }
 
     public function getCatagorytype($data)
     {
         $query = $this->db->query('select * from '.$this->table_Catagorytype.' where sct_id_pk='.$data.' order by sct_id_pk asc');
         return $query->getResult();
         /*
         return  $this->db->table($this->table_Catagorytype)->where($data)
         ->first();
         */
     }
     
     public function getCatagorytypes($status = false)
     {
         $query = $this->db->query('select * from '.$this->table_Catagorytype.' order by sct_id_pk asc');
         return $query->getResult();
         //$query = $this->db->table($this->table_Catagorytype)->findAll();
         //return $query;
     }
 
     public function delCatagorytype($id)
     {
         $query = $this->db->query('delete from '.$this->table_Catagorytype.' where sct_id_pk='.$id.'');
         return $query->getResult();
         
        //return $this->db->table($this->table_Catagorytype)->where($data)->delete(); 
     }

     
     /* Designationtype */
     public function saveDesignationtype($data)
     {
         $query = $this->db->table($this->table_Designationtype)->insert($data);
         return $query;
     }
 
     public function updateDesignationtype($data, $id)
     {
         $query = $this->db->table($this->table_Designationtype)->update($data, array('dsg_id_pk' => $id));
         return $query;
     }
 
     public function getDesignationtype($data)
     {
         $query = $this->db->query('select * from '.$this->table_Designationtype.' where dsg_id_pk='.$data.' order by dsg_id_pk asc');
         return $query->getResult();
         /*
         return  $this->db->table($this->table_Designationtype)->where($data)
         ->first();
         */
     }
 
     public function getDesignationtypes($status = false)
     {
         $query = $this->db->query('select * from '.$this->table_Designationtype.' order by dsg_id_pk asc');
         return $query->getResult();
         //$query = $this->db->table($this->table_Designationtype)->findAll();
         //return $query;
     }
 
     public function delDesignationtype($id)
     {
         $query = $this->db->query('delete from '.$this->table_Designationtype.' where dsg_id_pk='.$id.'');
         return $query->getResult();
         
        //return $this->db->table($this->table_Designationtype)->where($data)->delete(); 
     }


     /* Stafftype */
     public function saveStafftype($data)
     {
         $query = $this->db->table($this->table_Stafftype)->insert($data);
         return $query;
     }
 
     public function updateStafftype($data, $id)
     {
         $query = $this->db->table($this->table_Stafftype)->update($data, array('stf_tye_id_pk' => $id));
         return $query;
     }
 
     public function getStafftype($data)
     {
         $query = $this->db->query('select * from '.$this->table_Stafftype.' where stf_tye_id_pk='.$data.' order by stf_tye_id_pk asc');
         return $query->getResult();
         /*
         return  $this->db->table($this->table_Stafftype)->where($data)
         ->first();
         */
     }
 
     public function getStafftypes($status = false)
     {
         $query = $this->db->query('select * from '.$this->table_Stafftype.' order by stf_tye_id_pk asc');
         return $query->getResult();
         //$query = $this->db->table($this->table_Stafftype)->findAll();
         //return $query;
     }
 
     public function delStafftype($id)
     {
         $query = $this->db->query('delete from '.$this->table_Stafftype.' where stf_tye_id_pk='.$id.'');
         return $query->getResult();
         
        //return $this->db->table($this->table_Stafftype)->where($data)->delete(); 
     }

     
     /* Department */
     public function saveDepartment($data)
     {
         $query = $this->db->table($this->table_Department)->insert($data);
         return $query;
     }
 
     public function updateDepartment($data, $id)
     {
         $query = $this->db->table($this->table_Department)->update($data, array('dpt_id_pk' => $id));
         return $query;
     }
 
     public function getDepartment($data)
     {
         $query = $this->db->query('select * from '.$this->table_Department.' where dpt_id_pk='.$data.' order by dpt_id_pk asc');
         return $query->getResult();
         /*
         return  $this->db->table($this->table_Department)->where($data)
         ->first();
         */
     }
 
     public function getDepartments($status = false)
     {
         $query = $this->db->query('select * from '.$this->table_Department.' order by dpt_id_pk asc');
         return $query->getResult();
         //$query = $this->db->table($this->table_Department)->findAll();
         //return $query;
     }
 
     public function delDepartment($id)
     {
         $query = $this->db->query('delete from '.$this->table_Department.' where dpt_id_pk='.$id.'');
         return $query->getResult();
         
        //return $this->db->table($this->table_Department)->where($data)->delete(); 
     }


     /* Degree */
     public function saveDegree($data)
     {
         $query = $this->db->table($this->table_Degree)->insert($data);
         return $query;
     }
 
     public function updateDegree($data, $id)
     {
         $query = $this->db->table($this->table_Degree)->update($data, array('cor_id_pk' => $id));
         return $query;
     }
 
     public function getDegree($data)
     {
         $query = $this->db->query('select * from '.$this->table_Degree.' where cor_id_pk='.$data.' order by cor_id_pk asc');
         return $query->getResult();
         /*
         return  $this->db->table($this->table_Degree)->where($data)
         ->first();
         */
     }
 
     public function getDegrees($status = false)
     {
         $query = $this->db->query('select * from '.$this->table_Degree.' order by cor_id_pk asc');
         return $query->getResult();
         //$query = $this->db->table($this->table_Degree)->findAll();
         //return $query;
     }
 
     public function delDegree($id)
     {
         $query = $this->db->query('delete from '.$this->table_Degree.' where cor_id_pk='.$id.'');
         return $query->getResult();
         
        //return $this->db->table($this->table_Degree)->where($data)->delete(); 
     }


     /* Grade */
     public function saveGrade($data)
     {
         $query = $this->db->table($this->table_Grade)->insert($data);
         return $query;
     }
 
     public function updateGrade($data, $id)
     {
         $query = $this->db->table($this->table_Grade)->update($data, array('grd_id_pk' => $id));
         return $query;
     }
 
     public function getGrade($data)
     {
         $query = $this->db->query('select * from '.$this->table_Grade.' where grd_id_pk='.$data.' order by grd_id_pk asc');
         return $query->getResult();
         /*
         return  $this->db->table($this->table_Grade)->where($data)
         ->first();
         */
     }
 
     public function getGrades($status = false)
     {
         $query = $this->db->query('select * from '.$this->table_Grade.' order by grd_id_pk asc');
         return $query->getResult();
         //$query = $this->db->table($this->table_Grade)->findAll();
         //return $query;
     }
 
     public function delGrade($id)
     {
         $query = $this->db->query('delete from '.$this->table_Grade.' where grd_id_pk='.$id.'');
         return $query->getResult();
         
        //return $this->db->table($this->table_Grade)->where($data)->delete(); 
     }
     
}