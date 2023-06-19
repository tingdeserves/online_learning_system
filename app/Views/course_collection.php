<!--   test card numbers   -->
<!--   4242 4242 4242 4242         success-->

<div class="container">
<div class="col-12 mt-5 mb-5">


<div class="bd-example-snippet bd-code-snippet"><div class="bd-example">
        <div class="row  row-cols-1 row-cols-md-1 g-4 ">


          <div class="col">
          <h2 class="text-center mt-5 mb-5">My collection</h2>
            <div class="card">
<?php if (!empty($data)){foreach($data as $item){   ?>
              <?php echo form_open(base_url().'checkout_stripe'); ?>
              <div class="card-body border-bottom">
              
                <a style="float:left"  href="<?php echo base_url().'course_detail/'.$item['course_id'] ?>"> <h5 class="card-title"> > <?php echo $item["course_name"]?> </h5></a>
                <input style="visibility:hidden" name="pay_collection_id" value="<?php echo $item['collection_id'] ?> " >
                <!--<p><?php// echo $item['collection_id'] ?></p>-->
                <?php if($item["paid_status"]==0){ ?>
                  <div style="float:right">
                    <span style="color:red" >$2.00</span> 
                    <button type="submit" class="btn btn-outline-primary ms-2"> pay the course</button>
                  </div>
                <?php }?>
                <?php if($item["paid_status"]==1){ ?>
                  <div style="float:right">
                  <img src="<?php echo base_url()."writable/uploads/icon/icon_tick.png"?>" width="20px">
                  <span style="color:green" >paid</span> 
                  </div>
                <?php }?>
              <?php echo form_close(); ?>
              </div>
<?php }}?>

<?php if (empty($data)){   ?>
              <div class="card-body border-bottom">
                <h5 class="card-title"><?php echo "you have no collected course yet."?></h5>
              </div>
<?php }?>

            </div>
          </div>

        </div>
        </div>
      </div>
</div>
</div>