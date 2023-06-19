<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?= form_open_multipart(base_url()."try_imagick") ?>  
<div>
    <img src="<?= base_url().$imagePath ?>" name="course_img" style="width:100$; ">
    <?php if($rotateImagePath!="#"){ ?>
        
    <img src="<?php echo $rotateImagePath ?>" name="course_img" style="width:100$; ">
    
    <?php }?>
</div>
<button > resize </button>
<?php echo form_close(); ?>

    
</body>
</html>





