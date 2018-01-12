<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    ///public $pila = array();

    function __construct() {

        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');

       
    }

    public function index() {
        $data['cadena'] = "";
        $this->load->view('login', $data);
    }

    public function login() {
       

         redirect('cliente', 'refresh');

    }



}
