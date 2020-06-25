<?php namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'ac_ms_student_profile';

    public function viewRow($data)
    {
    
        return $this->where($data)
                ->first();
    }
    
    public function getRows($status = false)
    {

    if ($status === false)
    {
        return $this->findAll();
    }

    }
}