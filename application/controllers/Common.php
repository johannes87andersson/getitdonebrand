<?php

require_once("Base.php");

class Common extends Base {

    public function __construct() {
        parent::__construct();
        $this->load->model('CommonModel');
    }

    public function index() {
        $this->header();
        $this->load->view('common/index');
        $this->footer();
    }

    public function products() {
        $this->vars["products"] = $this->CommonModel->getAllProducts();

        $this->header();
        $this->load->view('common/products', $this->vars);
        $this->footer();
    }

    public function store() {
        $prod_name = $this->uri->segment(3);

        $this->vars["product"] = $this->CommonModel->getSpecificProduct(null, $prod_name);
        $this->vars["prod_img"] = $this->CommonModel->getCurrentProductsImages($this->vars["product"]["prod_id"]);
        $this->vars["prod_size"] = $this->CommonModel->getAllProductSize($this->vars["product"]["prod_id"]);

        $this->header();
        $this->load->view('common/store', $this->vars);
        $this->footer();
    }

    public function about() {
        $page_id = null;
        $page_title = $this->uri->segment(2);
        $this->vars["page"] = $this->CommonModel->getCurrentPage($page_id, strtolower($page_title));

        $this->load->view('common/about', $this->vars);
        $this->footer();
    }

    public function contact() {
        $page_id = null;
        $page_title = $this->uri->segment(2);
        $this->vars["page"] = $this->CommonModel->getCurrentPage($page_id, strtolower($page_title));

        $this->load->view('common/contact', $this->vars);
        $this->footer();
    }

    public function phpInfo() {
        $this->load->view("phpinfo");
    }

    public function sendEmail() {
        require_once("Email.php");

        $from = filter_input(INPUT_POST, 'email_from', FILTER_SANITIZE_STRING);

        $body = filter_input(INPUT_POST, 'email_body', FILTER_SANITIZE_MAGIC_QUOTES);

        $email = new Email();

        $h_body = $email->emailHtml('Contacted via GetItDoneBrand', $body, $from);

        $send = $email->sendEmail($from, array('contact@getitdonebrand.com'), 'Contacted via GetItDoneBrand', $h_body);
        if ($send == true) {
            header("Location: /common/contact");
        } else {
            echo $send;
        }
    }

}
