<?php namespace App\Controllers;

use App\Models\MasterModel;
use App\Models\StudentModel;
//use App\Models\StudentContactModel;
//use App\Models\StudentCertificateModel;
use CodeIgniter\Controller;

class Master extends Controller {
 

    public function index()
    {
        $data['function'] = "api_master_data";
        $model = new MasterModel();
		
		
		//$data['boards'] = $model->getBoards();
		$board_array = array();
		$boards = $model->getBoards();
		foreach($boards as $board)
		{
			$board_array[] = array( "id" => $board->board_cor_id_pk, "name" => $board->board_cor_name );
		}
		$data['boards'] = $board_array;

		//$data['languages'] = $model->getLanguages();
		$language_array = array();
		$languages = $model->getLanguages();
		foreach($languages as $language)
		{
			$language_array[] = array( "id" => $language->Id, "name" => $language->Language );
		}
		$data['languages'] = $language_array;

		//$data['activities'] = $model->getActivities();
		$activity_array = array();
		$activities = $model->getActivities();
		foreach($activities as $activity)
		{
			$activity_array[] = array( "id" => $activity->Id, "name" => $activity->Activity );
		}
		$data['activities'] = $activity_array;

        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);

	}
	
	public function dashboard()
    {
        $data['function'] = "api_dashboard_data";
		$studentmodel = new StudentModel();
		$student_array = array();
		$studentinfo = $studentmodel->countRow();
		
		$data['student']=$studentinfo->studentcount;
		$data['teacher']=0;
		$data['parent']=0;
		$data['staff']=0;

		header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);
	}
    
  
    public function academicboard($type=null,$id=null)
    {
        $data['function'] = "api_academic_board";
        $model = new MasterModel();

		$jsondata = json_decode(file_get_contents('php://input'), true);

		if( $id == null && $type=="add")
		{
			
			$data = array(
				"board_cor_name" => $jsondata["board_cor_name"],
				"board_cor_edu_level" => 0,
				"board_cor_others" => 0,
				"status" => 0,
				"create_by" => 1,
				"create_date" => date('Y-m-d H:i:s'),
				"edit_by" => 0,
				"edit_date" => date('Y-m-d H:i:s')
			);

			$insertedData = $model->saveBoard($data);

			$insertedID = $insertedData->connID->insert_id;
			if($insertedID>0)
			{
				$lastInsertId = $insertedID;
				$data['return']['insertid'] = $insertedID;
				$data['return']['message'] = "Inserted Success";
			}
			else
			{
				$data['return']['message'] = "Error on Insert";
			}
		}
		else if( $id != null && $type=="update")
		{
			
			$data = array(
				"board_cor_name" => $jsondata["board_cor_name"],
				"edit_by" => 1,
				"edit_date" => date('Y-m-d H:i:s')
			);

			$updatedData = $model->updateBoard($data,$id);

			if( $updatedData )
			{
				$data['return']['message'] = "Updated Success";
			}else
			{
				$data['return']['message'] = "Error on Insert";
			}
		
		}
		else if( $id != null && $type=="delete")
		{
			$where = array(
				'board_cor_id_pk' => trim($id)
			);
			$delData = $model->delBoard($id);
			$affectedRows = $delData->connID->affected_rows;
			$affectedRows = 1;
			if( $affectedRows )
			{
				$data['return']['message'] = "Deleted Success";
			}else
			{
				$data['return']['message'] = "Error on delete";
			}
		}
		elseif( !$id && !$type )
		{
			
			$data['academic_boards'] = $model->getBoards();
			
		}
		elseif( $type != null && !$id )
		{
			$where = array(
				'board_cor_id_pk' => trim($type)
			);
			
			$data['academic_boards'] = $model->getBoard($type);
			
		}
        /* $where = array(
            'stu_prf_id_pk' => $id
        );
        $data['where'] = $where;

        $data['user'] = $model->viewRow($where); */
        
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);
	}
	

	
	public function certificatename($type=null,$id=null)
    {
        $data['function'] = "ac_ms_cert_master";
        $model = new MasterModel();

		$jsondata = json_decode(file_get_contents('php://input'), true);

		if( $id == null && $type=="add")
		{
			
			$data = array(
				"crt_ms_name" => $jsondata["crt_ms_name"],
				"col_code_fk" => 0,
				"crt_ms_isreturnable" => 1,
				"status" => 0,
				"create_by" => 1,
				"create_date" => date('Y-m-d H:i:s'),
				"edit_by" => 0,
				"edit_date" => date('Y-m-d H:i:s')
			);

			$insertedData = $model->saveCertificateName($data);

			$insertedID = $insertedData->connID->insert_id;
			if($insertedID>0)
			{
				$lastInsertId = $insertedID;
				$data['return']['insertid'] = $insertedID;
				$data['return']['data'] = $model->getCertificateName($insertedID);
				$data['return']['message'] = "Inserted Success";
			}
			else
			{
				$data['return']['message'] = "Error on Insert";
			}
		}
		else if( $id != null && $type=="update")
		{
			
			$data = array(
				"crt_ms_name" => $jsondata["crt_ms_name"],
				"edit_by" => 1,
				"edit_date" => date('Y-m-d H:i:s')
			);

			$updatedData = $model->updateCertificateName($data,$id);

			if( $updatedData )
			{
				$data['return']['data'] = $model->getCertificateName($id);
				$data['return']['message'] = "Updated Success";
			}else
			{
				$data['return']['message'] = "Error on Insert";
			}
		
		}
		else if( $id != null && $type=="delete")
		{
			$where = array(
				'crt_ms_id_pk' => trim($id)
			);
			$delData = $model->delCertificateName($id);
			$affectedRows = $delData->connID->affected_rows;
			$affectedRows = 1;
			if( $affectedRows )
			{
				$data['return']['message'] = "Deleted Success";
			}else
			{
				$data['return']['message'] = "Error on delete";
			}
		}
		elseif( !$id && !$type )
		{
			
			$data['certificatenames'] = $model->getCertificateNames();
			
		}
		elseif( $type != null && !$id )
		{
			$where = array(
				'crt_ms_id_pk' => trim($type)
			);
			
			$data['certificatenames'] = $model->getCertificateName($type);
			
		}
        /* $where = array(
            'stu_prf_id_pk' => $id
        );
        $data['where'] = $where;

        $data['user'] = $model->viewRow($where); */
        
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);
	}




	public function citizen($type=null,$id=null)
    {
        $data['function'] = "tbl_citizen";
        $model = new MasterModel();

		$jsondata = json_decode(file_get_contents('php://input'), true);

		if( $id == null && $type=="add")
		{
			
			$data = array(
				"Citizens" => $jsondata["Citizens"]
			);

			$insertedData = $model->saveCitizen($data);

			$insertedID = $insertedData->connID->insert_id;
			if($insertedID>0)
			{
				$lastInsertId = $insertedID;
				$data['return']['insertid'] = $insertedID;
				$data['return']['data'] = $model->getCitizen($insertedID);
				$data['return']['message'] = "Inserted Success";
			}
			else
			{
				$data['return']['message'] = "Error on Insert";
			}
		}
		else if( $id != null && $type=="update")
		{
			
			$data = array(
				"Citizens" => $jsondata["Citizens"]
			);

			$updatedData = $model->updateCitizen($data,$id);

			if( $updatedData )
			{
				$data['return']['data'] = $model->getCitizen($id);
				$data['return']['message'] = "Updated Success";
			}else
			{
				$data['return']['message'] = "Error on Insert";
			}
		
		}
		else if( $id != null && $type=="delete")
		{
			$where = array(
				'Id' => trim($id)
			);
			$delData = $model->delCitizen($id);
			$affectedRows = $delData->connID->affected_rows;
			$affectedRows = 1;
			if( $affectedRows )
			{
				$data['return']['message'] = "Deleted Success";
			}else
			{
				$data['return']['message'] = "Error on delete";
			}
		}
		elseif( !$id && !$type )
		{
			
			$data['citizens'] = $model->getCitizens();
			
		}
		elseif( $type != null && !$id )
		{
			$where = array(
				'Id' => trim($type)
			);
			
			$data['citizens'] = $model->getCitizen($type);
			
		}
        /* $where = array(
            'stu_prf_id_pk' => $id
        );
        $data['where'] = $where;

        $data['user'] = $model->viewRow($where); */
        
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);
	}
	
	
	
	
	
	public function community($type=null,$id=null)
    {
        $data['function'] = "gn_ms_community";
        $model = new MasterModel();

		$jsondata = json_decode(file_get_contents('php://input'), true);

		if( $id == null && $type=="add")
		{
			
			$data = array(
				"com_des" => $jsondata["com_des"],
				"col_code_fk" => 1,
				"status" => 0,
				"create_by" => 1,
				"create_date" => date('Y-m-d H:i:s'),
				"edit_by" => 0,
				"edit_date" => date('Y-m-d H:i:s')
			);

			$insertedData = $model->saveCommunity($data);

			$insertedID = $insertedData->connID->insert_id;
			if($insertedID>0)
			{
				$lastInsertId = $insertedID;
				$data['return']['insertid'] = $insertedID;
				$data['return']['data'] = $model->getCommunity($insertedID);
				$data['return']['message'] = "Inserted Success";
			}
			else
			{
				$data['return']['message'] = "Error on Insert";
			}
		}
		else if( $id != null && $type=="update")
		{
			
			$data = array(
				"com_des" => $jsondata["com_des"],
				"edit_by" => 1,
				"edit_date" => date('Y-m-d H:i:s')
			);

			$updatedData = $model->updateCommunity($data,$id);

			if( $updatedData )
			{
				$data['return']['data'] = $model->getCommunity($id);
				$data['return']['message'] = "Updated Success";
			}else
			{
				$data['return']['message'] = "Error on Insert";
			}
		
		}
		else if( $id != null && $type=="delete")
		{
			$where = array(
				'crt_ms_id_pk' => trim($id)
			);
			$delData = $model->delCommunity($id);
			$affectedRows = $delData->connID->affected_rows;
			$affectedRows = 1;
			if( $affectedRows )
			{
				$data['return']['message'] = "Deleted Success";
			}else
			{
				$data['return']['message'] = "Error on delete";
			}
		}
		elseif( !$id && !$type )
		{
			
			$data['communities'] = $model->getCommunitys();
			
		}
		elseif( $type != null && !$id )
		{
			$where = array(
				'crt_ms_id_pk' => trim($type)
			);
			
			$data['communities'] = $model->getCommunity($type);
			
		}
        /* $where = array(
            'stu_prf_id_pk' => $id
        );
        $data['where'] = $where;

        $data['user'] = $model->viewRow($where); */
        
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);
	}
	
	
	
	
	public function religion($type=null,$id=null)
    {
        $data['function'] = "gn_ms_religio";
        $model = new MasterModel();

		$jsondata = json_decode(file_get_contents('php://input'), true);

		if( $id == null && $type=="add")
		{
			
			$data = array(
				"rel_des" => $jsondata["rel_des"],
				"col_code_fk" => 1,
				"status" => 0,
				"create_by" => 1,
				"create_date" => date('Y-m-d H:i:s'),
				"edit_by" => 0,
				"edit_date" => date('Y-m-d H:i:s')
			);

			$insertedData = $model->saveReligion($data);

			$insertedID = $insertedData->connID->insert_id;
			if($insertedID>0)
			{
				$lastInsertId = $insertedID;
				$data['return']['insertid'] = $insertedID;
				$data['return']['data'] = $model->getReligion($insertedID);
				$data['return']['message'] = "Inserted Success";
			}
			else
			{
				$data['return']['message'] = "Error on Insert";
			}
		}
		else if( $id != null && $type=="update")
		{
			
			$data = array(
				"rel_des" => $jsondata["rel_des"],
				"edit_by" => 1,
				"edit_date" => date('Y-m-d H:i:s')
			);

			$updatedData = $model->updateReligion($data,$id);

			if( $updatedData )
			{
				$data['return']['data'] = $model->getCertificateName($id);
				$data['return']['message'] = "Updated Success";
			}else
			{
				$data['return']['message'] = "Error on Insert";
			}
		
		}
		else if( $id != null && $type=="delete")
		{
			$where = array(
				'rel_id_pk' => trim($id)
			);
			$delData = $model->delReligion($id);
			$affectedRows = $delData->connID->affected_rows;
			$affectedRows = 1;
			if( $affectedRows )
			{
				$data['return']['message'] = "Deleted Success";
			}else
			{
				$data['return']['message'] = "Error on delete";
			}
		}
		elseif( !$id && !$type )
		{
			
			$data['religions'] = $model->getReligions();
			
		}
		elseif( $type != null && !$id )
		{
			$where = array(
				'rel_id_pk' => trim($type)
			);
			
			$data['religions'] = $model->getReligion($type);
			
		}
        /* $where = array(
            'stu_prf_id_pk' => $id
        );
        $data['where'] = $where;

        $data['user'] = $model->viewRow($where); */
        
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);
	}



	
	public function bloodgroup($type=null,$id=null)
    {
        $data['function'] = "gn_ms_blood_grp";
        $model = new MasterModel();

		$jsondata = json_decode(file_get_contents('php://input'), true);

		if( $id == null && $type=="add")
		{
			
			$data = array(
				"bld_des" => $jsondata["bld_des"],
				"col_code_fk" => 1,
				"status" => 0,
				"create_by" => 1,
				"create_date" => date('Y-m-d H:i:s'),
				"edit_by" => 0,
				"edit_date" => date('Y-m-d H:i:s')
			);

			$insertedData = $model->saveBloodGroup($data);

			$insertedID = $insertedData->connID->insert_id;
			if($insertedID>0)
			{
				$lastInsertId = $insertedID;
				$data['return']['insertid'] = $insertedID;
				$data['return']['data'] = $model->getBloodGroup($insertedID);
				$data['return']['message'] = "Inserted Success";
			}
			else
			{
				$data['return']['message'] = "Error on Insert";
			}
		}
		else if( $id != null && $type=="update")
		{
			
			$data = array(
				"bld_des" => $jsondata["bld_des"],
				"edit_by" => 1,
				"edit_date" => date('Y-m-d H:i:s')
			);

			$updatedData = $model->updateBloodGroup($data,$id);

			if( $updatedData )
			{
				$data['return']['message'] = "Updated Success";
			}else
			{
				$data['return']['message'] = "Error on Insert";
			}
		
		}
		else if( $id != null && $type=="delete")
		{
			$where = array(
				'bld_id_pk' => trim($id)
			);
			$delData = $model->delBloodGroup($id);
			$affectedRows = $delData->connID->affected_rows;
			$affectedRows = 1;
			if( $affectedRows )
			{
				$data['return']['message'] = "Deleted Success";
			}else
			{
				$data['return']['message'] = "Error on delete";
			}
		}
		elseif( !$id && !$type )
		{
			
			$data['bloodgroups'] = $model->getBloodGroups();
			
		}
		elseif( $type != null && !$id )
		{
			$where = array(
				'bld_id_pk' => trim($type)
			);
			
			$data['bloodgroups'] = $model->getBloodGroup($type);
			
		}
        /* $where = array(
            'stu_prf_id_pk' => $id
        );
        $data['where'] = $where;

        $data['user'] = $model->viewRow($where); */
        
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);
	}





	public function standard($type=null,$id=null)
    {
        $data['function'] = "tbl_standard";
        $model = new MasterModel();

		$jsondata = json_decode(file_get_contents('php://input'), true);

		if( $id == null && $type=="add")
		{
			
			$data = array(
				"cst_name" => $jsondata["cst_name"],
				"cst_acro" => $jsondata["cst_name"],
				"col_code_fk" => 1,
				"status" => 0,
				"create_by" => 1,
				"create_date" => date('Y-m-d H:i:s'),
				"edit_by" => 0,
				"edit_date" => date('Y-m-d H:i:s')
			);

			$insertedData = $model->saveStandard($data);

			$insertedID = $insertedData->connID->insert_id;
			if($insertedID>0)
			{
				$lastInsertId = $insertedID;
				$data['return']['insertid'] = $insertedID;
				$data['return']['data'] = $model->getStandard($insertedID);
				$data['return']['message'] = "Inserted Success";
			}
			else
			{
				$data['return']['message'] = "Error on Insert";
			}
		}
		else if( $id != null && $type=="update")
		{
			
			$data = array(
				"cst_name" => $jsondata["cst_name"],
				"cst_acro" => $jsondata["cst_name"],
				"edit_by" => 1,
				"edit_date" => date('Y-m-d H:i:s')
			);

			$updatedData = $model->updateStandard($data,$id);

			if( $updatedData )
			{
				$data['return']['data'] = $model->getStandard($id);
				$data['return']['message'] = "Updated Success";
			}else
			{
				$data['return']['message'] = "Error on Insert";
			}
		
		}
		else if( $id != null && $type=="delete")
		{
			$where = array(
				'cst_id_pk' => trim($id)
			);
			$delData = $model->delStandard($id);
			$affectedRows = $delData->connID->affected_rows;
			$affectedRows = 1;
			if( $affectedRows )
			{
				$data['return']['message'] = "Deleted Success";
			}else
			{
				$data['return']['message'] = "Error on delete";
			}
		}
		elseif( !$id && !$type )
		{
			
			$data['standards'] = $model->getStandards();
			
		}
		elseif( $type != null && !$id )
		{
			$where = array(
				'cst_id_pk' => trim($type)
			);
			
			$data['standards'] = $model->getStandard($type);
			
		}
        /* $where = array(
            'stu_prf_id_pk' => $id
        );
        $data['where'] = $where;

        $data['user'] = $model->viewRow($where); */
        
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);
	}





	public function groupname($type=null,$id=null)
    {
        $data['function'] = "ac_ms_board_group_info";
        $model = new MasterModel();

		$jsondata = json_decode(file_get_contents('php://input'), true);

		if( $id == null && $type=="add")
		{
			
			$data = array(
				"brd_grp_name" => $jsondata["brd_grp_name"],
				"brd_grp_medium_id" => 0,
				"brd_grp_board_id" => 1,
				"status" => 0,
				"create_by" => 1,
				"create_date" => date('Y-m-d H:i:s'),
				"edit_by" => 0,
				"edit_date" => date('Y-m-d H:i:s')
			);

			$insertedData = $model->saveGroupname($data);

			$insertedID = $insertedData->connID->insert_id;
			if($insertedID>0)
			{
				$lastInsertId = $insertedID;
				$data['return']['insertid'] = $insertedID;
				$data['return']['data'] = $model->getGroupname($insertedID);
				$data['return']['message'] = "Inserted Success";
			}
			else
			{
				$data['return']['message'] = "Error on Insert";
			}
		}
		else if( $id != null && $type=="update")
		{
			
			$data = array(
				"brd_grp_name" => $jsondata["brd_grp_name"],
				"edit_by" => 1,
				"edit_date" => date('Y-m-d H:i:s')
			);

			$updatedData = $model->updateGroupname($data,$id);

			if( $updatedData )
			{
				$data['return']['message'] = "Updated Success";
				$data['return']['data'] = $model->getGroupname($id);
			}else
			{
				$data['return']['message'] = "Error on Insert";
			}
		
		}
		else if( $id != null && $type=="delete")
		{
			$where = array(
				'brd_grp_id_pk' => trim($id)
			);
			$delData = $model->delGroupname($id);
			$affectedRows = $delData->connID->affected_rows;
			$affectedRows = 1;
			if( $affectedRows )
			{
				$data['return']['message'] = "Deleted Success";
			}else
			{
				$data['return']['message'] = "Error on delete";
			}
		}
		elseif( !$id && !$type )
		{
			
			$data['groupnames'] = $model->getGroupnames();
			
		}
		elseif( $type != null && !$id )
		{
			$where = array(
				'brd_grp_id_pk' => trim($type)
			);
			
			$data['groupnames'] = $model->getGroupname($type);
			
		}
        /* $where = array(
            'stu_prf_id_pk' => $id
        );
        $data['where'] = $where;

        $data['user'] = $model->viewRow($where); */
        
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);
	}




	public function academicyear($type=null,$id=null)
    {
        $data['function'] = "ac_ms_academic_year_detail";
        $model = new MasterModel();

		$jsondata = json_decode(file_get_contents('php://input'), true);

		if( $id == null && $type=="add")
		{
			
			$data = array(
				"ayd_start_year" => $jsondata["ayd_start_year"],
				"ayd_end_year" => $jsondata["ayd_start_year"],
				"col_code_fk" => 0,
				"status" => 0,
				"create_by" => 1,
				"create_date" => date('Y-m-d H:i:s'),
				"edit_by" => 0,
				"edit_date" => date('Y-m-d H:i:s')
			);

			$insertedData = $model->saveYear($data);

			$insertedID = $insertedData->connID->insert_id;
			if($insertedID>0)
			{
				$lastInsertId = $insertedID;
				$data['return']['insertid'] = $insertedID;
				$data['return']['data'] = $model->getYear($insertedID);
				$data['return']['message'] = "Inserted Success";
			}
			else
			{
				$data['return']['message'] = "Error on Insert";
			}
		}
		else if( $id != null && $type=="update")
		{
			
			$data = array(
				"ayd_start_year" => $jsondata["ayd_start_year"],
				"edit_by" => 1,
				"edit_date" => date('Y-m-d H:i:s')
			);

			$updatedData = $model->updateYear($data,$id);

			if( $updatedData )
			{
				
				$data['return']['data'] = $model->getYear($id);			
				$data['return']['message'] = "Updated Success";
			}else
			{
				$data['return']['message'] = "Error on Insert";
			}
		
		}
		else if( $id != null && $type=="delete")
		{
			$where = array(
				'ayd_id_pk' => trim($id)
			);
			$delData = $model->delYear($id);
			$affectedRows = $delData->connID->affected_rows;
			$affectedRows = 1;
			if( $affectedRows )
			{
				$data['return']['message'] = "Deleted Success";
			}else
			{
				$data['return']['message'] = "Error on delete";
			}
		}
		elseif( !$id && !$type )
		{
			
			$data['academicyears'] = $model->getYears();
			
		}
		elseif( $type != null && !$id )
		{
			$where = array(
				'ayd_id_pk' => trim($type)
			);
			
			$data['academicyears'] = $model->getYear($type);
			
		}
        /* $where = array(
            'stu_prf_id_pk' => $id
        );
        $data['where'] = $where;

        $data['user'] = $model->viewRow($where); */
        
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);
	}
	
	public function language($type=null,$id=null)
    {
        $data['function'] = "api_language";
        $model = new MasterModel();

		$jsondata = json_decode(file_get_contents('php://input'), true);

		if( $id == null && $type=="add")
		{
			
			$data = array(
				"Language" => $jsondata["Language"],
			);

			$insertedData = $model->saveLanguage($data);

			$insertedID = $insertedData->connID->insert_id;
			if($insertedID>0)
			{
				$lastInsertId = $insertedID;
				$data['return']['insertid'] = $insertedID;
				$data['return']['data'] = $model->getLanguage($insertedID);
				$data['return']['message'] = "Inserted Success";
			}
			else
			{
				$data['return']['message'] = "Error on Insert";
			}
		}
		else if( $id != null && $type=="update")
		{
			
			$data = array(
				"Language" => $jsondata["Language"]
			);

			$updatedData = $model->updateLanguage($data,$id);

			if( $updatedData )
			{
				$data['return']['data'] = $model->getLanguage($id);
				$data['return']['message'] = "Updated Success";
			}else
			{
				$data['return']['message'] = "Error on Insert";
			}
		
		}
		else if( $id != null && $type=="delete")
		{
			$where = array(
				'Id' => trim($id)
			);
			$delData = $model->delLanguage($id);
			
			$affectedRows = $delData->connID->affected_rows;
			$affectedRows = 1;
			if( $affectedRows )
			{
				$data['return']['message'] = "Deleted Success";
			}else
			{
				$data['return']['message'] = "Error on delete";
			}
		}
		elseif( !$id && !$type )
		{
			
			$data['languages'] = $model->getLanguages();
			
		}
		elseif( $type != null && !$id )
		{
			$where = array(
				'Id' => trim($type)
			);
					
					
			$data['languages'] = $model->getLanguage($type);
			
		}
        /* $where = array(
            'stu_prf_id_pk' => $id
        );
        $data['where'] = $where;

        $data['user'] = $model->viewRow($where); */
        
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);
    }


	
	public function activity($type=null,$id=null)
    {
        $data['function'] = "api_activity";
        $model = new MasterModel();

		$jsondata = json_decode(file_get_contents('php://input'), true);

		if( $id == null && $type=="add")
		{
			
			$data = array(
				"Activity" => $jsondata["Activity"],
			);

			$insertedData = $model->saveActivity($data);

			$insertedID = $insertedData->connID->insert_id;
			if($insertedID>0)
			{
				$lastInsertId = $insertedID;
				$data['return']['insertid'] = $insertedID;
				$data['return']['data'] = $model->getActivity($insertedID);
				$data['return']['message'] = "Inserted Success";
			}
			else
			{
				$data['return']['message'] = "Error on Insert";
			}
		}
		else if( $id != null && $type=="update")
		{
			
			$data = array(
				"Activity" => $jsondata["Activity"]
			);

			$updatedData = $model->updateActivity($data,$id);

			if( $updatedData )
			{
				$data['return']['data'] = $model->getActivity($id);
				$data['return']['message'] = "Updated Success";
			}else
			{
				$data['return']['message'] = "Error on Insert";
			}
		
		}
		else if( $id != null && $type=="delete")
		{
			$where = array(
				'Id' => trim($id)
			);
			$delData = $model->delActivity($id);
			$affectedRows = $delData->connID->affected_rows;
			$affectedRows = 1;
			if( $affectedRows )
			{
				$data['return']['message'] = "Deleted Success";
			}else
			{
				$data['return']['message'] = "Error on delete";
			}
		}
		elseif( !$id && !$type )
		{
			
			$data['activities'] = $model->getActivities();
			
		}
		elseif( $type != null && !$id )
		{
			$where = array(
				'Id' => trim($type)
			);
			$data['activities'] = $model->getActivity($type);
			
		}
        /* $where = array(
            'stu_prf_id_pk' => $id
        );
        $data['where'] = $where;

        $data['user'] = $model->viewRow($where); */
        
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);
    }

}