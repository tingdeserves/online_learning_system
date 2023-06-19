<?php

namespace App\Controllers;
use Vonage\Client\Credentials\Basic;
use Vonage\Client;

class Profile extends BaseController
{
    public function index()
    { 
        //ask browser not to cache content
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');

        //educator - get info
        $session=session();
        $username=$session->get("e_usernamese");
        if(isset($_COOKIE["e_username"]) && isset($_COOKIE["e_password"])){
            $username=$_COOKIE["e_username"];
        }
        if($username==True){
            $model=new \App\Models\Profile_model();
            $row=$model->getinfoe($username);
            $output=[
                    "username"=>$row[0]->ue_name,
                    "email"=>$row[0]->ue_email,
                    "phone"=>$row[0]->ue_phone,
                    "profileimg"=>$row[0]->ue_profileimg,
                    "sq_set"=>"0",

            ];

        }
        //learner - get info
        if($username==False){
            $username=$session->get("l_usernamese");
            if(isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])){
                $username=$_COOKIE["l_username"];
            }
            $model=new \App\Models\Profile_model();
            $row=$model->getinfol($username); //$username = $row[0]->ul_name;
            $model2=new \App\Models\SecretQuestions_model();
            $sq_set=$model2->if_sq_set($username);  //$sq_set ==1 set, $sq_set ==0 not set

