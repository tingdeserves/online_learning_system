<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index() {
        $data['error']= "";
        if(isset($_COOKIE["username"]) && isset($_COOKIE["password"])){
            echo view('template/header');
            echo view('welcome_message');
            echo view('template/footer');
        }
       else{
        $session=session();
        $username=$session->get("usernamese");
        $password=$session->get("passwordse");
        if($username &&$password){  //is a session is created
            echo view('template/header');
            echo view('welcome_message');
            echo view('template/footer');
        }else{
            echo view('template/header');
            echo view('login', $data);
            echo view('template/footer');
        }
    }
    }

    public function check_login() {
        $data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or password!! </div> ";
        $username = $this->request->getPost('username'); //$username and $password are from the View
        $password = $this->request->getPost('password');
        //controller-model interactive start
        $model=new \App\Models\User_model(); //create $model - an instance of User_model
        $check=$model->login($username,$password);
        $if_remember=$this->request->getPost("remember");
        if ($check) {
            //username/password match, create a session
            $session =session();  //session() is codeIgniter helper function to get an instance of session service
            $session->set("usernamese",$username);
            $session->set("passwordse",$password);
            echo view('template/header');
			echo view("welcome_message");
            echo view('template/footer');
            if($if_remember){
                //create a cookie
                setcookie("username",$username, time()+(86400*30),"/"); 
                setcookie("password",$password, time()+(86400*30),"/");
            }
		} else {
            echo view('template/header');
            echo view('login', $data);
            echo view('template/footer');
		}

    }

    public function logout(){
        $session=session();
        $session->destroy();
        setcookie("username","", time()-3600,"/");  //delete the cookies
        setcookie("password","", time()-3600,"/");
        return redirect()->to(base_url("login"));  //redirect()-to(".../login") helper function
    }

    
}
