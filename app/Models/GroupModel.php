<?php namespace App\Models;

use CodeIgniter\Model;

class GroupModel extends Model
{
    protected $table = 'gn_ms_usergroups';

    public function getRows()
    {

 
        return $this->findAll();
  

    }

  
}