<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommonModel
 *
 * @author ziinloader
 */
require_once("BaseModel.php");

class CommonModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public function getCurrentPage($page_id, $page_title) {
        $sql = "SELECT * FROM pages WHERE page_id = ? OR LOWER(page_title) = LOWER(?)";
        $q = $this->db->query($sql, array($page_id, $page_title));
        $res = $q->result_array();
        return (count($res) > 0) ? $res[0] : false;
    }

    public function getAllProducts() {
        //$sql = "SELECT * FROM products";
        $sql = "
            SELECT p.prod_id, p.prod_name, p.prod_active, img.img_id, img.filename, img.parent_id FROM `products` AS p
            LEFT JOIN prod_img AS img ON 
            img.parent_id = p.prod_id
            GROUP BY p.prod_id
            ";
        $q = $this->db->query($sql);
        $res = $q->result_array();
        return (count($res) > 0) ? $res : false;
    }

    public function getSpecificProduct($prod_id, $prod_name) {
        $sql = "SELECT * FROM products WHERE prod_id = ? OR LOWER(REPLACE(prod_name, ' ', '-')) = ?";
        $q = $this->db->query($sql, array($prod_id, $prod_name));
        $res = $q->result_array();
        return (count($res) > 0) ? $res[0] : false;
    }
    
    public function getCurrentProductsImages($parent_id) {
        $sql = "SELECT * FROM prod_img WHERE parent_id = ?";
        $q = $this->db->query($sql, array($parent_id));
        $res = $q->result_array();
        return (count($res) > 0) ? $res : false;
    }

}
