<?php

namespace App\Controllers;

class CoursesList extends BaseController
{
    public function index()
    { 
        $session=session();
        $username=$session->get("e_usernamese");
        if ($username==null){
            if(isset($_COOKIE["e_username"]) && isset($_COOKIE["e_password"])){
                $username=$_COOKIE["e_username"];
            }
            else{
                $username==null;
            }
        }

        if($username==null){
            $username=$session->get("l_usernamese");
            if ($username==null){
                if(isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])){
                    $username=$_COOKIE["l_username"];
                }
                else{
                    $username==null;
                }
            }
        }
        if($username==null){
            echo view('template/header');
            echo "<h1>Please login.</h1>";
            echo view('template/footer');
            return;
        }


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
        echo view('courses_list', ["data"=>$data]);
        echo view('template/footer');
    }

    //search box auto_complete - AJAX
    public function auto_complete()
    {
        $model=new \App\Models\CourseList_model();
        $rows=$model->courseList(); 
        foreach($rows as $row){
            $course_name=$row->course_name;
            $data[]=$course_name;
        }
        echo json_encode($data);
    }
    public function sort_name_a_z(){  
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
        usort($data,function($a, $b){
                // using strcasecmp() replaced ==,>,<, which compare two values, return 0,<0,>0
                if(strcasecmp($a["course_name"], $b["course_name"])==0) return 0;
                if(strcasecmp($a["course_name"], $b["course_name"])<0) return -1;
                if(strcasecmp($a["course_name"], $b["course_name"])>0) return 1;
        }); 
        
        echo view('template/header');
        echo view('courses_list', ["data"=>$data]);
        echo view('template/footer');
    }
    public function sort_name_z_a(){
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
        usort($data,function($a, $b){
                // using strcasecmp() replaced ==,>,<, which compare two values, return 0,<0,>0
                if(strcasecmp($a["course_name"], $b["course_name"])==0) return 0;
                if(strcasecmp($a["course_name"], $b["course_name"])<0) return 1;
                if(strcasecmp($a["course_name"], $b["course_name"])>0) return -1;
        }); 
        
        echo view('template/header');
        echo view('courses_list', ["data"=>$data]);
        echo view('template/footer');
    }
    public function sort_name_id_asc(){
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
        usort($data,function($a, $b){
                if ($a["course_id"] == $b["course_id"]) return 0;
                if($a["course_id"] < $b["course_id"]) return -1;
                if($a["course_id"] > $b["course_id"]) return 1;
        }); 
        
        echo view('template/header');
        echo view('courses_list', ["data"=>$data]);
        echo view('template/footer');
    }
    public function sort_name_id_des(){
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
        usort($data,function($a, $b){
                if ($a["course_id"] == $b["course_id"]) return 0;
                if($a["course_id"] < $b["course_id"]) return 1;
                if($a["course_id"] > $b["course_id"]) return -1;
        }); 
        
        echo view('template/header');
        echo view('courses_list', ["data"=>$data]);
        echo view('template/footer');
    }


    ////learning resource from W3School, example of usort():   ////
    //function my_sort($a, $b) {
    //    if ($a["age"] == $b["age"]) return 0;
    //    if($a["age"] < $b["age"]) return -1;
    //    if($a["age"] > $b["age"]) return 1;
    //  }
      
    //  $people = [    
    //      ["name" => "alice", "age" => "37", "gender" => "f"],
    //      ["name" => "ken", "age" => "43", "gender" => "m"],
    //      ["name" => "blair", "age" => "12", "gender" => "f"],
    //  ];
      
    //  usort($people,"my_sort");
    //  foreach($people as $person) {
    //    echo $person["name"].",". $person["age"];
    //    echo "<br>";
    //  }


    public function test_search_results(){
        $data=[
            ["course_id"=>"12",
            "course_name"=>"hwo to use microwave",],
            ["course_id"=>"16",
            "course_name"=>"hwo to use oven",],
        ];


        echo view('template/header');
        echo view('search_results' , ["data"=>$data] );
        echo view('template/footer');
    }
    public function search_results(){
        #get the input value from view
        #call model function
        #get model results
        #show results in view
        $key_word=$this->request->getPOST("search_input");
        $model=new \App\Models\CourseList_model();
        $rows=$model->search_courses($key_word); 
        if($rows== null){
            $data=null;
        }
        else{
            $data=$rows;
        }

        //$data=[
        //    ["course_id"=>"12",
        //    "course_name"=>"hwo to use microwave",],
        //    ["course_id"=>"16",
        //    "course_name"=>"hwo to use oven",],
        //];


        echo view('template/header');
        echo view('search_results' , ["data"=>$data] );
        echo view('template/footer');
    }


}
?>
