<?php 
namespace App\Controllers;
class Try_AJAX extends BaseController{

public function index(){
    echo view("try_ajax");
}

public function getAJAXResult(){
    $request=$this->request;

    $session=session();
    $username=$session->get("l_usernamese");
    if(isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])){
        $username=$_COOKIE["l_username"];
    }
    //if($request->is('get')){}
    if($request->isAJAX()){
        //echo "AJAX is working!";
        $pubs=[
            "111"=>"one",
            "222"=>"two",
        ];
        //$response=[
        //    "status"=>true,
        //    "message"=>"this is ajax response",
        //    "allpubs"=>$pubs,
        //];
        header("Content-Type: application/json");
        echo json_encode($pubs);

    }


    

}
}


?>