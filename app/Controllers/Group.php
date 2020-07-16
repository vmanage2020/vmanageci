<?php namespace App\Controllers;

use App\Models\GroupModel;

use CodeIgniter\Controller;

class Group extends Controller {
 

    public function index()
    {
        $data['function'] = "api_list_usergroups";
        $model = new GroupModel();

        $data['data'] = $model->getRows();

        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);

    }
    


    public function view($id=null)
    {
        $data['function'] = "api_view_usergroup";
		$model = new GroupModel();

		$data['data'] = $model->getRow($id);
        
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);
    }

    public function create()
    {
        $data['function'] = "api_save_usergroup";
		$model = new GroupModel();
        
        $jsondata = json_decode(file_get_contents('php://input'), true);

        $data = array(
            "grps_desc" => $jsondata["grps_desc"], 
            "col_code_fk" => 1,
            "status" => 0,
            "create_by" => 1,
            "create_date" => date('Y-m-d H:i:s'),
            "edit_by" => 0,
            "edit_date" => date('Y-m-d H:i:s')
        );
		 
		//echo '<pre>data->';print_r($data);die;
        
		$insertedData = $model->saveGroup($data);
		//echo '<pre>$insertedData->';print_r($insertedData);
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
		
		//echo '<pre>$insertedData->';print_r($insertedData);die;

        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);


	}
	
	public function update($id)
    {

		$data['function'] = "api_update_usergroup";
        $model = new GroupModel();

        $jsondata = json_decode(file_get_contents('php://input'), true);

		$data = array(
            "grps_desc" => $jsondata["grps_desc"], 
            "col_code_fk" => 1,
            "status" => 0,
            "edit_by" => 1,
            "edit_date" => date('Y-m-d H:i:s')
        );
		
		$updatedData = $model->updateGroup($data, $id);

        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		echo json_encode($data, JSON_NUMERIC_CHECK);
		
    }
    

	public function delete($id)
    {

		$data['function'] = "api_delete_usergroup";
        $model = new GroupModel();


		if( $id != null)
		{
			$delStudData = $model->delRow($id);
			$affectedStudRows = $delStudData->connID->affected_rows;
            $data['return']['message'] = "delete done";
            
		}else{
			$data['return']['message'] = "Error on delete";
		}

		header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);
	}
	
	

    

}