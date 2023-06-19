
<div class="container mt-5 mb-5">
    <div class="col-lg-6 mx-auto">
        <div class="text-center">
            <img src="<?php echo base_url()."writable/uploads/icon/icon_tick.png"?>" width="50" height="50">
            <h1 class="mb-5">Done successfully!</h1>
        </div>
    </div>
</div>

<?php
$session_id = $_GET['session_id'];
$coll_id=$_GET['coll_id'];

//Stripe api retrieve payment status
require_once '../vendor/autoload.php';
require_once '../secrets.php';
\Stripe\Stripe::setApiKey($stripeSecretKey);
$checkout_session = \Stripe\Checkout\Session::retrieve($session_id);
$payment_status = $checkout_session->payment_status;
//stripe api end

//echo "Payment status: " . $payment_status;

//payment_status is from "checkout session object".
if ($payment_status=="paid"){
    $model=new \App\Models\Collection_model();
    $true_false=$model->add_course_paid($coll_id); 
    if ($true_false== True){
        echo "success";
    }
    else{
        echo "fail";
    }
}
?>