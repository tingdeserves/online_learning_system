

<div class="px-4 pt-5 mt-5 text-center border-bottom">
    <h1 class="display-4 fw-bold text-body-emphasis">My Online Learning System :)</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">This is a web-based online learning system, which allows the educator and learner to interact online. </p>
      <p> <a href="<?php echo base_url()."textbook"; ?>">Free resources - Textbook </a></p>
      
      <!-- resize image -->
      <?= form_open_multipart(base_url()) ?>  
        <div >
          <?php if($rotateImagePath=="#"){ ?>
          <img src="<?= base_url().$imagePath ?>" name="resize_img" class="block floid"style="width:100%; ">
          <?php }?>
          <?php if($rotateImagePath!="#"){ ?>
          <img src="<?php echo $rotateImagePath ?>" name="resize_img" style=" ">

          <?php }?>
        </div>
        <button class="btn-outline-primary btn mt-2"> Collapse the Image </button>
      <?php echo form_close(); ?>

      <?php if ( session()->get('l_usernamese') ||session()->get('e_usernamese') || ( isset($_COOKIE["e_username"]) && isset($_COOKIE["e_password"]) ) || ( isset($_COOKIE["l_username"]) && isset($_COOKIE["l_password"]) ) ){   ?> 
      <?php } else { ?>
   
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
        <a href="<?php echo base_url(); ?>educator_login"><button type="button" class="btn btn-primary btn-lg px-4 me-sm-3">Educator Login</button></a>
        <a href="<?php echo base_url(); ?>learner_login"><button type="button" class="btn btn-secondary btn-lg px-4 me-sm-3">Learner Login</button></a>
      </div>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
        <a href="<?php echo base_url(); ?>register"><button type="button" class="btn btn-outline-primary btn-lg px-4">Register</button></a>
      </div>
      <?php } ?>

    </div>
    <div class="overflow-hidden" style="max-height: 30vh;">
      <div class="container px-5">
        <!--<img src="bootstrap-docs.png" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">-->
      </div>
    </div>
  </div>
    





