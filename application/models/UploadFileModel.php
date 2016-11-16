<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UploadFileModel
 *
 * @author ziinloader
 */
require_once("BaseModel.php");
class UploadFileModel extends BaseModel {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function doInsertImage($parent_id, $filename) {
        $sql = "INSERT INTO prod_img SET filename = ?, parent_id = ?";
        $q = $this->db->query($sql, array($filename, $parent_id));
        return ($this->db->affected_rows()) ? true : false;
    }
    
}
