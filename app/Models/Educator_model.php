<?php
namespace App\Models; 
use CodeIgniter\Model;
class Educator_model extends Model
{
    public function login($username, $password)
    {
        $db= \Config\Database::connect();  //represent a connection to the database
        $builder= $db->table("user_educator"); //table() function is used to specify the name of the database table to query, returns Builder object
        $builder->where("ue_name",$username); //use where() specify conditions. condition 1
        $builder->where("ue_password",$password);  //condition 2
        $query=$builder->get();  //get()function retrive the rows match the above two conditions
        if($query->getRowArray()){  //retrive a single row as an associative array
            return true;
        }else{
            return false;
        }
    }
}

?>