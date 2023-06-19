<?php

namespace App\Controllers;

class UserLocation extends BaseController
{
    public function index()
    {
        $session=session();
        $username=$session->get("e_usernamese");
        if(isset($_COOKIE["e_username"]) && isset($_COOKIE["e_password"])){
            $username=$_COOKIE["e_username"];
        }
        if($username==True){
            $model=new \App\Models\Profile_model();
            $row=$model->getinfoe($username);
            $output=[
                    "username"=>$row[0]->ue_name,
                    "email"=>$row[0]->ue_email,
                    "phone"=>$row[0]->ue_phone,
                    "profileimg"=>$row[0]->ue_profileimg,
                    "sq_set"=>"0",

            ];

        }
        //learner - get info
        if($username==False){
            $username=$session->get("l_usernamese");
            if(isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])){
                $username=$_COOKIE["l_username"];
            }
            $model=new \App\Models\Profile_model();
            $row=$model->getinfol($username); //$username = $row[0]->ul_name;
            $model2=new \App\Models\SecretQuestions_model();
            $sq_set=$model2->if_sq_set($username);  //$sq_set ==1 set, $sq_set ==0 not set

            $output=[
                "username"=>$row[0]->ul_name,
                "email"=>$row[0]->ul_email,
                "phone"=>$row[0]->ul_phone,
                "profileimg"=>$row[0]->ul_profileimg,
                "verify"=>$row[0]->verify,
                "sq_set"=>$sq_set,
        ];
        }

        echo view('template/header');
        echo view('user_location',$output);
        echo view('template/footer');
    }
}