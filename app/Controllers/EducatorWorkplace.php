<?php
namespace App\Controllers;
class EducatorWorkplace extends BaseController
{
	public function index()
	{
		#show courses
		$session=session();
		$username=$session->get("e_usernamese");
		if(isset($_COOKIE["e_username"]) && isset($_COOKIE["e_password"])){
            $username=$_COOKIE["e_username"];
        }
		$model=new \App\Models\EducatorNewCourse_model();
		$rows=$model->getEducatorCourses($username);
	
		if($rows){
		foreach($rows as $row){
			$info=[
				"course_id"=>$row->course_id,
				"course_name"=>$row->course_name,
			];
			$data[]=$info;
		}
		}
		else{
			$data=[];
			//echo "no data";
		}


		echo view('template/header');
		echo view('educator_workplace');
		echo view('educator_course_list', ["data"=>$data]);
		echo view('template/footer');
	}

	//release new course
	public function releaseCourses(){
		#add courses


		$session=session();
		$username=$session->get("e_usernamese");
		if(isset($_COOKIE["e_username"]) && isset($_COOKIE["e_password"])){
            $username=$_COOKIE["e_username"];
        }

		$img_file =$this->request->getFile("course_img"); //get user imgage.jpg
        $extension = $img_file->getExtension();
		
		$course_name=$this->request->getPost('course_name');
		$course_des=$this->request->getPost('course_des');

		$fileName=$course_name."_course.".$extension; // eg:apple_profile.png
		$img_file->move(WRITEPATH . "uploads", $fileName,true);//true - overwrite old file(same name)
		$course_img='writable/uploads/'.$fileName; //path ->to database

		//$course_img_name=$this->request->getPost('course_img');
		//$course_img="writable/uploads/".$course_img_name;
		$model=new \App\Models\EducatorNewCourse_model();
		$true_false=$model->releaseCourses($username,$course_name,$course_des,$course_img);
		if($true_false){
			return redirect()->to( base_url().'educator_workplace/succ');
		}
	}

	public function release_success() {
        echo view('template/header');
        echo '
				<div class="container mt-5 mb-5">
				<div class="col-lg-6 mx-auto">
		
		
				<h1 class="mb-5">Release course successfully!</h1>    </div>
				</div>
				';
        echo view('template/footer');
    }

}
