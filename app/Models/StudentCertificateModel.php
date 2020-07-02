<?php namespace App\Models;

use CodeIgniter\Model;

class StudentCertificateModel extends Model
{
    protected $table = 'ac_ms_student_cert';

    public function viewRow($data)
    {
    
        return $this->where($data)
                ->first();
    }

    public function viewsRowByStudent($id)
    {
        $where = array('stu_prf_code_fk' => $id);

        return $this->where($where)->find();
    }
    
    public function saveStudent($data)
	{
		$query = $this->db->table($this->table)->insertBatch($data);
        return $query;
    }
    
    public function getRows($status = false)
    {

    if ($status === false)
    {
        return $this->findAll();
    }

    }

    public function delRow($id)
    {
       return $this->db->table($this->table)->where('stu_prf_id_pk', $id)->delete(); 
    }
}