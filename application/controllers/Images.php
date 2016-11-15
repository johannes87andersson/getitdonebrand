<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Images
 *
 * @author ziinloader
 */
class Images {
    
    public function __construct() {
        
    }
    
    public function createThumb($image, $thumb_width = 171, $thumb_height = 180) {
        $path = getcwd()."/web/uploads/";
        $upload_image = $path.$image;
        $file_ext = exif_imagetype($upload_image);
        $thumbnail = $path."thumbs/".$image;
        list($width, $height) = getimagesize($upload_image);
        $thumb_create = imagecreatetruecolor($thumb_width, $thumb_height);
        // set to png as fallback
        $source = imagecreatefrompng($upload_image);
        switch($file_ext) {
            case "jpg":
                $source = imagecreatefromjpeg($upload_image);
                break;
            case "png":
                $source = imagecreatefrompng($upload_image);
                break;
            case "jpeg":
                $source = imagecreatefromjpeg($upload_image);
                break;
            case "gif":
                $source = imagecreatefromgif($upload_image);
                break;
        }
        
        imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
            switch($file_ext){
                case 'jpg' || 'jpeg':
                    imagejpeg($thumb_create,$thumbnail,100);
                    break;
                case 'png':
                    imagepng($thumb_create,$thumbnail,100);
                    break;
                case 'gif':
                    imagegif($thumb_create,$thumbnail,100);
                    break;
                default:
                    imagejpeg($thumb_create,$thumbnail,100);
            }
    }
    
}
