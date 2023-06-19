<?php
namespace App\Models;  // a namespace that matches their location 
use CodeIgniter\Model; // is used to import "Model" class from codeIgniter.
class VerifyNumber_model extends Model
{
    public function verify_number($username)
    {
     $db= \Config\Database::connect();
     $builder= $db->table("user_learner"); //table() function is used to specify the name of the database table to query, returns Builder object
     $builder->select('verify'); 
     $builder->where('ul_name',$username); 
    // $verify=[
    //    "verify"=>1,
    // ];
     $status=$builder->update(["verify"=>1]);
     if ($status==True ){
        return true;
     }
     if ($status==False ){
        return False;
     }
     if ($status== Null ){
        return "no_exist";
     }

    }
}