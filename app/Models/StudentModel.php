<?php namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'ac_ms_student_profile';

    protected $contact_table = 'ac_ms_student_condact';

   protected $certificate_table = 'ac_ms_student_cert';
	
	
    public function viewRow($id)
    {

      //$sql = 'select * from '.$this->table.' a LEFT JOIN '.$this->contact_table.' b ON a.stu_prf_id_pk= b.stu_prf_code_fk LEFT JOIN '.$this->certificate_table.' c ON  a.stu_prf_id_pk= c.stu_prf_code_fk where a.stu_prf_id_pk ='.$id;

      $sql = 'select * from '.$this->table.' a LEFT JOIN '.$this->contact_table.' b ON a.stu_prf_id_pk= b.stu_prf_code_fk where a.stu_prf_id_pk ='.$id;
      $query =  $this->db->query($sql);
      
      return $query->getRow();
    }
    
    public function updateStudent( $data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('stu_prf_id_pk' => $id));
        return $query;
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
    } else {
        return $this->where('status', $status)->findAll();        
    }

    }

    public function delRow($id)
    {
       return $this->db->table($this->table)->where('stu_prf_id_pk', $id)->delete(); 
    }

    public function countRow()
    {

      $sql = 'select count(*) as studentcount from '.$this->table;
      $query =  $this->db->query($sql);      
      return $query->getRow();

    }
}