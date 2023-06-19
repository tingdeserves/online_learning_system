<?php
namespace App\Models;  
use CodeIgniter\Model; 
class CourseList_model extends Model{
    public function courseList(){
        $db= \Config\Database::connect();
        $builder=$db->table("courses");
        $builder->select();
        $query=$builder->get();
        $rows=$query->getResult();
        if($rows){
            return $rows;
        }else{
            return $rows=false;
        }
    }
    public function search_courses($key_word){
        #select * from "courses" where "course name" like "key word"
        #get query result
        #return results
        $db= \Config\Database::connect();
        $builder=$db->table("courses");
        $builder->select();
        $builder->like("course_name",$key_word);
        $query=$builder->get();
        $rows=$query->getResultArray();  //getResultArray return array; getResult return array object;
        if($rows){
            return $rows;
        }else{
            return $rows=false;
        }
    }



}