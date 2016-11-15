<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UploadFile
 *
 * @author ziinloader
 */
require_once("Base.php");
require_once("Images.php");

class UploadFile extends Base {

    private $file;
    private $i;

    public function __construct() {
        parent::__construct();
        $this->file = array();
        $this->i = 0;
    }

    public function doUpload() {
        require_once("UploadHandler.php");
        $uh = new UploadHandler();
        //$arr = $this->rebuildArray($_FILES["upload_files"]);
        //$this->uploadAndMoveFile($arr);
    }

    private function uploadAndMoveFile($files) {
        $target_path = getcwd() . '/web/uploads/';
        $accepted = array(
            "video/webm",
            "video/mp4",
            "image/png",
            "image/jpg",
            "image/jpeg",
            "image/svg",
            "image/svg+xml",
            "application/pdf",
            "application/zip"
        );
        $json_object = array();
        for ($i = 0; $i < count($files); $i++) {
            if (in_array($files[$i]["type"], $accepted)) {
                if (move_uploaded_file($files[$i]["tmp_name"], $target_path . $files[$i]["name"])) {
                    //echo "The file " . $files[$i]["name"] . " has been uploaded.";
                    $json_object[] = $files[$i]["name"];
                    //$img = new Images();
                    //$img->createThumb($files[$i]["name"], 171, 180);
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "Rejected " . $files[$i]["name"] . " -> illegal type " . $files[$i]["type"];
            }
        }

        echo json_encode($json_object);
    }

    private function rebuildArray($files) {

        foreach ($files as $index => $value) {
            //print_r($value);
            switch ($index) {
                case "name":
                    for ($i = 0; $i < count($value); $i++) {
                        $this->file[$i][$index] = $value[$i];
                    }
                    break;
                case "type":
                    for ($i = 0; $i < count($value); $i++) {
                        $this->file[$i][$index] = $value[$i];
                    }
                    break;
                case "tmp_name":
                    for ($i = 0; $i < count($value); $i++) {
                        $this->file[$i][$index] = $value[$i];
                    }
                    break;
                case "error":
                    for ($i = 0; $i < count($value); $i++) {
                        $this->file[$i][$index] = $value[$i];
                    }
                    break;
                case "size":
                    for ($i = 0; $i < count($value); $i++) {
                        $this->file[$i][$index] = $value[$i];
                    }
                    break;
            }
        }
        return $this->file;
    }

    public function allFiles() {
        $arr = array();
        array_push($arr, '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">');
        array_push($arr, '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>');
        array_push($arr, '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>');
        for ($i = 0; $i < count($arr); $i++) {
            echo $arr[$i];
        }

        $path = getcwd() . "/web/uploads/";
        $this->loopFiles($path);
    }

    /**
     * Recursive function loops folders and sub folders
     * @param string $dir Path to the directory
     */
    private function loopFiles($dir) {
        $files = scandir($dir);
        echo "<ul>";
        $pass = array(".", "..", ".DS_Store");
        foreach ($files as $key => $val) {
            // skip these folders and files
            if (in_array($val, $pass)) {
                continue;
            }
            // end skip folder and files

            switch (filetype($dir . $val)) {
                case "file":
                    echo "<li class='thumbnail'>" . $val . "</li>";
                    break;
                case "dir":
                    $sub_dir = $dir . $val . "/";
                    $this->loopFiles($sub_dir);
                    break;
            }
        }
        echo "</br>";
    }

    public function ProductUpload() {
        $accepted = array("png", "jpg", "jpeg", "gif", "svg+xml");
        $type = preg_replace("/(^\w+[\/])/", "", $_FILES["file"]["type"]);
        if (in_array($type, $accepted)) {
            // we have an allowed uploaded file
            $root = $_SERVER["DOCUMENT_ROOT"];
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $root . "/web/uploads/" . $_FILES["file"]["name"])) {
                if($type != "svg+xml") {
                    $this->generate_image_thumbnail($root . "/web/uploads/" . $_FILES["file"]["name"], $root . "/web/uploads/thumbnail/" . $_FILES["file"]["name"]); //call the function
                    echo "/web/uploads/thumbnail/" . $_FILES["file"]["name"];
                } else {
                    echo "/web/uploads/" . $_FILES["file"]["name"];
                }
                
            }  
        } else {
            echo "Not accepted type";
        }

//        [name] => Skärmavbild 2016-11-14 kl. 21.18.36.png
//        [type] => image/png
//        [tmp_name] => /Applications/XAMPP/xamppfiles/temp/phpF6MDHw
//        [error] => 0
//        [size] => 279824
    }

    
    private function generate_image_thumbnail($source_image_path, $thumbnail_image_path) {
        define('THUMBNAIL_IMAGE_MAX_WIDTH', 100);
        define('THUMBNAIL_IMAGE_MAX_HEIGHT', 100);
        list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
        switch ($source_image_type) {
            case IMAGETYPE_GIF:
                $source_gd_image = imagecreatefromgif($source_image_path);
                break;
            case IMAGETYPE_JPEG:
                $source_gd_image = imagecreatefromjpeg($source_image_path);
                break;
            case IMAGETYPE_PNG:
                $source_gd_image = imagecreatefrompng($source_image_path);
                break;
        }
        if ($source_gd_image === false) {
            return false;
        }
        $source_aspect_ratio = $source_image_width / $source_image_height;
        $thumbnail_aspect_ratio = THUMBNAIL_IMAGE_MAX_WIDTH / THUMBNAIL_IMAGE_MAX_HEIGHT;
        if ($source_image_width <= THUMBNAIL_IMAGE_MAX_WIDTH && $source_image_height <= THUMBNAIL_IMAGE_MAX_HEIGHT) {
            $thumbnail_image_width = $source_image_width;
            $thumbnail_image_height = $source_image_height;
        } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
            $thumbnail_image_width = (int) (THUMBNAIL_IMAGE_MAX_HEIGHT * $source_aspect_ratio);
            $thumbnail_image_height = THUMBNAIL_IMAGE_MAX_HEIGHT;
        } else {
            $thumbnail_image_width = THUMBNAIL_IMAGE_MAX_WIDTH;
            $thumbnail_image_height = (int) (THUMBNAIL_IMAGE_MAX_WIDTH / $source_aspect_ratio);
        }
        $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
        imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);

        $img_disp = imagecreatetruecolor(THUMBNAIL_IMAGE_MAX_WIDTH, THUMBNAIL_IMAGE_MAX_WIDTH);
        $backcolor = imagecolorallocate($img_disp, 0, 0, 0);
        imagefill($img_disp, 0, 0, $backcolor);
        //imagecolortransparent($img_disp, $backcolor);
        
        imagecopy($img_disp, $thumbnail_gd_image, (imagesx($img_disp) / 2) - (imagesx($thumbnail_gd_image) / 2), (imagesy($img_disp) / 2) - (imagesy($thumbnail_gd_image) / 2), 0, 0, imagesx($thumbnail_gd_image), imagesy($thumbnail_gd_image));

        imagepng($img_disp, $thumbnail_image_path, 9);
        imagedestroy($source_gd_image);
        imagedestroy($thumbnail_gd_image);
        imagedestroy($img_disp);
        return true;
    }

    private function resizeImage($file) {
        // File and new size
        $filename = $file;
        $percent = 0.5;

        // Content type
        header('Content-Type: image/png');

        // Get new sizes
        list($width, $height) = getimagesize($filename);
        $newwidth = $width * $percent;
        $newheight = $height * $percent;

        // Load
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $source = imagecreatefrompng($filename);

        // Resize
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        // Output

        imagepng($thumb);
    }

}
