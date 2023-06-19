<?php
namespace App\Controllers;

class Textbook extends BaseController
{
    public function index(){

        $model=new \App\Models\Textbook_model();
        $row=$model->getTextbook();
        $text_raw=$row[0]->tbook_content;  #only get the first one for showing scrolling down feature

        if( !$text_raw){
            echo view("template/header");
            $text="text raw not exist";
            echo view("textbook",["text",$text]);
        }
        
else{

        $text=nl2br($text_raw);  //nl2br() Insert line breaks where newlines (\n) occur in the string


        echo view("template/header");
        //echo $text;
        echo view("textbook",["text"=>$text]);
    }
    
    
    
    }


}


?>