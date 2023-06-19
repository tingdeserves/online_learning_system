<div class="container mt-5 mb-5">
    <div class="col-4 offset-4">
        <h2 class="text-center mb-5" id="Reset_pw_title">Reset Password</h2>
<!-- step 1 varify username -->
<div id="step1_all">
        <div class="mb-5">
            <p>Step 1</p>
            <div id="step1_input" style="">
                <label for="question1" class="form-label"><strong>Hi learner, what is your username?</strong></label>
                <input type="username" name="l_username" class="form-control mt-2" id="username">
                <p id="error_msg" style="color:red;"></p>
                <div class="form-group mt-3 d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                    <button type="submit" class="btn btn-primary btn-block " onclick="check_username()">Next</button>
                </div>
            </div>
            <label for="question1" class="form-label" style="display:none" id="step1_done">
                <strong> Hi, </strong>
                <strong id="l_username"></strong>
            </label>
        </div>
</div>

<!-- step 2 submit answers -->

<input name="l_username" id="step2_username" style="visibility:hidden">
<div id="step2_input" style="display:none">
        <div class="mb-5">
            <p>Step 2</p>
            <label for="question1" class="form-label"><strong>Question-One: </strong></label>
            <lable id="question1"><?php //echo $question1 ?></lable>
            <input type="text" name="answer1" class="form-control mt-2" id="answer-1" placeholder="Answer:">
        </div>

        <div class="mb-5">
            <label for="question2" class="form-label"><strong>Question-Two: </strong></label>
            <lable id="question2" ><?php //echo $question2 ?></lable>
            <input type="text" name="answer2" class="form-control mt-2" id="answer-2" placeholder="Answer:">
        </div>
        <p id="error_msg_2" style="color:red;"></p>
        <div class="form-group mt-3 d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
            <button type="submit" class="btn btn-primary btn-block " onclick="check_answers()">Submit</button>
        </div>
</div>

<!-- step 3 setup new password -->

<input name="l_username" id="step3_username" style="visibility:hidden">
<div id="step3_input" style="display:none">
        <div class="mb-5">
            <p style="color:green">secret questions correct</p>
            <label for="reset_password" class="form-label"><strong>Create your new password: </strong></label>
            <input type="password" name="password" class="form-control mt-2" id="password" placeholder="">
        </div>
        <p id="error_msg_3" style="color:red;"></p>
        <div class="form-group mt-3 d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
            <?php //echo validation_list_errors() ?>
            <button type="submit" class="btn btn-primary btn-block " onclick="submit_new_pw()">Submit</button>
        </div>
</div>

<!-- success msg -->
<div class="mt-5 mb-5" id="success_msg" style="display:none;">
    <div class="text-center">
        <img src="<?php echo base_url()."writable/uploads/icon/icon_tick.png"?>" width="50" height="50">
        <h2 class="text-center mb-5">Password reset successfully!</h2>
        <p class="lead">
        <a href="<?php echo base_url().'learner_login';?>" class="btn btn-lg btn-light fw-bold border-white bg-white"><button type="button" class="btn btn-primary btn-lg px-4 me-sm-3">Learner Login</button></a>
    </div>
</div>

<!-- end -->
    </div>
</div>







