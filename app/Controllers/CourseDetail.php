<?php

namespace App\Controllers;

class CourseDetail extends BaseController
{
    public function index()
    { 

        //get course id from view
        $course_id=$this->request->uri->getSegment(2);

        //load the img path from model
        $model=new \App\Models\CourseDetail_model();
        $row=$model->courseinfo($course_id); //return the course query row
        //load comments


        $commentRow=$model->showCourseComments($course_id);//return comments
        //foreach comments store in array
        $comments=array();
        foreach ($commentRow as $comment){

            $comments[]=array(
                'comments_id'=>$comment->comments_id,
                'comments_text'=>$comment->comments_text,
                'ueid'=>$comment->ueid,
                'ue_name'=>$comment->ue_name,
                'ulid'=>$comment->ulid,
                'ul_name'=>$comment->ul_name,
                'course_id'=>$comment->course_id,
            );

        }
        //get the course_files original_name from model
        $model2=new \App\Models\CourseDetail_model();
        $course_file_rows=$model2->get_course_files($course_id);
        //echo count($course_file_rows);
        $files_data=[];
        if($course_file_rows){
            foreach ($course_file_rows as $file_item){
                $file_item=[
                    "file_ori_name"=>$file_item->file_ori_name,
                    "file_new_name"=>$file_item->file_new_name,
                ];
                $files_data[]=$file_item;
            }

        }

        //if wrong url from browser
        if(!$row || !$course_id){
            
            echo view('template/header');
            echo "<h3 >sorry, this page does not exist. </h3>";
            echo view('template/footer');
            return;
        }

        //output data
        $output=[
            "course_img"=>$row[0]->course_img,
            "course_name"=>$row[0]->course_name,
            "course_des"=>$row[0]->course_des,
            "course_id"=>$row[0]->course_id,
            "course_educator"=>$row[0]->ue_name,
            "comments"=>$comments,
            "files_data"=>$files_data,
        ];



        echo view('template/header');
        echo view('course_detail',$output);
        echo view('template/footer');
    }
    //add comments
    public function addComments()
    { 
        $comments_text=$this->request->getPost("comments_text");
        $course_id=$this->request->uri->getSegment(2);

        $session=session();
        $username=$session->get("e_usernamese");
        if(isset($_COOKIE["e_username"]) && isset($_COOKIE["e_password"])){
            $username=$_COOKIE["e_username"];
        }
        //educator
        if($username==True){
            $model=new \App\Models\CourseDetail_model();
            $true_false=$model->addComments_e($course_id,$username,$comments_text);
            if($true_false){
                $this->index();  //call index() will reload the page                
            }
        }
        //learner
        if($username==False){
            $username=$session->get("l_usernamese");
            if(isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])){
                $username=$_COOKIE["l_username"];
            }
            $model=new \App\Models\CourseDetail_model();
            $true_false=$model->addComments_l($course_id,$username,$comments_text);
            if($true_false){
                $this->index();  //call index() will reload the page                
            }
        }
    }
    public function upload_course_materials(){
        #get the educator username, id from view
        #deal with multi file, to store them as array
        #store the file address array into model
        #get the insertresult 
        #adjust the index to show the uploaded files
       
        $session=session();
		$username=$session->get("e_usernamese");
		if(isset($_COOKIE["e_username"]) && isset($_COOKIE["e_password"])){
            $username=$_COOKIE["e_username"];
        }
        $model1=new \App\Models\Profile_model();
        $row=$model1->getinfoe($username);
        $ueid=$row[0]->ueid;
        $course_id=$this->request->getPost("course_id");
        
        if ($course_materials = $this->request->getFiles()) {  //codeigniter documentation
            $file_count=count($course_materials['course_materials']);
            //print_r($course_materials['course_materials']);
            foreach ($course_materials['course_materials'] as $item) {
                if ($item->isValid() && ! $item->hasMoved()) {
                    $ori_name = $item->getName();
                    $newName = $item->getRandomName();
                    $item->move(WRITEPATH . 'uploads/course_file', $newName);
                    $data=[
                        "course_id"=>$course_id,
                        "`ueid`"=>$ueid,
                        "file_new_name"=>$newName,
                        "file_ori_name"=>$ori_name,
                    ];
                

                    
                    $model2=new \App\Models\CourseDetail_model();
                    $true_false=$model2->add_course_files($data);
                    $result[]=$true_false;
                    //if($true_false){
                    //    return redirect()->to( base_url().'course_detail/'.$course_id);
                    //}


                }
            }
             if(count($result)==$file_count){
                        return redirect()->to( base_url().'course_detail/'.$course_id);
                    }
        }

    }


}






?>
