<!-- try ajax -->
<!--this code snippet is adoped lecture-6 slides-->

<script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>

<h5> h5: try ajax</h5>
<button onclick="sendRequest()"> Send AJAX Request</button>
<div id="ajaxResponse"> </div>

<script>
function sendRequest() {
    var xhttp=new XMLHttpRequest();
    //send request
    xhttp.open("POST","<?php echo site_url('try_ajax'); ?>",true);  // open(method, URL, true)
    xhttp.setRequestHeader("X-Requested-With","XMLHttpRequest");  
    //xhttp.responseType="json";
    xhttp.send();
    //get response
    xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
            alert("response received!");
            var pubs=this.responseText; //all the echo from controller include the "AJAX is working"
            //var pubs=JSON.parse(pubs); //parse json to js object
            document.getElementById("ajaxResponse").innerHTML=pubs;
            //document.getElementById("ajaxResponse").innerHTML=pubs["111"];
        }
    };
  }

</script>

