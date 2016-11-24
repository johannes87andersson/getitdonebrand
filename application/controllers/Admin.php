<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author ziinloader
 */
require_once("Base.php");

class Admin extends Base {

    public function __construct() {
        parent::__construct();
        $this->load->model('AdminModel');
    }

    public function header() {
        if (!$this->session->userdata("logged_in")) {
            header("location: /admin/index");
            exit();
        }
        $this->vars["user_cred"] = $this->session->userdata();
        $this->vars["uri"] = $this->uri->segment(2);

        $this->load->view('admin/header', $this->vars);
    }

    public function footer() {
        $this->load->view('admin/footer');
    }

    public function doLogin() {
        $username = filter_input(INPUT_POST, "login_username", FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, "login_password", FILTER_SANITIZE_STRING);
        $hashed = hash("sha256", $password);

        $this->vars["login"] = $this->AdminModel->loginUser($username, $hashed);
        if ($this->vars["login"]) {
            $this->PersistantLogin($this->vars["login"]);
            header("location: /admin/home");
            exit();
        } else {
            header("location: /admin/index");
            exit();
        }
    }

    public function doLogout() {
        $this->session->sess_destroy();
        header("location: /admin/index");
        exit();
    }

    public function index() {
        if ($this->session->userdata("logged_in")) {
            header("location: /admin/home");
            exit();
        }

        $this->load->view('admin/index');
    }

    public function home() {
        $this->header();
        $this->load->view('admin/home');
        $this->footer();
    }

    public function products() {
        $this->vars["products"] = $this->AdminModel->getAllProducts();

        $this->header();
        $this->load->view('admin/products', $this->vars);
        $this->footer();
    }

    public function currentProduct() {
        $prod_id = filter_input(INPUT_GET, "prod_id", FILTER_SANITIZE_NUMBER_INT);

        $this->vars["product"] = $this->AdminModel->getCurrentProduct($prod_id);
        if ($this->vars["product"]) {
            echo json_encode($this->vars["product"]);
        } else {
            echo json_encode("false");
        }
    }

    public function getCurrentProductsImages() {
        $parent_id = filter_input(INPUT_GET, "parent_id", FILTER_SANITIZE_NUMBER_INT);

        $this->vars["product_images"] = $this->AdminModel->getCurrentProductsImages($parent_id);
        if ($this->vars["product_images"]) {
            echo json_encode($this->vars["product_images"]);
        } else {
            echo json_encode("false");
        }
    }

    public function currentPage() {
        $page_id = filter_input(INPUT_GET, "page_id", FILTER_SANITIZE_NUMBER_INT);

        $this->vars["page"] = $this->AdminModel->getCurrentPage($page_id);
        if ($this->vars["page"]) {
            echo json_encode($this->vars["page"]);
        } else {
            echo json_encode("false");
        }
    }

    public function updatePage() {
        $page_title = filter_input(INPUT_POST, "page_title", FILTER_SANITIZE_STRING);
        $page_text = filter_input(INPUT_POST, "page_text");
        $page_keywords = filter_input(INPUT_POST, "page_keywords", FILTER_SANITIZE_STRING);
        $page_desc = filter_input(INPUT_POST, "page_desc", FILTER_SANITIZE_STRING);
        $page_id = filter_input(INPUT_POST, "page_id", FILTER_SANITIZE_NUMBER_INT);

        $this->vars["update_page"] = $this->AdminModel->updateCurrentPage($page_title, $page_text, $page_keywords, $page_desc, $page_id);
        if ($this->vars["update_page"]) {
            echo json_encode("true");
        } else {
            echo json_encode("false");
        }
    }

    public function updateProduct() {
        $prod_id = filter_input(INPUT_POST, "prod_id", FILTER_SANITIZE_NUMBER_INT);
        $prod_name = filter_input(INPUT_POST, "prod_name", FILTER_SANITIZE_STRING);
        $prod_price = filter_input(INPUT_POST, "prod_price", FILTER_SANITIZE_NUMBER_INT);
        $prod_shopify_link = filter_input(INPUT_POST, "prod_shopify_link", FILTER_UNSAFE_RAW);

        $this->vars["update_page"] = $this->AdminModel->updateCurrentProduct($prod_id, $prod_name, $prod_price, $prod_shopify_link);
        if ($this->vars["update_page"]) {
            echo json_encode("true");
        } else {
            echo json_encode("false");
        }
    }

    public function pages() {
        $this->vars["pages"] = $this->AdminModel->getAllPages();

        $this->header();
        $this->load->view('admin/pages', $this->vars);
        $this->footer();
    }

    public function media() {
        $this->header();
        $this->load->view('admin/media');
        $this->footer();
    }

    private function PersistantLogin($session) {
        $arr = array(
            "user_id" => $session["user_id"],
            "username" => $session["username"],
            "logged_in" => true
        );
        $this->session->set_userdata($arr);
    }

    public function doSendFeedback() {
        $subject = filter_input(INPUT_POST, "feedback_subject", FILTER_SANITIZE_STRING);
        $text = filter_input(INPUT_POST, "feedback_text", FILTER_SANITIZE_STRING);

        $this->load->library('email');

        $this->email->from('contact@getitdonebrand.com', 'Dejan');
        $this->email->to('ziinloader@gmail.com');
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

        $this->email->subject($subject);
        $this->email->message($text);

        if ($this->email->send()) {
            header("location: /admin");
            exit();
        } else {
            header("location: /admin/send_feedback");
            exit();
        }
    }

    public function send_feedback() {
        $this->header();
        $this->load->view('admin/send_feedback', $this->vars);
        $this->footer();
    }

}
