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
}