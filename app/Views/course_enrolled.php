<!--   test card numbers   -->
<!--   4242 4242 4242 4242         success-->
<!-- deleted this view from learner's workplace  04/05/23 -->

<div class="container">
<div class="col-12 mt-5 mb-5">


<div class="bd-example-snippet bd-code-snippet"><div class="bd-example">
        <div class="row  row-cols-1 row-cols-md-1 g-4 ">


          <div class="col">
          <h2 class="text-center mt-5 mb-5">My Paid Courses</h2>
            <div class="card" id="paid_course_list">
<?php if (!empty($data)){foreach($data as $item){   ?>
              <?php if($item["paid_status"]==1){ ?>
              <div class="card-body border-bottom" >
              <a style="float:left"  href="<?php echo base_url().'course_detail/'.$item['course_id'] ?>"> <h5 class="card-title"> > <?php echo $item["course_name"]?> </h5></a>
              <div style="float:right">
                  <img src="<?php echo base_url()."writable/uploads/icon/icon_tick.png"?>" width="20px">
                  <span style="color:green" >paid</span> 
              </div>
              </div>

              
<?php }}}?>



<?php if (empty($data)){   ?>
              <div class="card-body border-bottom" id="">
                <h5 class="card-title">you have no paid course yet.</h5>
              </div>
<?php }?>

            </div>
          </div>

        </div>
        </div>
      </div>
</div>
</div>

