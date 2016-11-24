<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminModel
 *
 * @author ziinloader
 */
require_once("BaseModel.php");

class AdminModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public function loginUser($username, $password) {
        $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
        $q = $this->db->query($sql, array($username, $password));
        $res = $q->result_array();
        return (count($res) > 0) ? $res[0] : false;
    }

    public function getAllPages() {
        $sql = "SELECT page_id, page_title FROM pages";
        $q = $this->db->query($sql);
        $res = $q->result_array();
        return (count($res) > 0) ? $res : false;
    }

    public function getCurrentPage($page_id) {
        $sql = "SELECT * FROM pages WHERE page_id = ?";
        $q = $this->db->query($sql, array($page_id));
        $res = $q->result_array();
        return (count($res) > 0) ? $res[0] : false;
    }

    public function updateCurrentPage($page_title, $page_text, $page_keywords, $page_desc, $page_id) {
        $sql = "UPDATE pages SET page_title = ?, page_text = ?, page_keywords = ?, page_desc = ? WHERE page_id = ?";
        $q = $this->db->query($sql, array($page_title, $page_text, $page_keywords, $page_desc, $page_id));
        return ($this->db->affected_rows()) ? true : false;
    }

    public function updateCurrentProduct($prod_id, $prod_name, $prod_price, $prod_shopify_link) {
        $sql = "UPDATE products SET prod_name = ?, prod_price = ?, shopify_link = ? WHERE prod_id = ?";
        $q = $this->db->query($sql, array($prod_name, $prod_price, $prod_shopify_link, $prod_id));
        return ($this->db->affected_rows()) ? true : false;
    }
    
    public function getAllProducts() {
        $sql = "SELECT prod_id, prod_name FROM products";
        $q = $this->db->query($sql);
        $res = $q->result_array();
        return (count($res) > 0) ? $res : false;
    }
    
    public function getCurrentProduct($prod_id) {
        $sql = "SELECT * FROM products WHERE prod_id = ?";
        $q = $this->db->query($sql, array($prod_id));
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
