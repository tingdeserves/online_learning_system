<?php
namespace App\Models;  // a namespace that matches their location 
use CodeIgniter\Model; // is used to import "Model" class from codeIgniter.
class CourseDetail_model extends Model{
    public function courseinfo($course_id){
        $db= \Config\Database::connect();  //represent a connection to the database
        $builder=$db->table("courses");
        $builder->select("*");
        $builder->where("course_id",$course_id);
        $builder->join("user_educator","user_educator.ueid=courses.ueid","left");
        $query=$builder->get();
        $row=$query->getResult();
        return $row;

    }
    public function showCourseComments($course_id){
        $db= \Config\Database::connect();  //represent a connection to the database
        $builder=$db->table("comments");
        $builder->select("*");
        $builder->where("comments.course_id",$course_id);
        $builder->join("courses","comments.course_id=courses.course_id","left");
        $builder->join("user_educator","user_educator.ueid=comments.ueid","left");
        $builder->join("user_learner","user_learner.ulid=comments.ulid","left");
        $query=$builder->get();
        $commentRow=$query->getResult();
        return $commentRow;

    }
    public function addComments_e($course_id,$username,$comments_text){
        $db= \Config\Database::connect();  //represent a connection to the database
        //query educator name through "educator" table
        $builder=$db->table("user_educator");
        $builder->select("ueid");
        $builder->where("user_educator.ue_name",$username);
        $query=$builder->get();
        $ueid=$query->getResult();

        $data=array(
            "course_id"=>$course_id,
            "ueid"=>$ueid[0]->ueid,
            "comments_text"=>$comments_text,
        );
        $true_false=$db->table("comments")->insert($data); //insert new comments
        return $true_false;

        }
        public function addComments_l($course_id,$username,$comments_text){
            $db= \Config\Database::connect();  //represent a connection to the database
            //query educator name through "educator" table
            $builder=$db->table("user_learner");
            $builder->select("ulid");
            $builder->where("user_learner.ul_name",$username);
            $query=$builder->get();
            $ulid=$query->getResult();
    
            $data=array(
                "course_id"=>$course_id,
                "ulid"=>$ulid[0]->ulid,
                "comments_text"=>$comments_text,
            );
            $true_false=$db->table("comments")->insert($data); //insert new comments
            return $true_false;
    
            }

        public function add_course_files($data){
            $db= \Config\Database::connect();  
            $builder=$db->table("course_files");


                $true_false=$builder->insert($data);
           
            return $true_false;

        }
        public function get_course_files($course_id){
            $db= \Config\Database::connect();  
            $builder=$db->table("course_files");
            $builder->where("course_id",$course_id);
            $query=$builder->get();
            $rows=$query->getResult();
            return $rows;
        }

        
        


}


?>