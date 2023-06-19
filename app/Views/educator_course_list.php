<div class="container">
    <div class="col-12 mt-5 mb-5">
        <h2 class="text-center mt-5 mb-5">Courses Management </h2>

        <div class="bd-example-snippet bd-code-snippet">
            <div class="bd-example">
                <div class="row  row-cols-1 row-cols-md-1 g-4 ">

                    <div class="col">
                        <div class="card">
                            <div class="card-body border-bottom">
                                <h5 class="card-title mb-3" >Your released courses:</h5>
                            <?php if (!empty($data)){foreach($data as $item){   ?>
                       
                                <a href="<?php echo base_url().'course_detail/'.$item['course_id'] ?>" class=""><h5 class="card-title"><span class="mx-3">></span><?php echo $item["course_name"] ?> </h5></a>
                            <?php }}?>
                            </div>

                            <?php if (empty($data)){   ?>
                            <div class="card-body border-bottom">
                                <h5 class="card-title">You havn't released a course yet.</h5>
                                <p class="card-text" name="description"></p>
                            </div>
                            <?php }?>
                        </div>
                    </div>

                    <!-- add new courses form start-->
                    <?php echo form_open_multipart( base_url()."educator_workplace/succ"); ?> 
                    <div class="col">
                        <div class="card">
                            <div class="card-body ">
                                <h5 class="text-center">Release A New Course</h5>
                                <div class="mt-3 mb-3 ">
                                    <h5 class="card-title"><?php //echo $item["course_name"] ?> Course name</h5>
                                    <input type="text" class="form-control" name="course_name">
                                </div>

                                <div class="mt-3 mb-3 ">
                                    <h5 class="card-title"><?php //echo $item["course_name"] ?> Course description</h5>
                                    <textarea type="text" class="form-control" name="course_des"></textarea>
                                </div>

                                <div class="mt-3 mb-3 ">
                                    <h5 class="card-title"><?php //echo $item["course_name"] ?> Course image</h5>
                                    <input type="file" size="20" class="form-control" id="course_img" name="course_img" accept=".png,.jpg,.jpeg,">
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Submit</button>

                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    <!-- add new courses form end-->

                </div>
            </div>
        </div>
    </div>
</div>