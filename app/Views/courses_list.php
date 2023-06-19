<div class="container">
  <div class="col-12 mt-5 mb-5">
    <h2 class="text-center mt-5 mb-5">Courses list </h2>
    <div  class=" d-flex justify-content-end">
      <span style="color:dodgerblue">Order by:</span>
        <?php echo form_open( base_url().'courses_list/a_z' );?>
          <button class="btn btn-outline-primary ms-2"  > a-z</button>
        <?php echo form_close(); ?>
        <?php echo form_open( base_url().'courses_list/z_a' );?>
          <button class="btn btn-outline-primary ms-2" > z-a</button>
        <?php echo form_close(); ?>
        <?php echo form_open( base_url().'courses_list/id_asc' );?>
          <button class="btn btn-outline-primary ms-2" > id_asc</button>
        <?php echo form_close(); ?>
        <?php echo form_open( base_url().'courses_list/id_des' );?>
          <button class="btn btn-outline-primary ms-2" > id_des</button>
        <?php echo form_close(); ?>
    </div>


    <div class="bd-example-snippet bd-code-snippet">
      <div class="bd-example">
        <div class="row  row-cols-1 row-cols-md-2 g-4 ">

          <?php if (!empty($data)){
              foreach($data as $item){   
              ?>

          <div class="col" id="default-order">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"><?php echo $item["course_name"] ?></h5>
                <p class="card-text"> <?= $item["course_des"] ?> </p>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">Course ID: <?php echo $item["course_id"] ?></li>
                <!--<li class="list-group-item"><?php echo $item["ueid"] ?></li>-->
              </ul>
              <div class="card-body">
                <a href="<?php echo base_url().'course_detail/'.$item['course_id'] ?>" class="card-link">Details</a>
                <?php echo form_open(base_url().'courses_list'); ?>
                <input type="hidden" name="course_id" value="<?php echo $item['course_id']?>">
                <input type="submit" name="submit" value="Add to Collection">
                <?php echo form_close();?>

              </div>
            </div>
          </div>
          <?php }}?>

          <?php if (empty($data)){   ?>

          <div class="col">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">{no course yet}</h5>
                <p class="card-text" name="description"></p>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item" name="course_id"></li>
                <li class="list-group-item" name="course_name"></li>
              </ul>
            </div>
          </div>
          <?php }?>

        </div>
      </div>
    </div>
  </div>
</div>

