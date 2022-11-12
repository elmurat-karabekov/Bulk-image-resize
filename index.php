<?php

/*
    This project was created while following this tutorial:
    https://www.youtube.com/watch?v=Z99lYtn3quk&feature=emb_title
*/

use Imagine\Gd\Imagine;
use Imagine\Image\Box;

require_once __DIR__.'/vendor/autoload.php';

ini_set('memory_limit', '1024M');

class ImageResize{
    public $imagine;

    public function __construct()
    {
        $this->imagine = new Imagine();
    }

    public function resizeAllImages($dir){
        $files = scandir($dir);

        foreach ($files as $file){
            $path = realpath($dir . DIRECTORY_SEPARATOR . $file);
            if (!is_dir($path)){

                $extention = pathinfo($path, PATHINFO_EXTENSION);
                if (in_array($extention, ['jpg', 'jpeg', 'png'])){
                    $this->imagine->open($path)
                    ->thumbnail(new Box(200, 200))
                    ->save($path);
                }

                // resize images here:

            } elseif ($file = '.' && $file != ".."){
                $this->resizeAllImages($path);
                $results[] = $path;
            }
        }
    }
}

$resizer = new ImageResize();
$resizer->resizeAllImages('./dir1');
