<?php
namespace App\Models;  // a namespace that matches their location 
use CodeIgniter\Model; // is used to import "Model" class from codeIgniter.
class Textbook_model extends Model
{
    //for test not completed version
    public function getTextbook()
    {
        $db= \Config\Database::connect();  //represent a connection to the database
        $builder=$db->table("textbook");
        $query=$builder->get();
        $row=$query->getResult();
        if($row){
            return $row;
        }
    }
}