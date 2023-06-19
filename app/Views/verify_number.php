<div class="container text-center mt-5">
    <div class="col-12">
    <div class="my-3" id="overview">

<lable name="verify_group" class="mb-3">
   
<lable id="verified" style="margin-left: 30px" style="display: none"></lable>
<!-- add logic to show "verified" -->
<div name="verify_group" class="" id="verify_input" >
<a class=" ml-3 mr-5" id="verify_number" style="margin-right: 30px;" href="" onclick="verifyNumber()">Get Varification Code</a></lable>    
<input type="text" name="code" id="code" placeholder="code number">
    <button type="submit" class="btn btn-primary" onclick="varify_code()">submit</button>
</div>
</div>
</div>

</div>

<script>

//These lines are adopted from lesture-6 slides, I modified the function logic to implement "verify phone number"

    function verifyNumber(){
        event.preventDefault(); //prevent page reload
        var xhttp=new XMLHttpRequest();
        //send request
        xhttp.open("POST","<?php echo base_url().'profile/verify_number'; ?>",true);  // open(method, URL, true)
        xhttp.setRequestHeader("X-Requested-With","XMLHttpRequest");  
        xhttp.send();
        //get response
        xhttp.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                //alert("test");
               
                var sms_sent=this.responseText; //true ro false, sent message to number
                //console.log(sms_sent);
                if (sms_sent==1){
                    alert("verification code sent to your number!");
                }
                else{
                    alert("failed");
                }
            }
        };   
    }

    function varify_code(){
        var str=document.getElementById('code').value;
        event.preventDefault(); //prevent page reload
        var xhttp=new XMLHttpRequest();
        //send request    // open(method, URL, true)
        xhttp.open("POST","<?php echo base_url('profile/verify_code'); ?>?code="+str,true); 
        xhttp.setRequestHeader("X-Requested-With","XMLHttpRequest");  
        xhttp.send();        //retrieve data in controller using name
        //get response
        xhttp.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                var verified=this.responseText; //true ro false, sent message to number

                if (verified==1){
                    alert("Number verified!☆★");
                }
                else if(verified==0){
                    alert("Not correct. please try again! return number:"+verified);
                }
                else if(verified==9){
                    alert("failed to verify, please try again later! return number:"+verified);
                }


            }
        };   




    }
</script>



