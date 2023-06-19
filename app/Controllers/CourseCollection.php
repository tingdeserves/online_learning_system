<?php

namespace App\Controllers;

class CourseCollection extends BaseController
{
    public function addCollection(){
    $session=session();
    $username=$session->get("l_usernamese");
    if(isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])){
        $username=$_COOKIE["l_username"];
    }
    $course_id=$this->request->getPost('course_id');
    if(!$course_id){
        echo "no course_id found";
    }
    if(!$username){
        echo "no username found";
    }

    $model1=new \App\Models\Collection_model();
    $rows1=$model1->getUlid($username); 
    $ulid=$rows1[0]->ulid;
    if(!$ulid){
        echo "no ulid found";
    }

    $model2=new \App\Models\Collection_model();
    $rows2=$model2->getCourseName($course_id); 
    $course_name=$rows2[0]->course_name;
    if(!$course_name){
        echo "no course_name found";
    }

    $model3=new \App\Models\Collection_model();
    $true_false=$model3->addCollection($ulid, $course_id, $course_name); 
    if($true_false==true){
        echo view('template/header');
        echo view("course_collection_success");
        echo view('template/footer');
    }





    }
}