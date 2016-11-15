<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {
    
    protected $vars;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function header() {
        $this->load->view('common/header');
    }
    
    public function footer() {
        $this->load->view('common/footer');
    }
    
}
