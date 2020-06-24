<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Login extends Controller {

    public function signin()
	{
        
        $model = new UserModel();

        if (! $this->validate([
            'username' => 'required',
            'password'  => 'required'
        ]))
        {
            $data['error'] = "ERROR";
        }
        else
        {
            $where = array(
                'users_name' => $this->request->getVar('username'),
                'users_pwd' => $this->request->getVar('password')
            );
            $data['user'] = $model->checkUsers($where);
       
            if($data['user'])
            {
                echo "OK";
            }
            else
            {
                echo "NOT OK";
            }
            
        }
        
        
    }
 
    public function api_signin()
	{
        /*
        $data['function'] = "api_signin";

        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
        die();
        }
        echo json_encode($data, JSON_NUMERIC_CHECK);
        */
        
        $jsondata = json_decode(file_get_contents('php://input'), true);
        $username = $jsondata['username'];
        $password = $jsondata['password'];

        $data['json'] = $jsondata;
        $data['function'] = "api_signin";

        $model = new UserModel();

        if (!$username)
        {
            $data['error'] = true;
            $data['message'] = "Validation Error.";
        }
        else
        {
            $data['success'] = true;
            
            $where = array(
                'users_name' => $username,
                'users_pwd' => $password
            );
            $data['user'] = $model->checkUsers($where);
       
            if($data['user'])
            {
                $data['message'] = "Login Success.";
            }
            else
            {
                $data['message'] = "Login Error.";
            }
            
        }
    
        //return json_encode($data);
        
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);
        
    }


    public function index()
    {

        $model = new UserModel();

        $data['news'] = $model->getUsers();

        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);

        //return json_encode($data, JSON_PRETTY_PRINT);

        //header('Content-Type: application/json');
        //echo json_encode( $data );

        /*
        return $this->output
        ->set_content_type('application/json')
        ->set_status_header(200) // Return status
        ->set_output(json_encode(array($data)));
        */
    }
    
    /*
    public function index()
    {
        echo "USERS";

        $model = new UserModel();

        $data['news'] = $model->getUsers();

        print_r($data);

    }

    public function view($status = null)
    {
        $model = new UserModel();

        $data['news'] = $model->getUsers($status);

        print_r($data);
    }

    public function create()
    {
        $model = new NewsModel();

        if (! $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'body'  => 'required'
        ]))
        {
            echo view('templates/header', ['title' => 'Create a news item']);
            echo view('news/create');
            echo view('templates/footer');
        }
        else
        {
            $model->save([
                'title' => $this->request->getVar('title'),
                'slug'  => url_title($this->request->getVar('title'), '-', TRUE),
                'body'  => $this->request->getVar('body'),
            ]);

            echo view('news/success');
        }
    }
    */

}