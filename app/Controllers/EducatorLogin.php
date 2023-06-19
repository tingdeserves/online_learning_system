<?php

namespace App\Controllers;

class EducatorLogin extends BaseController
{
    public function index() {
        $data['error']= "";
        if(isset($_COOKIE["e_username"]) && isset($_COOKIE["e_password"])){
            echo view('template/header');
            echo view('login_success');
            echo view('template/footer');
        }
       else{
        $session=session();
        $username=$session->get("e_usernamese");
        $password=$session->get("e_passwordse");
        if($username &&$password){  //is a session is created
            echo view('template/header');
            echo view('login_success');
            echo view('template/footer');
        }else{
            echo view('template/header');
            echo view('educator_login', $data);
            echo view('template/footer');
        }
    }
    }

    public function check_login() {
        $data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or password!! </div> ";
        $username = $this->request->getPost('username'); //$username and $password are from the View
        $password = $this->request->getPost('password');
        //controller-model interactive start
        $model=new \App\Models\Educator_model(); //create $model - an instance of User_model
        $check=$model->login($username,$password);
        $if_remember=$this->request->getPost("remember");
        if ($check) {
            //username/password match, create a session
            $session =session();  //session() is codeIgniter helper function to get an instance of session service
            $session->set("e_usernamese",$username);
            $session->set("e_passwordse",$password);
            echo view('template/header');
			echo view("login_success");
            echo view('template/footer');
            if($if_remember){
                //create a cookie
                setcookie("e_username",$username, time()+(86400*30),"/"); 
                setcookie("e_password",$password, time()+(86400*30),"/");
            }
		} else {
            echo view('template/header');
            echo view('educator_login', $data);
            echo view('template/footer');
		}

    }

    public function logout(){
        $session=session();
        $session->destroy();
        setcookie("e_username","", time()-3600,"/");  //delete the cookies
        setcookie("e_password","", time()-3600,"/");
        return redirect()->to(base_url("educator_login"));  //redirect()-to(".../login") helper function
    }

    
}