<!-- scripts -->
<!-- step 1 script: check username existance-->
<script>
    function check_username() {
        var str = document.getElementById('username').value;
        if(str==false){
            return document.getElementById("error_msg").innerHTML =
                    "please enter your username"; //error message;
        }
        event.preventDefault(); //prevent page reload
        var xhttp = new XMLHttpRequest();
        //send request
        xhttp.open("POST", "<?php echo base_url().'learner_login/password_reset/verify_username'; ?>?username=" + str,
            true); // open(method, URL, true)
        xhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xhttp.send();
        //get response
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var $data = this.responseText;
                $data=JSON.parse($data);   // convert JSON to string array
                //alert ($data);
                if($data=="0"){  //no username found
                    document.getElementById("error_msg").innerHTML =
                    "Sorry, cannot find your username."; //error message;
                }
                else if($data=="1"){  //answers not match
                    document.getElementById("error_msg").innerHTML =
                    "You didn't setup your secret questions, please contact customer service +0123456789"; //error message;
                }

                else if($data["l_username"] !=0 && $data["l_username"]!=1 ){
                    document.getElementById("l_username").innerHTML = $data["l_username"];
                    document.getElementById("step1_input").style.display = "none";
                    document.getElementById("step1_done").style.display = "block";
                    document.getElementById("step2_input").style.display = "block";
                    document.getElementById("question1").innerHTML = $data["question1"];
                    document.getElementById("question2").innerHTML = $data["question2"];
                    document.getElementById("step2_username").value = $data["l_username"];
                    
                } 

            }
        }
    }
    //JSON.parse() example about how to use JSON.parse() from w3school-javascript
    //const txt = '{"name":"John", "age":30, "city":"New York"}'
    //const obj = JSON.parse(txt);
    //document.getElementById("demo").innerHTML = obj.name + ", " + obj.age;
</script>

<!-- setp 2 script: verify secret questions/anwsers-->
<script>
function check_answers() {
    event.preventDefault(); //prevent page reload
        var username = document.getElementById('step2_username').value;
        var answer1 = document.getElementById('answer-1').value;
        var answer2 = document.getElementById('answer-2').value;
        var xhttp2 = new XMLHttpRequest();

        //send request
        xhttp2.open("POST", "<?php echo base_url() . 'learner_login/password_reset/verify_answers'; ?> ?l_username=" + username+"&answer1="+answer1+"&answer2="+answer2,true); // open(method, URL, true)   
        //variable in url, format: key1=value1&key2=value2&key3=value3
        xhttp2.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xhttp2.send();

        //get response
        xhttp2.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var $result = this.responseText;
                $result = JSON.parse($result);
                if ($result == 0) {
                    document.getElementById("error_msg_2").innerHTML = "You didn't setup your secret questions, please contact customer service +0123456789 to reset password"; //error message;
                }
                else if($result == 1){
                    //document.getElementById("error_msg_2").innerHTML = "good job!!!! redirect to the reset password page";
                    //window.location.replace("<?php // echo base_url()."learner_login/password_reset/form" ?>");
                    document.getElementById("step3_username").value = document.getElementById("step2_username").value;
                    document.getElementById("step1_all").style.display = "none";
                    document.getElementById("step2_input").style.display = "none";
                    document.getElementById("step3_input").style.display = "block";

                }
                else if($result == 2){
                    document.getElementById("error_msg_2").innerHTML = "Sorry, your answers are not correct."; //error message;
                }
            }
        }


    }
    </script>

<!-- step 3 script: reset password-->
<script>
function submit_new_pw(){
    event.preventDefault(); //prevent page reload
    var username = document.getElementById('step2_username').value;
    var password = document.getElementById('password').value;

    if ( username != null && password != null ){
        //alert(username);
        //alert(password);
        var xhttp3 = new XMLHttpRequest();
        xhttp3.open("POST", "<?php echo base_url() . 'learner_login/password_reset/submit_new_pw'; ?> ?l_username=" + username+"&l_password="+password,true); // open(method, URL, true)   
        xhttp3.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xhttp3.send();
        
    }

    xhttp3.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var $result = this.responseText;
                $result = JSON.parse($result);
                //$result 9-validation fail; 0-update pw fail; 1-success;
                //alert( $result );
                if($result== 9){
                    document.getElementById("error_msg_3").innerHTML = "Password MUST be alpha-numeric"; //error message;
                }
                else if($result== 0){
                    document.getElementById("error_msg_3").innerHTML = "Failed to update the password, please try again later."; //error message;
                }
                else if($result== 1){
                    //successfully page
                    document.getElementById("error_msg_3").innerHTML = "";
                    //window.location.href = "";
                    document.getElementById("step3_input").style.display = "none";
                    document.getElementById("success_msg").style.display = "block";
                    document.getElementById("Reset_pw_title").style.display = "none";

                }

            }
        }



}




</script>