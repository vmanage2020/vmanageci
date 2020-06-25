<?php namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\StudentContactModel;
use App\Models\StudentCertificateModel;
use CodeIgniter\Controller;

class Student extends Controller {
 

    public function index()
    {
        $data['function'] = "api_list_student";
        $model = new StudentModel();

        $data['users'] = $model->getRows();

        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);

    }
    
  
    public function view($id=null)
    {
        $data['function'] = "api_view_student";
        $model = new StudentModel();

        $where = array(
            'stu_prf_id_pk' => $id
        );
        $data['where'] = $where;

        $data['user'] = $model->viewRow($where);
        
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);
    }

    public function create()
    {
        $data['function'] = "api_save_student";
        $model = new StudnetModel();

        $jsondata = json_decode(file_get_contents('php://input'), true);
        $username = $jsondata['username'];
        $password = $jsondata['password'];

        $data['json'] = $jsondata;
        
        
        $data['query'] = $model->save($data['json']);


        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data, JSON_NUMERIC_CHECK);

        /*
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
        */
    }
    

}