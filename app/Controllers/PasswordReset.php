<?php

namespace App\Controllers;

class PasswordReset extends BaseController
{
    public function index() {
        
		echo view('template/header');
		echo view('pasword_reset');
		echo view('template/footer');
    }


    public function verify_username(){
        #1.check if username exist from table"user_learner"
        #2.return username to View
        if($this->request->isAJAX()){
            $username = $_REQUEST["username"];  //get the value from XMLHTTP request url
        }
        $model=new \App\Models\SecretQuestions_model();
        $data=$model->verify_username($username);

        if($data["l_username"]!=0 && $data["l_username"]!=1){
            echo json_encode($data);  //return value to view

        }
        else if($data["l_username"]==0){
            echo json_encode("0");  //return value to view
        }
        else if ($data["l_username"]==1){
            echo json_encode("1");  //return value to view
        }


    }
    public function verify_answers(){
        #1.get username, answers from view
        #2.check if answers match data in "secret_q"
        #3. return result to view

        if($this->request->isAJAX()){
            $l_username = $_REQUEST["l_username"];  //get the value from XMLHTTP request url
            $answer1= $_REQUEST["answer1"];
            $answer2= $_REQUEST["answer2"];
        }

        $model=new \App\Models\SecretQuestions_model();
        $check_result=$model->verify_answers($l_username,$answer1,$answer2);
        if($check_result==0){
            echo json_encode("0"); //no secret question
        }
        else if($check_result==1){
            echo json_encode("1"); //success
        }
        else if($check_result==2){
            echo json_encode("2");  //incorrect answer
        }

    }

    public function submit_new_pw(){
        #check the update result from model
        #if failed, return code 0 and $rules
        #if successed, return succ code 1
        if($this->request->isAJAX()){
            $l_username = $_REQUEST["l_username"];  //get the value from XMLHTTP request url
            $l_password = $_REQUEST["l_password"];

        }

        $rules = [            
            "l_password"=>"required|alpha_numeric",
        ];
        if(! $this->validate($rules)){
            echo json_encode("9"); //password format not validated
        }
        else{
            $model=new \App\Models\SecretQuestions_model();   
            $result=$model->update_password($l_username,$l_password);

            if($result==0){
                echo json_encode("0"); //failed updating password
            }
            else if ($result==1){   
                echo json_encode("1"); //success
            }

        }





    }

}