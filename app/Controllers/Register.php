<?php

namespace App\Controllers;

class Register extends BaseController
{
    public function index() {

        $err=["err"=>""];
        echo view('template/header');
        echo view("register", $err);
        echo view('template/footer');
    }

    public function register() {
        $username=$this->request->getPost("username");
        $email=$this->request->getPost("email");
        $phone=$this->request->getPost('phone');
        $password=$this->request->getPost("password");
        $role=$this->request->getPost("role");


        $rules = [
            "username"=>"required|alpha_numeric|max_length[20]|min_length[4]",
            "email"=>"required|valid_email",
            "phone"=>"required|numeric|min_length[10]|max_length[10]",
            "password"=>"required|alpha_numeric|min_length[4]",
            "role"=>"required",
        ];

        if(! $this->request->is('post')){
            $this->index(); 
        }
        //validation
        else if(! $this->validate($rules)){
            $err=[
                "err"=>"",
            ];
            echo view('template/header');
            return view("register",$err);
            echo view('template/footer');
        }
        //check username,email,phone unique
        else if($this->validate($rules)){
            $model=new \App\Models\Register_model();
            $row=$model->checkUnique($username, $email, $phone, $role);
            if ($row){
                $err=[
                    "err"=>"Sorry. Please check your usernam, email or phone number. They are already exist",
                ];
                echo view('template/header');
                return view("register",$err);
                echo view('template/footer');
            }
            if(!$row){
                $model=new \App\Models\Register_model();
                $true_false=$model->register($username , $email , $phone , $password , $role);
                if($true_false){
                    return redirect()->to( base_url().'register/succ');
                }
            }
    


            
        }
        //insert 



    }

    public function register_success() {
        echo view('template/header');
        echo view("register_success");
        echo view('template/footer');
    }

    


}

?>