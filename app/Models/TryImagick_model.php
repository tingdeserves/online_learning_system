<?php
namespace App\Models; 
use CodeIgniter\Model;

use Config\Services;
use CodeIgniter\Images\Handlers\ImageMagickHandler;

class TryImagick_model extends Model
{
    public function rotate($filePath,$path, $filename, $degree){

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $image = \Config\Services::image('imagick');
        //$image = service('image') //use the image service
        $image->withFile('/var/www/htdocs/myproj/writable/uploads/infs7202_course.png') //the path of the file
        ->withHandler('imagick');  // use imagick handler

        if ($image == false) {
            echo 'Could not load image';
            return;
        }

        // Rotate the image
        $image->rotate($degree);
        // Save the resized image to a new file
        $image->save('/var/www/htdocs/myproj/writable/tryrotate/xxxxxxxxxx.png');  //save to same path with new name
     
        return "rot_".$filename; 


    }
}