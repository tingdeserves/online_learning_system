<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Learning System</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script> 
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"><!-- auto complete jquery css -->

</head>


<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light bu-body-tertiary sticky-xl-top" style="z-index:30">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url(); ?>" >INFS7202 Online Learning System</a>
            <!-- the toggler collapse when the window is small -->
            <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation" >
                <span class="navbar-toggler-icon"></span>
            </button>



            <!--the nav bar main tabs-->
            <div class="collapse navbar-collapse" id="navbarsExample01">
                <ul class="navbar-nav mr-auto me-auto">
                    <li class="nav-item">
                        <a class="mx-4 nav-link" href="<?php echo base_url(); ?>"> Home </a>
                    </li>
                    
                       <!-- if learner sesssion run learner logout; -->
                    <?php if (  (session()->get('l_usernamese')) || (isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"])) ) { ?> 
                    <li class="nav-item">
                        <a class="mx-4 nav-link" href="<?php echo base_url(); ?>learner_workplace"> Learner Workplace </a>
                    </li>
                    <li class="nav-item">   
                        <a class="mx-4 nav-link" href="<?php echo base_url(); ?>profile"> Profile </a>    
                    </li>
                    <li class="nav-item">   
                        <a class="mx-4 nav-link" href="<?php echo base_url(); ?>courses_list"> Courses </a>    
                    </li>
                    <li class="nav-item">   
                        <a class="mx-4 nav-link" href="<?php echo base_url(); ?>learner_login/logout"> Logout </a>    
                    </li>

                        <!-- if educator sesssion run educator logout  -->
                    <?php } else if  (  (session()->get('e_usernamese')) || (isset($_COOKIE["e_username"]) && isset($_COOKIE["e_password"]))  ){ ?>
                    <li class="nav-item">
                        <a class="mx-4 nav-link" href="<?php echo base_url(); ?>educator_workplace"> Educator Workplace </a>
                    </li>
                    <li class="nav-item">   
                        <a class="mx-4 nav-link" href="<?php echo base_url(); ?>profile"> Profile </a>    
                    </li>
                    <li class="nav-item">   
                        <a class="mx-4 nav-link" href="<?php echo base_url(); ?>courses_list"> Courses </a>    
                    </li>
                    <li class="nav-item">
                        <a class="mx-4 nav-link" href="<?php echo base_url(); ?>educator_login/logout"> Logout </a>                    
                    </li>

                    <?php } else { ?>

                    
                    <li class="nav-item">
                        <a class="mx-4 nav-link" href="<?php echo base_url(); ?>educator_login"> Educator Login </a>
                    </li>
                    <li class="nav-item">
                        <a class="mx-4 nav-link" href="<?php echo base_url(); ?>learner_login"> Learner Login </a>
                    </li>
                    <li class="nav-item">
                        <a class="mx-4 nav-link" href="<?php echo base_url(); ?>register"> Register </a>
                    </li>
                    <?php } ?>
                    
                </ul>
                <!--the search component-->
                <!--<form class="d-flex" role="search">-->
                    <?php echo form_open(base_url().'search_results',  array('method'=>'post', 'class'=>'d-flex')); ?>
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="course" name="search_input">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    <?php echo form_close(); ?>
                    <!--</form>-->

     
            </div>
        </div>
    </nav>



<!-- autocomplete script start-->
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    var course_data;
    $("#course").mousedown( get_course_list);

    function get_course_list(event){
        var xhttp3 = new XMLHttpRequest();
        xhttp3.open("POST", "<?php echo base_url().'auto_complete'; ?>",true ); // open(method, URL, true)   
        xhttp3.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xhttp3.send();
            
        xhttp3.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                course_data = this.responseText;
                course_data = JSON.parse(course_data);   //convert JSON to string array
                //alert( course_data );

                //call jquery autocomplete() function
                $( function() {
                $( "#course" ).autocomplete({   
                    source: course_data
                });
                $( "#course" ).css('z-index', 100);
                } );
            }
        } 
    }
</script>
<!-- autocomplete script end-->

