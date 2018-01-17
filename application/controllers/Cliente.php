<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

 private $limite = 10;

 function __construct() {

    parent::__construct();

    $this->load->helper('url');
    $this->load->library('session');
    $this->load->model('cliente_models');
    $this->load->library('pagination');

    $datoiniciar = $this->session->userdata('usuario');
    if (strlen($datoiniciar) == 0) {


        redirect('', 'refresh');
    }


}

public function salir() {
    $this->session->sess_destroy();
    redirect('', 'refresh');
}

public function index() {



    $offset =$this->input->get('per_page');
    $uri_segment = 0;
    if ($offset == "") {
        $offset = 0;
    }



    $buscar = $this->input->get('buscar');


    $data['registros'] = $this->cliente_models->get($buscar,$offset, $this->limite);



    $config['base_url'] = base_url() . 'cliente/index?buscar='.$buscar; 
    $config['total_rows'] = $this->cliente_models->count($buscar);
        $config['per_page'] = $this->limite; //Número de registros mostrados por páginas
        $config['num_links'] = 5; //Número de links mostrados en la paginación
        $config['page_query_string'] = true;


        $config['full_tag_open'] = '<ul class="pagination">';
        $config['first_tag_open'] = '<li>';
        $config['first_link'] = 'Primera'; //primer link
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_link'] = 'Última'; //último link
        $config['last_tag_close'] = '</li>';
        $config["uri_segment"] = $uri_segment; //el segmento de la paginación
        $config['next_tag_open'] = '<li>';
        $config['next_link'] = 'Siguiente'; //siguiente link
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_link'] = 'Anterior'; //anterior link
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['full_tag_close'] = '</ul>';


        $this->pagination->initialize($config); //inicializamos la paginación        


        $data["pagination"] = $this->pagination->create_links();

        
       //=============================================
        
        $datam['cliente'] = "start active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
        $datab['usuario']= $this->session->userdata('usuario');
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('cliente/lista', $data);
        
    }





}
