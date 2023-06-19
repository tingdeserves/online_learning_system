<?php
namespace App\Models;  // a namespace that matches their location 
use CodeIgniter\Model; // is used to import "Model" class from codeIgniter.
class Profile_model extends Model
{
    public function updateinfo($table, $profile_data,$username)
    {
        $db= \Config\Database::connect();  //represent a connection to the database
        //if educator
        if ($table=="educator"){
            $builder= $db->table("user_educator"); //table() function is used to specify the name of the database table to query, returns Builder object
            $builder->select('ueid,ue_email, ue_phone, ue_password, ue_profileimg');
            $builder->where("ue_name",$username); //filter "username" in users database          
            $rows = $builder->update($profile_data); //return how many rows updated
            if ($rows==True){
                return true;
            }else{
                return false;
            }

        }
        //if learner
        if ($table=="learner"){
            $builder= $db->table("user_learner"); //table() function is used to specify the name of the database table to query, returns Builder object
            $builder->select('ueid,ul_email, ul_phone, ul_password, ul_profileimg');
            $builder->where("ul_name",$username); //filter "username" in users database
            //$builder->update($profile_data);
            $rows = $builder->update($profile_data);
            if ($rows==True){
                return true;
            }else{
                return false;
            }
        }

    }
    //get educator info
    public function getinfoe($username)
    {
        $db= \Config\Database::connect(); 
        $builder= $db->table("user_educator"); 
        $builder->select('ue_name, ue_email, ue_phone, ue_profileimg,ueid');
        $builder->where("ue_name",$username); 
        $query=$builder->get();
        $row=$query->getResult();  //$username = $row[0]->ul_name;
        //return the $row        
        if ($row){
            return $row;
        }
        
    }
    //get learner info
    public function getinfol($username)
    {
        $db= \Config\Database::connect();
        $builder= $db->table("user_learner"); 
        $builder->select('ul_name, ul_email, ul_phone, ul_profileimg,verify');
        $builder->where("ul_name",$username); 
        $query=$builder->get();
        $row=$query->getResult();
        //return the $row        
        if ($row==True){
            return $row;
            }
    }

    //update educator profile
    public function peofilee($username, $profileimg){ 

        //ask browser not to cache content
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');

        $db= \Config\Database::connect(); 
        $builder= $db->table("user_educator"); 
        $builder->select('ue_profileimg');
        $builder->where("ue_name",$username); 
        $rows = $builder->update(["ue_profileimg"=>$profileimg]);

    }

    //update learner profile
    public function peofilel($username,$profileimg){

        //ask browser not to cache content
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');

        $db= \Config\Database::connect(); 
        $builder= $db->table("user_learner"); 
        $builder->select('ul_profileimg');
        $builder->where("ul_name",$username); 
        $rows = $builder->update(["ul_profileimg"=>$profileimg]);


    }




}



?>



