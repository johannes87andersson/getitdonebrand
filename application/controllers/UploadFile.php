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

    public function productUpload() {
        //header('HTTP/1.1 200 OK', true, 200);
        $this->load->model("UploadFileModel");
        $accepted = array("png", "jpg", "jpeg", "gif", "svg+xml");
        $type = preg_replace("/(^\w+[\/])/", "", $_FILES["file"]["type"]);
        if (in_array($type, $accepted)) {
            // we have an allowed uploaded file
            $root = $_SERVER["DOCUMENT_ROOT"];
            
            $newName = time() . ".".$type;
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $root . "/web/uploads/" . $newName)) {
                $imgFile = $root . "/web/uploads/" . $newName;
                $imgThumb = $root . "/web/uploads/thumbnail/" . $newName;
                $this->createThumbnail($imgFile, $imgThumb);
                echo $newName;
            }
        } else {
            echo "Not accepted type";
        }
    }

    private function createThumbnail($image, $thumbnail) {
        $metaData = getimagesize($image);
        $img = '';
        $newWidth = 100;
        $newHeight = $metaData[1] / ($metaData[0] / $newWidth);

        switch ($metaData["mime"]) {
            case 'image/jpeg':
                $img = imagecreatefromjpeg($image);
                break;
            case 'image/png':
                $img = imagecreatefrompng($image);
                break;
            case 'image/gif':
                $img = imagecreatefromgif($image);
                break;
            case 'image/wbmp':
                $img = imagecreatefromwbmp($image);
                break;
        }

        if ($img) {
            $imgThumb = imagecreatetruecolor($newWidth, $newHeight);
            imagealphablending($imgThumb, false);
            imagesavealpha($imgThumb, true);
            imagecopyresampled($imgThumb, $img, 0, 0, 0, 0, $newWidth, $newHeight, $metaData[0], $metaData[1]);
            imagepng($imgThumb, $thumbnail, 9);
            imagedestroy($imgThumb);
        }
    }

    public function insertImage() {
        $this->load->model("UploadFileModel");

        $filename = filter_input(INPUT_POST, "filename", FILTER_SANITIZE_STRING);
        $parent_id = filter_input(INPUT_POST, "parent_id", FILTER_SANITIZE_NUMBER_INT);

        $injectImage = $this->UploadFileModel->doInsertImage($parent_id, $filename);
        if ($injectImage) {
            echo json_encode("true");
        } else {
            echo json_encode("false");
        }
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
    
    public function removeImage() {
        $this->load->model("UploadFileModel");

        $file_id = filter_input(INPUT_POST, "file_id", FILTER_SANITIZE_NUMBER_INT);

        $injectImage = $this->UploadFileModel->doRemoveImage($file_id);
        if ($injectImage) {
            echo json_encode("true");
        } else {
            echo json_encode("false");
        }
    }

}
