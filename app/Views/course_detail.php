<div class="container">
<div class="col mt-5 mb-5">
<h2 class="text-center mt-5 mb-5" name="course_name"><?php echo $course_name?> Course Details </h2>

<div class="bd-example-snippet bd-code-snippet"><div class="bd-example">
        <div class="row  row-cols-1 row-cols-1 g-2 ">
          
        <div class="col">
            <div class="card">
              <div class="card-body">
                <div class="mb-1">
                    <!--  img -->
                    <img src="<?php echo base_url().$course_img ?>" class="d-block  img-fluid" alt="Bootstrap Themes" width=100% height="300" loading="lazy">
                </div>
              </div>
            </div>
          </div>
        
          <!--upload file only for logged in educators  -->
          <?php if  (  (session()->get('e_usernamese')) || (isset($_COOKIE["e_username"]) && isset($_COOKIE["e_password"]))  ){ ?>
          <div class="col">
            <div class="card">
              <?php echo form_open_multipart( base_url()."course_detail/add_files"); ?> 
              <input name="course_id" value="<?php echo $course_id; ?>" style="visibility:hidden;">
              <div class="card-body ">
              <div class="d-flex">
                <span style="font-weight:500; font-size:1.25rem; white-space:nowrap;">Upload course materials:</span>
                <input class="form-control me-2 ms-4 d-flex" type="file" placeholder="upload files" name="course_materials[]" width="50" multiple>
                <button class="btn btn-outline-primary" type="submit">Upload</button>
              </div>

              </div>
              <?php echo form_close(); ?>
              </div>
          </div>
          <?php }?>

          <!-- show course materials list -->
          <div class="col">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">course attached files</h5>
              </div>
              <ul class="list-group list-group-flush">
                <?php if($files_data){ foreach ($files_data as $file_item){ ?>
                  <li class="list-group-item">
                    <a href="<?php if($file_item['file_ori_name']){echo base_url()."writable/uploads/course_file/".$file_item['file_new_name']; };?>"download><?php if($file_item['file_ori_name']){echo $file_item['file_ori_name']; } else{echo "no file yet";}?></a>
                  </li>
                <?PHP }} else{}?>


              </ul>
              </div>
              </div>


          <!--course information  -->
          <div class="col">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Course description</h5>
                <p class="card-text "><?php echo $course_des ?></p>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">course id: <strong class=""><?= $course_id?></strong></li>
                <li class="list-group-item">educator: <strong><?=$course_educator?>  </strong></li>
              </ul>
            </div>
          </div> 
      <!-- show comments -->
          <div class="col">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Comments</h5>
              </div>
              <ul class="list-group list-group-flush">

                <?php foreach ($comments as $comment){ ?>
                  <li class="list-group-item">
                    <strong><?php if($comment['ue_name']){echo $comment['ue_name']; } else{echo $comment['ul_name'];}?></strong> <span>:</span> <?php echo $comment['comments_text'];?> 
              
                  </li>
                <?PHP }?>


              </ul>
              </div>
          <!--add comments  -->
          </div>  
              <?php echo form_open( base_url()."course_detail/".$course_id ); ?> 
              <div class="card-body">
                <a href="#" class="card-link"></a>
                <textarea class="form-control form-control-lg" name="comments_text" type="text" placeholder="Enter your comment"></textarea>
                <button class="btn btn-primary" type="submit">Submit</button>
              </div>
              <?php echo form_close(); ?>


            </div>
          </div>



          



        </div>
        </div>
      </div>
</div>
</div>