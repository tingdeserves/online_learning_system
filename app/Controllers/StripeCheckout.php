<?php
namespace App\Controllers;

class StripeCheckout extends BaseController
{

    public function index(){
      $session=session();
      $username=$session->get("l_usernamese");
      if(isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])){
          $username=$_COOKIE["l_username"];
      }
      if($username != null){
        echo view("template/header");
        echo view("checkout_page");
        echo view("template/footer");
      }
      else{
        echo view("template/header");
        echo "<h1>Please login.</h1>";
        echo view("template/footer");
      }
    }
    public function success(){
      echo view("template/header");
      echo view("blank_page/checkout_success");
      echo view("template/footer");
    }
    public function cancel(){
      echo view("template/header");
      echo view("blank_page/checkout_cancel");
      echo view("template/footer");
    }

    public function checkout_process(){
      $session=session();
      $username=$session->get("l_usernamese");
      if(isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])){
          $username=$_COOKIE["l_username"];
      }
      if(!$username){
        echo "no username found";
      }
      //get course id from the post form
      $coll_id=$this->request->getPost('pay_collection_id');
      //$coll_id="7";
      if(!$coll_id){
          echo "no course_id found";
      }

      if($username != null){

        $model=new \App\Models\Profile_model();
        $row=$model->getinfol($username); //$username = $row[0]->ul_name;
        $email=$row[0]->ul_email;


# Citing code 
# The code snippet (1. online-payment using Stripe) below has been adapted from Stripe quickstart example
# https://stripe.com/docs/checkout/quickstart?lang=php
# I have changed it to fit MVC pattern and added prefill email address for the checkout session.

        require_once '../vendor/autoload.php';
        require_once '../secrets.php'; //created and placed in the root path

        \Stripe\Stripe::setApiKey($stripeSecretKey);
        header('Content-Type: application/json');

        $YOUR_DOMAIN = base_url();   //myproj domain

        $checkout_session = \Stripe\Checkout\Session::create([ 
          'customer_email' => $email, //prefill email
          'line_items' => [[
            'price' => 'price_1N3fHcIHPf4hCKyYuE354QrL',   //one time price
            'quantity' => 1,
          ]],
          'mode' => 'payment',
          'success_url' => $YOUR_DOMAIN . 'checkout_success?session_id={CHECKOUT_SESSION_ID}&coll_id='.$coll_id,
          'cancel_url' => $YOUR_DOMAIN . 'checkout_cancel',
        ]);

        header("HTTP/1.1 303 See Other");
        header("Location: " . $checkout_session->url);
# End code snippet (1. online-payment using Stripe) 

      }
      else{
        echo view("template/header");
        echo "<h1>Please login.</h1>";
        echo view("template/footer");
      }
    }
}

//test card numbers
//4242 4242 4242 4242         success
//4000 0025 0000 3155         require authentication
//4000 0000 0000 9995         declined


