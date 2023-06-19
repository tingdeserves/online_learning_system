<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
</head>
<body>
    <!-- a upload file form-->
    <?= form_open_multipart(base_url()."upload/upload_file") ?>       
    <label for="title">Item Name </label>
    <input type="text" name="title" size="20">
    <br>
    <input type="file" name="userfile" size="20">
    <br>
    <input type="submit" value="upload" >
    <?php echo form_close(); ?>

</body>
</html>