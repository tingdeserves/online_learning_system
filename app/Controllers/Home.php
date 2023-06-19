<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        //course list data $data
        $model=new \App\Models\CourseList_model();
        $rows=$model->courseList(); 
        foreach($rows as $row){
            $info=[
                "course_id"=> $row->course_id,
                "course_name"=> $row->course_name,
                "course_des"=> $row->course_des,
                "ueid"=> $row->ueid,
            ];
            $data[]=$info;
        }

        //image &resize img path
        $output=[
            "imagePath"=>"writable/uploads/homepage_bg.png",
            "rotateImagePath"=>"#",
        ];

        echo view('template/header');
        echo view('welcome_message', $output);

        $session=session();
        $username=$session->get("e_usernamese");
        if(isset($_COOKIE["e_username"]) && isset($_COOKIE["e_password"])){
            $username=$_COOKIE["e_username"];
        }
        if($username){
        //echo view('courses_list', ["data"=>$data]);
        }
        else {
            $username=$session->get("l_usernamese");
            if(isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])){
                $username=$_COOKIE["l_username"];
            }
            if($username){
            //echo view('courses_list', ["data"=>$data]);
            }
        }

        echo view('template/footer');
    }

    public function resize(){
        $image=$this->request->getFile("resize_img");//get img from view (name)
        $path=ROOTPATH."writable/uploads/";

        $filename="homepage_bg.png";

        $image = service('image'); //use the image service
        $image->withFile($path.$filename) //the path of the file
        ->withHandler('imagick');  // use imagick handler

        if ($image == false) {
            echo 'Could not load image';
            return;
        }
        $image->resize(200,50);  //resize
        //$image->rotate($degree);// rotate image
        $imagickPath=$path."imagick/";
        $newFileName="resize_".$filename;
        $image->save($path.'/imagick/'.$newFileName);  //save to same path with new name
        $output=[
            "imagePath"=>"writable/uploads/".$filename,
            "rotateImagePath"=>"writable/uploads/imagick/".$newFileName,
        ];

        //echo view
        $model=new \App\Models\CourseList_model();
        $rows=$model->courseList(); 
        foreach($rows as $row){
            $info=[
                "course_id"=> $row->course_id,
                "course_name"=> $row->course_name,
                "course_des"=> $row->course_des,
                "ueid"=> $row->ueid,
            ];
            $data[]=$info;
        }

        echo view('template/header');
        echo view('welcome_message', $output);

        $session=session();
        $username=$session->get("e_usernamese");
        if(isset($_COOKIE["e_username"]) && isset($_COOKIE["e_password"])){
            $username=$_COOKIE["e_username"];
        }
        if($username){
        //echo view('courses_list', ["data"=>$data]);
        }
        else {
            $username=$session->get("l_usernamese");
            if(isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])){
                $username=$_COOKIE["l_username"];
            }
            if($username){
            //echo view('courses_list', ["data"=>$data]);
            }
        }

        echo view('template/footer');




// 0427 updated start  //deleted these below
        //echo view('template/header');
        //echo view('welcome_message', $output);
        //$session=session();
        //$username=$session->get("e_usernamese");
        //if(isset($_COOKIE["e_username"]) && isset($_COOKIE["e_password"])){
        //    $username=$_COOKIE["e_username"];
        //}
        //if($username)
        //echo view('courses_list');
        //else {
        //    $username=$session->get("l_usernamese");
        //    if(isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])){
        //        $username=$_COOKIE["l_username"];
        //    }
        //    if($username)
        //    echo view('courses_list');
        //}
        //echo view('template/footer');
// 0427 updated end
        

    }


}
