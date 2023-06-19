<?php
namespace App\Models;  // a namespace that matches their location 
use CodeIgniter\Model; // is used to import "Model" class from codeIgniter.
class Collection_model extends Model
{
    public function getCollection($username)
    {
        $db= \Config\Database::connect();  //represent a connection to the database
        $builder=$db->table("user_learner");
        $builder->where("ul_name",$username);
        $builder->join("course_collection","course_collection.ulid=user_learner.ulid","left");
        $query=$builder->get();
        $row=$query->getResult();
        $coll_id=$row[0]->coll_id;
        if( $coll_id){
            return $row;
        }
        else{
            return false;
        }
    }

    public function getUlid($username){
        $db= \Config\Database::connect();  //represent a connection to the database
        $builder=$db->table("user_learner");
        $builder->where("ul_name",$username);
        $query=$builder->get();
        $row=$query->getResult();
        return $row;

    }
    public function getCourseName($course_id){
        $db= \Config\Database::connect();  //represent a connection to the database
        $builder=$db->table("courses");
        $builder->where("course_id",$course_id);
        $query=$builder->get();
        $row=$query->getResult();
        return $row;
    }

    public function addCollection($ulid, $course_id, $course_name)
    {
        $db= \Config\Database::connect();
        $builder=$db->table("course_collection");
        $data=[
            "ulid"=>$ulid,
            "course_id"=>$course_id,
            "course_name"=>$course_name,
        ];

        $true_false=$builder->insert($data);
        return $true_false;

    }
    public function add_course_paid($coll_id)
    {
        $db= \Config\Database::connect();
        $builder=$db->table("course_collection");
        $builder->where("coll_id",$coll_id);
        $data=[
            "paid"=>"1",
        ];
        $true_false=$builder->update($data);
        return $true_false;
    }



}