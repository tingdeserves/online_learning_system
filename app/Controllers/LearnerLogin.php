<?php

namespace App\Controllers;

class LearnerLogin extends BaseController
{
    public function index() {
        $data['error']= "";
        if(isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])){
            echo view('template/header');
            echo view('login_success');
            echo view('template/footer');
        }
       else{
        $session=session();
        $username=$session->get("l_usernamese");
        $password=$session->get("l_passwordse");
        if($username &&$password){  //is a session is created
            echo view('template/header');
            echo view('login_success');
            echo view('template/footer');
        }else{
            echo view('template/header');
            echo view('learner_login', $data);
            echo view('template/footer');
        }
    }
    }

    public function check_login() {
        $data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or password!! </div> ";
        $username = $this->request->getPost('username'); //$username and $password are from the View
        $password = $this->request->getPost('password');
        //controller-model interactive start
        $model=new \App\Models\Learner_model(); //create $model - an instance of User_model
        $check=$model->login($username,$password);
        $if_remember=$this->request->getPost("remember");
        if ($check) {
            //username/password match, create a session
            $session =session();  //session() is codeIgniter helper function to get an instance of session service
            $session->set("l_usernamese",$username);
            $session->set("l_passwordse",$password);
            echo view('template/header');
			echo view("login_success");
            echo view('template/footer');
            if($if_remember){
                //create a cookie
                setcookie("l_username",$username, time()+(86400*30),"/"); 
                setcookie("l_password",$password, time()+(86400*30),"/");
            }
		} else {
            echo view('template/header');
            echo view('learner_login', $data);
            echo view('template/footer');
		}

    }

    public function logout(){
        $session=session();
        $session->destroy();
        setcookie("l_username","", time()-3600,"/");  //delete the cookies
        setcookie("l_password","", time()-3600,"/");
        return redirect()->to(base_url("learner_login"));  //redirect()-to(".../login") helper function
    }

    
}
