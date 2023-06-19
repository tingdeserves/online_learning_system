<?php 
namespace App\Models;
use CodeIgniter\Model;
class Upload_model extends Model
{
    public function upload($title, $filename)
    {
        $file=[
            "title"=>$title,
            "filename"=>$filename,
        ];
        $db=\Config\Database::connect();
        $builder=$db->table("FileUpload");  //create builder for table "FileUpload"
        if($builder->insert($file)){
            return true;
        }else{
            return false;
        }
    }
}



?>