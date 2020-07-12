<?php namespace App\Controllers;

use App\Models\UserModel;

use CodeIgniter\Controller;

class User extends Controller {
 

    public function index()
    {
        $data['function'] = "api_list_users";
        $model = new UserModel();

        $data['data'] = $model->getRows();

        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);

    }
    
	

    public function view($id=null)
    {
        $data['function'] = "api_view_user";
		$model = new UserModel();
		$data['data'] = $model->viewRow($id);
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);
    }

    public function create()
    {
        $data['function'] = "api_save_user";
		$model = new UserModel();

		
		$data = array(
				"col_code_fk" => $jsondata["col_code_fk"],
				"grps_id_fk" => $jsondata["grps_id_fk"],
				"users_appl_userid_fk" => $jsondata["users_appl_userid_fk"],
				"users_dept_code_fk" => $jsondata["users_dept_code_fk"],
				"users_name" => $jsondata["users_name"],
				"users_pwd" => $jsondata["users_pwd"],
				"users_type" => $jsondata["users_type"]
		);
		
		//echo '<pre>data->';print_r($data);die;
        
		$insertedData = $model->saveUser($data);
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

		$data['function'] = "api_update_user";
        $model = new UserModel();
		
		$data = array(
			"col_code_fk" => $jsondata["col_code_fk"],
			"grps_id_fk" => $jsondata["grps_id_fk"],
			"users_appl_userid_fk" => $jsondata["users_appl_userid_fk"],
			"users_dept_code_fk" => $jsondata["users_dept_code_fk"],
			"users_name" => $jsondata["users_name"],
			"users_pwd" => $jsondata["users_pwd"],
			"users_type" => $jsondata["users_type"]
		);
		
		
		//echo '<pre>data->';print_r($data);die;
        
		$updatedData = $model->updateUser($data, $id);
		//echo '<pre>$$updatedData->';print_r($$updatedData);die;
		//$insertedID = $insertedData->connID->insert_id;
		if( $updatedData )
		{
			$lastInsertId = $id;

		

			//$updatedContactData =  $contactModel->updateUser($contactData, $id);
			
			//echo '<pre>$contactData->';print_r($contactData);
			//echo '<pre>$updatedContactData->';print_r($updatedContactData);die;
			
			
			
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

	public function delete($id)
    {

		$data['function'] = "api_delete_user";
        $model = new UserModel();

		if( $id != null)
		{
			$delStudData = $model->delRow($id);
			$affectedStudRows = $delStudData->connID->affected_rows;
			
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