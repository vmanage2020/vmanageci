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
			$delData = $model->delBoard($where);
			$affectedRows = $delData->connID->affected_rows;
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
		elseif( $id != null && !$type )
		{
			$where = array(
				'board_cor_id_pk' => trim($id)
			);
			$data['academic_boards'] = $model->getBoard($where);
			
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
			$delData = $model->delLanguage($where);
			$affectedRows = $delData->connID->affected_rows;
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
		elseif( $id != null && !$type )
		{
			$where = array(
				'Id' => trim($id)
			);
			$data['languages'] = $model->getLanguage($where);
			
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
			$delData = $model->delActivity($where);
			$affectedRows = $delData->connID->affected_rows;
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
		elseif( $id != null && !$type )
		{
			$where = array(
				'Id' => trim($id)
			);
			$data['activities'] = $model->getActivity($where);
			
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