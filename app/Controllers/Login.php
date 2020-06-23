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