            $output=[
                "username"=>$row[0]->ul_name,
                "email"=>$row[0]->ul_email,
                "phone"=>$row[0]->ul_phone,
                "profileimg"=>$row[0]->ul_profileimg,
                "verify"=>$row[0]->verify,
                "sq_set"=>$sq_set,
        ];
        }

        echo view('template/header');
        echo view('profile',$output);
        echo view('template/footer');
    }

    public function updateprofile()
    {
        
        //ask browser not to cache content
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
                
        $rules = [            
            "email"=>"required|valid_email",
            "phone"=>"required|numeric|min_length[10]|max_length[10]",
            "password"=>"required|alpha_numeric",
            //"portrait"=>"ext_in[image,jpg,jpeg,png,gif]",
        ];        
        
        if(! $this->request->is('post')){
            $this->index(); 
        }
        if( ! $this->validate($rules) ){
            $this->index(); 
          
        }

        else{ //update database throhgh progile model
            //grab info from View
            $email = $this->request->getPost('email');
            $phone = $this->request->getPost('phone');
            $password = $this->request->getPost('password');
            $session=session();
            $username=$session->get("e_usernamese");
            if(isset($_COOKIE["e_username"]) && isset($_COOKIE["e_password"])){
                $username=$_COOKIE["e_username"];
            }
            //educator
            if ($username == True){
            //save data to $profile_data
            $table="educator";
            $profile_data = [
                "ue_email" => $email ,
                "ue_phone" => $phone,
                "ue_password" => $password,
                //"ue_profileimg"=>$profileimg,
            ];
        }
            //learner
            if ($username == False){
                $username=$session->get("l_usernamese");
                if(isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])){
                    $username=$_COOKIE["l_username"];
                }
                $table="learner";
                $profile_data = [
                    "ul_email" => $email ,
                    "ul_phone" => $phone,
                    "ul_password" => $password,
                    //"ul_profileimg"=>$profileimg,
                ];
            }
            //update database using $profile_data
            $model=new \App\Models\Profile_model();
            $row=$model->updateinfo($table, $profile_data, $username); //updated-true, not updated-false
            $this->index();  //call index() will reload the page
        }
    }

    public function updatePortrait(){

        //ask browser not to cache content
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');

        if(! $this->request->is('post')){
            $this->index(); 
        }

        $portrait =$this->request->getFile("portrait"); //get user imgage.jpg
        $extension = $portrait->getExtension();  //get file extension
        //echo $extension;
        //echo "<br>";
        $session=session();
        $username=$session->get("e_usernamese");
        if(isset($_COOKIE["e_username"]) && isset($_COOKIE["e_password"])){
            $username=$_COOKIE["e_username"];
        }
        //educator
        if ($username == True){
            $fileName=$username."_profile.".$extension; // eg:apple_profile.png
            $portrait->move(WRITEPATH . "uploads", $fileName,true);//true - overwrite old file(same name)
            $profileimg='writable/uploads/'.$fileName; //path ->to database
            $model=new \App\Models\Profile_model();
            $row=$model->peofilee($username,$profileimg); //$row:true/false
            $this->index();  //call index() will reload the page

        }
        //learner
        if ($username == False){
            $username=$session->get("l_usernamese");
            if(isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])){
                $username=$_COOKIE["l_username"];
            }
            $fileName=$username."_profile.".$extension; // eg:apple_profile.png
            $portrait->move(WRITEPATH . "uploads", $fileName,true);//true - overwrite old file(same name)
            $profileimg='writable/uploads/'.$fileName; //path ->to database
            $model=new \App\Models\Profile_model();
            $row=$model->peofilel($username,$profileimg); //$row:true/false
            $this->index();  //call index() will reload the page

        }

    }
    public function verifyIndex(){

        echo view('template/header');
        echo view('verify_number');
        echo view('template/footer');
        
    }




    //phone varification ONLY for learner
    public function verifyPhone(){
        #1.receive AJAX request, 2.send code9876 to phone number 3.response status 
        //get phone number
        $session=session();
        $username=$session->get("l_usernamese");
        if(isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])){
            $username=$_COOKIE["l_username"];
        }
        $model=new \App\Models\Profile_model();
        $row=$model->getinfol($username); //$username = $row[0]->ul_name;
        $phone_number=$row[0]->ul_phone; //420910347
        $phone_number="61".$phone_number; //"61420910347"
        //$phone_number=intval($phone_number); //61420910347

        //echo $phone_number;
        
        $request=$this->request;
        if($request->isAJAX()){
           
        # Citing code 
        # The code snippet (1. send SMS using Vonage) below has been adapted from Vonage-Try the SMS API
        # https://dashboard.nexmo.com/getting-started/sms
        # I have changed the return $sms_sent variable instead of print messages.

        require_once '/var/www/htdocs/myproj/vendor/autoload.php';
        $basic  = new \Vonage\Client\Credentials\Basic("2ff81d6e", "w8adzg5uKezyd0BZ");
        $client = new \Vonage\Client($basic);
        $response = $client->sms()->send(
            //new \Vonage\SMS\Message\SMS("61420910347", "test", 'Varification Code: 9876')
            new \Vonage\SMS\Message\SMS($phone_number, "test", 'Varification Code: 7202')
        );
        $message = $response->current();
        if ($message->getStatus() == 0) {
            $sms_sent=1;   //echo "The message was sent successfully\n";
        } else {
            $sms_sent=0;   //echo "The message failed with status: " . $message->getStatus() . "\n";
        }
        # End code snippet (1. send SMS using Vonage)
           
            header("Content-Type: application/json");
            echo json_encode($sms_sent);

        }
    }
    public function verifyCode(){
        #1.receive AJAX request, 2. check if the code is correct9876 3.save "verified" to database user_learner 4.return database insert status
        $session=session();
        $username=$session->get("l_usernamese");
        if(isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])){
            $username=$_COOKIE["l_username"];
        }

        if($this->request->isAJAX()){
            //$str = $_POST['verification_code'];
            //$str = $this->request->getPost(); 
            $code = $_REQUEST["code"];
        }

        if($code=="7202"){
            $model=new \App\Models\VerifyNumber_model();
            $verify_row=$model->verify_number($username);
            //echo $verify_row;

            if($verify_row==True){
                $verified=1;
                echo json_encode($verified);
            }
            else if($verify_row==False){
                $verified=0;
                echo json_encode($verified);
            }
            else if($verify_row=="no_exist"){
                $verified=9;
                echo json_encode($verified);
            }


        }        
        if($code== null ){
            echo json_encode("test, something is wrong");
        }
    
    }

    public function sq_form(){
        $session=session();
        $username=$session->get("l_usernamese");
        if(isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])){
            $username=$_COOKIE["l_username"];
        }
        if($username){
        echo view('template/header');
        echo view('secret_questions');
        echo view('template/footer');
        }
    }

    public function insert_sq(){
        #0.create set_up_questions View page/ and Routes.php
        #1.get request questions and anwers from Views
        #2.pass variables to Model SecretQuestions_model->set_sq()
        #3.insert_result==1, echo successfully, insert_result==0, show message
        $session=session();
        $username=$session->get("l_usernamese");
        if(isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])){
            $username=$_COOKIE["l_username"];
        }
        if($username){
            $question1=$this->request->getPOST("question1");
            $answer1=$this->request->getPOST("answer1");
            $question2=$this->request->getPOST("question2");
            $answer2=$this->request->getPOST("answer2");

            $model=new \App\Models\SecretQuestions_model();
            $insert_result=$model->set_sq($username,$question1,$answer1,$question2,$answer2);
            if($insert_result==1){
                echo view('template/header');
                echo view("blank_page/success");
                echo view('template/footer');
            }
            else{
                echo view('template/header');
                echo view("blank_page/failed");
                echo view('template/footer');
            }
        }

    }

        
   





}
