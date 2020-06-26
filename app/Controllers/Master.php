<?php namespace App\Controllers;

use App\Models\MasterModel;
//use App\Models\StudentContactModel;
//use App\Models\StudentCertificateModel;
use CodeIgniter\Controller;

class Master extends Controller {
 

    public function index()
    {
        /* $data['function'] = "api_list_student";
        $model = new StudentModel();

        $data['users'] = $model->getRows();

        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK); */

    }
    
  
    public function academicboard($id=null)
    {
        $data['function'] = "api_academic_board";
        $model = new MasterModel();

		if( $id == null)
		{

			$jsondata = json_decode(file_get_contents('php://input'), true);
			
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
		else if( $id != null)
		{

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