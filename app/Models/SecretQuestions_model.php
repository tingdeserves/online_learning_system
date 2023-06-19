<?php
namespace App\Models; 
use CodeIgniter\Model; 
class SecretQuestions_model extends Model
{
    public function if_sq_set($username){
        #1. query user_learner table get ulid 
        #2. query secret_q table, if anwer1 and anwser2 set, yes_>1, no->0 
        $db= \Config\Database::connect();  
        $builder= $db->table("user_learner"); 
        $builder->select();
        $builder->where("ul_name",$username);
        $query=$builder->get();
        $row=$query->getResult();
        $ulid=$row[0]->ulid;

        $builder_sq= $db->table("secret_q");
        $builder_sq->select();
        $builder_sq->where("ulid",$ulid);
        $query_sq=$builder_sq->get();
        $sq_set=$query_sq->getResultArray();
        if($sq_set!= null){
            return $sq_set=1;
        }
        else{
            return $sq_set=0;
        }

    }
    public function set_sq($username,$question1,$answer1,$question2,$answer2){
        #1. query user_learner table get ulid
        #2. insert  ulid, questions, answers into table"secret_q"
        $db= \Config\Database::connect();  
        $builder= $db->table("user_learner"); 
        $builder->select();
        $builder->where("ul_name",$username);
        $query=$builder->get();
        $row=$query->getResult();
        $ulid=$row[0]->ulid;

        $builder_sq= $db->table("secret_q"); 
        $sq_data=[
            "ulid"=>$ulid,
            "question1"=>$question1,
            "answer1"=>$answer1,
            "question2"=>$question2,
            "answer2"=>$answer2,
        ];
        $insert_result=$builder_sq->insert($sq_data);
        if($insert_result==True){
            return $insert_result=1;
        }
        else{
            return $insert_result=0;
        }
        
    }

    public function verify_username($username){

        $db= \Config\Database::connect();  
        $builder= $db->table("user_learner"); 
        $builder->select();
        $builder->where("ul_name",$username);
        $query=$builder->get();
        $row=$query->getResult();
        if($row==null ){
            $l_username=0;
            $data=["l_username"=>$l_username,];
            return $data;
        }
        else{
            $l_username=$row[0]->ul_name;
            $ulid=$row[0]->ulid;
            //query secret question table
            $builder2= $db->table("secret_q"); 
            $builder2->select();
            $builder2->where("ulid",$ulid);
            $query2=$builder2->get();
            $row2=$query2->getResult();
            if($row2 == null){
                $l_username=1; //username exist , but secret question not setup
                $data=["l_username"=>$l_username,];
                return $data;
            }else{
                $question1=$row2[0]->question1;
                $question2=$row2[0]->question2;
                $data=[
                    "l_username"=>$l_username,
                    "question1"=>$question1,
                    "question2"=>$question2,
                ];
                return $data;
            }
            
        }

    }
    public function verify_answers($username,$answer1,$answer2){
        //get ulid from user_learner table
        $db= \Config\Database::connect();  
        $builder= $db->table("user_learner"); 
        $builder->select();
        $builder->where("ul_name",$username);
        $query=$builder->get();
        $row=$query->getResult();
        if($row!=null){
            $ulid=$row[0]->ulid;
        }

        //query secret question table
        $builder2= $db->table("secret_q"); 
        $builder2->select();
        $builder2->where("ulid",$ulid);
        $query2=$builder2->get();
        $row2=$query2->getResult();
        if($row2 == null){
            return $check_result=0;  //no sqcret question
        }
        else{
            $sq_answer1=$row2[0]->answer1;
            $sq_answer2=$row2[0]->answer2;
        }
        if($sq_answer1==$answer1 && $sq_answer2==$answer2){
            return $check_result=1;  //success
        }
        else{
            return $check_result=2;  //incorrect
        }
    }

    public function update_password($l_username,$l_password){
        $db= \Config\Database::connect();  
        $builder= $db->table("user_learner");
        $builder->select("ul_name, ul_password");
        $builder->where("ul_name",$l_username);
        $data=[
            "ul_password"=>$l_password,
        ];
        $rows=$builder->update($data); 
        if($rows !=null){
            return 1;  //success
        }
        else{
            return 0;  //fail
        }

    }




}



?>