<?php
namespace App\Models; 
use CodeIgniter\Model;
class Register_model extends Model
{
    public function register($username, $email, $phone, $password, $role )
    {
        $db= \Config\Database::connect(); 
                
        if ($role=="learner"){
            $data=[
                "ul_name"=>$username,
                "ul_password"=>$password,
                "ul_email"=>$email,
                "ul_phone"=>$phone,
            ];
            $builder= $db->table("user_learner");
            $true_false=$builder->insert($data);
            if($true_false){  
                return true;
            }else{
                return false;
            }
        }
        if($role=="educator"){
            $data=[
                "ue_name"=>$username,
                "ue_password"=>$password,
                "ue_email"=>$email,
                "ue_phone"=>$phone,
            ];
            $builder= $db->table("user_educator");
            $true_false=$builder->insert($data);
            if($true_false){  
                return true;
            }else{
                return false;
            }

        }
    }
    public function checkUnique($username, $email, $phone, $role ){
        $db= \Config\Database::connect(); 
        
        if ($role=="learner"){
            $data=[
                "ul_name"=>$username,
                "ul_email"=>$email,
                "ul_phone"=>$phone,
            ];
            $builder= $db->table("user_learner");
            $builder->select();
            $builder->where("ul_name",$username);
            $builder->orWhere("ul_email",$email);
            $builder->orWhere("ul_phone",$phone);
            $query=$builder->get();
            $row=$query->getResult();            

            if ($row > 0) {
                return $row; // Return the duplicate value or None
            }
        }

        if ($role=="educator"){
            $data=[
                "ue_name"=>$username,
                "ue_email"=>$email,
                "ue_phone"=>$phone,
            ];
            $builder= $db->table("user_educator");
            $builder->select();
            $builder->where("ue_name",$username);
            $builder->orWhere("ue_email",$email);
            $builder->orWhere("ue_phone",$phone);
            $query=$builder->get();
            $row=$query->getResult();            

            if ($row > 0) {
                return $row; // Return the duplicate value or None
            }
        }
    }



}

?>