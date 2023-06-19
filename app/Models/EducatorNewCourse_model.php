<?php
namespace App\Models;  
use CodeIgniter\Model; 
class EducatorNewCourse_model extends Model
{
    public function getEducatorCourses($username){
        //using username,get ueid 
        $db= \Config\Database::connect();  
        $builder=$db->table("user_educator");
        $builder->where("ue_name",$username);
        $query=$builder->get();
        $row=$query->getResult();
        if($row){
            $ueid=$row[0]->ueid;
        }
        //get course info from courses
        $builder2=$db->table("courses");
        $builder2->where("ueid",$ueid);
        $query2=$builder2->get();
        $row2=$query2->getResult();
        if($row2){
            return $row2;
        }else{
            return false;
        }
    }

    public function releaseCourses($username,$course_name,$course_des,$course_img){
        //using username,get ueid 
        $db= \Config\Database::connect();  
        $builder=$db->table("user_educator");
        $builder->where("ue_name",$username);
        $query=$builder->get();
        $row=$query->getResult();
        if($row){
            $ueid=$row[0]->ueid;
        }

        //insert new data to courses
        $builder2=$db->table("courses");
        $data=[
            "course_name"=>$course_name,
            "ueid"=>$ueid,
            "course_des"=>$course_des,
            "course_img"=>$course_img,
        ];
        $true_false=$builder2->insert($data);
        return $true_false;

    }



}