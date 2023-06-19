<?php
namespace App\Controllers;
class LearnerWorkplace extends BaseController
{
	public function index()
	{

        $session=session();
        $username=$session->get("l_usernamese");
        if(isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])){
            $username=$_COOKIE["l_username"];
        }
        if($username != null){

        $model=new \App\Models\Collection_model();
        $row=$model->getCollection($username);
        if($row != false){
            foreach($row as $item ){
                $info=[
                    "course_name"=> $item->course_name,
                    "course_id"=> $item->course_id,
                    "collection_id"=> $item->coll_id,
                    "paid_status"=>$item->paid,
                ];
            $data[]=$info;
            }
        }
        else{
            $data=[];
        }
		echo view('template/header');
		echo view('learner_workplace');
		echo view('course_collection' , ["data"=>$data]);
        //echo view("course_enrolled");
		echo view('template/footer');
        }



        
        else{
            echo view("template/header");
            echo "<h1>Please login as learner.</h1>";
            echo view("template/footer");
        }
	}

}
