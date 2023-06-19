<?php
namespace App\Controllers;

class TestController extends BaseController
{
    public function testImageMagick()
    {
        
        $im = new \Imagick();
        $im->newImage(100, 100, 'red');
        $im->setImageFormat('png');
        header('Content-Type: image/png');
        echo $im;
    }
}