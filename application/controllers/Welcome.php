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
        $this->load->view('menu', $data);
    }

     public function loginme() {
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

    public function suscripcion()
    {
        

        
        
        $destinatario="eduardopadillacz@gmail.com";
        $asunto="Suscripcion";
        
        
        $html= ' Email de Susucripción : hola'; 

        $cabeceras = 'From: suscripcion@sntcenter.com.mx' . "\r\n" .
        'Reply-To: contacto@sntcenter.com.mx' . "\r\n" .
        'Content-Type: text/html' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();



        if (mail($this->destinatario, utf8_decode($asunto), $html, $cabeceras)) {
            $datam['activar'] ='planes';
            $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
            $data['mensaje']="Gracias por tu suscripción";
            $this->load->view('msn',$data);
        }else{
            echo "Error al enviarse correo";
        }

    }



}
