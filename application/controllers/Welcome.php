<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    ///public $pila = array();

    function __construct() {

        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');

        $datoiniciar = $this->session->userdata('usuario');
        if (strlen($datoiniciar) != 0) {


            redirect('cliente', 'refresh');
        }

       
    }

    public function index() {
        $data['cadena'] = "";
        $this->load->view('login', $data);
    }

    

    public function login() {

        $email=$this->input->post('email');
        $password=$this->input->post('pass');
        if($email==='gomezluisnutricion@hotmail.com'&&$password=='sntcenter25%'){

          $newdata = array(
                'idUsuario' => 1,
                'usuario' => 'LUIS ALBERTO GÓMEZ MARTIN'
                );

            $this->session->set_userdata($newdata);
             redirect('cliente', 'refresh');
        }else{

         $data['cadena'] ='error';// $navegador;
         $this->load->view('login', $data);
        }
       

        

    }



}
