<div class="container">
    <div class="col-12">
        <h2 class="text-center mt-5">Hello!  <?php echo $username ?> :) </h2>
        <a class="d-flex align-items-center mb-5" id="user_location" href="user_location" style="float:right"> <img src="<?php echo base_url()."writable/uploads/icon/icon_location.png" ?>" width="30" hight="30">Show my position</a>





        <div class="my-3" id="overview">
            <div class="bd-heading  align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
                <h3 class="mt-5">Profile</h3>
                <a class="d-flex align-items-center mb-1" id="edit_profile" href="#">Edit my profile</a>
            </div>
            <div>
                <div class="bd-example-snippet bd-code-snippet">
                    <div class="bd-example">
                        <!--Profile block  -->
                        <?php echo form_open( base_url().'profile' ); ?> 
                        <!--form_open_multipart()====> ['enctype' => 'multipart/form-data'] enable multi file type -->
                        <!-- form use thsi form to update user info-->
                            <div class="mb-3 border-bottom">
                                <label for="exampleInputEmail1" class="form-label mb-3 "><strong>Email:  </strong></label> <lable><?php echo $email ?></lable>
                                <input id="email_field" type="email" class="form-control"  aria-describedby="emailHelp" name="email" style="display: none">
                                </div>
                            </div>
                            <div class="mb-3 border-bottom">
                                <label for="exampleInputPhone" class="form-label mb-3"><strong>Phone number: +61 </strong></label>
                                <lable><?php echo $phone ?></lable>
                                <!-- check if number varified -->
                            <?php if ( session()->get('l_usernamese') || ( isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"]) ) ){ ?>
                                        <?php if ($verify==1) {?>
                                                                    <lable style="margin-left:50px;"><img src="<?php echo base_url()."writable/uploads/icon/icon_tick.png" ?>" width="30" hight="30">Verified</lable>
                                        <?php }else{ ?>
                                            <lable style="margin-left:50px;"><a href="<?= base_url()."profile/verify_number"; ?>">verify the number</a></lable>
                                        <?php } ?>
                            <?php }else{} ?>
                                <!-- check if number varified  end-->
                                <input id="phone_field" type="phone" class="form-control"  aria-describedby="phone" name="phone" style="display: none">
                            </div>
                            <div class="mb-3 border-bottom">
                                <label for="exampleInputPassword1" class="form-label mb-3"><strong>Password:  </strong></label><lable> ******** </lable>

                                

                                        <!-- check if secretquestion already set -->
                            <?php if ( session()->get('l_usernamese') || ( isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"]) ) ){ ?>
                                        <?php if ($sq_set==1) {?>
                                                                    <lable style="margin-left:50px;"><img src="<?php echo base_url()."writable/uploads/icon/icon_tick.png" ?>" width="30" hight="30">secret questions</lable>
                                        <?php }else{ ?>
                                            <lable style="margin-left:50px;"><a href="<?= base_url()."profile/secret_questions"; ?>">setup secret questions</a></lable>
                                        <?php } ?>
                            <?php }else{} ?>
                                        <!-- check if secretquestion already set end-->


                                <input id="password_field" type="password" class="form-control" name="password" style="display: none" >
                            </div>
                            

                            <div class="list-group-item  list-group-item-danger">
                            <?php echo validation_list_errors()?>
                            </div>

                            <button type="submit" class="btn btn-primary" id="save" style="display: none">Save</button>
                        <?php echo form_close(); ?>

                            <!-- profile image block -->    
                            <div class="bd-heading  align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
                                <h3 class="mt-5">Your profile image:</h3><label><?php //echo $profileimg ?></label>
                                <a class="d-flex align-items-center mb-2" id="edit_protrait" href="#">Upload a image</a>
                            </div>                             
                            <div class="mb-3 border-bottom">
                                <img src="<?php echo base_url().$profileimg ?>" class="d-block  img-fluid" alt="Bootstrap Themes" width="200" height="200" loading="lazy">
                            </div>
                            <?= form_open_multipart(base_url()."profile/image") ?>  
                            <div class="mb-3 border-bottom " id="image_field"  style="display: none">
                                <h5 class=" mb-3 form-label" ><span>Upload </span>   <button type="submit" class=" btn btn-primary" id="saveimg" style="display: none">Save</button></h5>
                                
                                <input type="file" size="20" class="form-control" id="portrait" name="portrait" accept=".png,.jpg,.jpeg,">
                            </div>
                            


                            <!-- Citing code  -->
                            <!-- The code snippet (1. drag and drop) below has been adapted from -->
                            <!-- I used a similar way to copy file to the dropzone, and changed the drop function to implement file uploading   -->
                            <!-- http://www.philliphaydon.com/2014/05/01/creating-a-drop-area-top-drop-a-file-in-html5/ -->
                            <!-- drag and drop try -->
                                <style>
                                    .zone_hover{background:#e9f5f8}
                                </style>
                                <div id="dropzone" style=" height: 200px; border: 3px dashed #ADD8E6 ;color:#ADD8E6;font-size:50px; font:bold; display: none; padding-left: 10px;">Drag and drop files here</div>
                                <script>
                                //get drop zone
                                //var protrait= document.getElementByName('portrait');
                                var dropzone = document.getElementById('dropzone');
                                //create listener for drag and drop 
                                dropzone.addEventListener('dragover', drag, false); //listener( action / function / whether the event should be captured )
                                dropzone.addEventListener('drop', drop, false);
                                dropzone.addEventListener('dragenter', zone_enter,false);  //hover style
                                dropzone.addEventListener('dragleave', zone_leave,false); 
                                

                                function zone_enter(ev){
                                    ev.currentTarget.classList.add('zone_hover');
                                };
                                function zone_leave(ev){
                                    ev.currentTarget.classList.remove('zone_hover');
                                };

                                //drag function()
                                function drag(ev) {
                                ev.preventDefault(); //stop the default function
                                ev.dataTransfer.dropEffect = 'copy';// to create a copy of the file
                                }
                                //drop function
                                function drop(ev) {
                                ev.preventDefault();
                                var portrait_input = document.getElementById('portrait'); //element name="portrait"
                                var file = ev.dataTransfer.files;  //the droped file
                                portrait_input.files = file; //js <input> .files property.
                                //ev.target.appendChild(portrait_input); //append the portrait_input file to the drop zone
                                }

                                </script>

                            <!-- drag and drop try  end -->

                            <!-- # End code snippet  (1. drag and drop)-->
                            
                            
                                <?php echo form_close(); ?>

                        
                    </div>
                </div>

            </div>



    </div>
</div>






<!-- toggle script jQuery-->
<!-- jQuery learning resource https://www.w3schools.com/jquery/eff_toggle.asp -->
<script> //
    $(document).ready(function() {
        $('#edit_profile').click(function(ev) {
            ev.preventDefault();
            $('#email_field').toggle();
            $('#phone_field').toggle();
            $('#password_field').toggle();
            $('#save').toggle();


        });
        $('#edit_protrait').click(function(ev) {
            ev.preventDefault();
            $('#image_field').toggle();
            $('#saveimg').toggle();
            $('#dropzone').toggle();
            

        });
    });
</script>