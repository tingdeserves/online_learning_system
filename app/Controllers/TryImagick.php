<?php

namespace App\Controllers;

class TryImagick extends BaseController
{
    public function index()
    { 
        $path=ROOTPATH."writable/uploads/";
        $filename="infs7202_course.png";
        $imagePath="writable/uploads/".$filename;
        $rotateImagePath="#";
        $output=[
            "imagePath"=>$imagePath,
            "rotateImagePath"=>$rotateImagePath,
        ];
        echo view("try_imagick",$output);


    }


    public function rotate(){

        $image=$this->request->getFile("course_img");//get img from view (name)
        $path=ROOTPATH."writable/uploads/";

        $filename="infs7202_course.png";

        $image = service('image'); //use the image service
        $image->withFile($path.$filename) //the path of the file
        ->withHandler('imagick');  // use imagick handler

        if ($image == false) {
            echo 'Could not load image';
            return;
        }
        $image->resize(200,30);  //resize
        //$image->rotate($degree);// rotate image
        $imagickPath=$path."imagick/";
        $newFileName="resize_".$filename;
        $image->save($path.'/imagick/'.$newFileName);  //save to same path with new name
        $output=[
            "imagePath"=>"writable/uploads/".$filename,
            "rotateImagePath"=>"writable/uploads/imagick/".$newFileName,
        ];
        echo view("try_imagick",$output);

    }



}
?>