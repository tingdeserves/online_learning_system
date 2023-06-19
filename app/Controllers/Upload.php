<?php
namespace App\Controllers;
class Upload extends BaseController
{
    public function index(){
        $data["error"]="";
        echo view("template/header");
        echo view("upload_form", $data);
        echo view("template/footer");
    }
    public function upload_file(){
        $data["error"]="";
        $title=$this->request->getPost("title");
        $file=$this->request->getFile("userfile"); //getFile(); get the file
        $file->move(WRITEPATH . "uploads");  //move the file into: writable/uploads
        $filename=$file->getName();
        $model= new \App\Models\Upload_model();
        $check=$model->upload($title,$filename); //run the Upload_model.php - upload() function
        if($check){
            echo view("template/header");
            echo "uploaded successfully";
            echo view("template/footer");
        }else{
            echo view("template/header");
            echo view("upload_form",$data);
            echo view("template/footer");
        }
    }

}


?>