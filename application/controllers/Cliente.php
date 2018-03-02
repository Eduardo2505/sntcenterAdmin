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

public function cancelar() {
    $idconsulta =$this->input->get('idconsulta');
    $idCliente =$this->input->get('idCliente');
    
    $newdata = array(
        'estatus' => 0
    );
    $num=$this->cliente_models->updateConsulta($idconsulta,$newdata);

    redirect('cliente/citas?idcliente='.$idCliente, 'refresh');

}

public function insertarcitas() {
    $idPlancontrolado =$this->input->get('idPlancontrolado');
    $idCliente =$this->input->get('idCliente');
    
    $newdata = array(
        'idplancontratado' => $idPlancontrolado,
        'estatus' => 1
    );
    $num=$this->cliente_models->insertarConsulta($newdata);

    //enviar email

    $bucarCliente=$this->cliente_models->getid($idCliente);
    $row = $bucarCliente->row();
    $nombre = $row->nombre;
    $email = $row->email;

    $numeroConsultas=$this->cliente_models->countCitas($idCliente);
    if($numeroConsultas==2){
        //se envia 10
        $codigo='GANE10';
        $url='https://sntcenter.com.mx/welcome/emialPromocion?email='.$email.'&nombre='.$nombre.'&codigo='.$codigo.'&descuento=10';
    }
    else if($numeroConsultas==5){
        //se envia 20
        $codigo='BAJE20';
        $url='https://sntcenter.com.mx/welcome/emialPromocion?email='.$email.'&nombre='.$nombre.'&codigo='.$codigo.'&descuento=20';
    }
    else if($numeroConsultas==8){
        //se envia 30
        $codigo='KILO30';
        $url='https://sntcenter.com.mx/welcome/emialPromocion?email='.$email.'&nombre='.$nombre.'&codigo='.$codigo.'&descuento=30';
    }
    else if($numeroConsultas==11){
        //se envia 40
        $codigo='ROMPE40';
        $url='https://sntcenter.com.mx/welcome/emialPromocion?email='.$email.'&nombre='.$nombre.'&codigo='.$codigo.'&descuento=40';
    }
    else if($numeroConsultas==14){
        //se envia 50
        $codigo='CORRE50';
        $url='https://sntcenter.com.mx/welcome/emialPromocion?email='.$email.'&nombre='.$nombre.'&codigo='.$codigo.'&descuento=50';
    }



    redirect($url.'&op=1&idcliente='.$idCliente, 'refresh');

}
public function citas() {
    $offset =$this->input->get('per_page');
    $idCliente =$this->input->get('idcliente');
    $uri_segment = 0;
    if ($offset == "") {
        $offset = 0;
    }
    $num=$this->cliente_models->countplancontratado($idCliente);

    $idPlancontrolado=0;

    if($num==0){
       $newdata = array(
        'idCliente' => $idCliente,
        'idplan' => 8
    );
       $idPlancontrolado=$this->cliente_models->insertarplancontratado($newdata);
   }else{
    $idPlancontrolado=$this->cliente_models->buscarplancontratado($idCliente);


}


$data['registros'] = $this->cliente_models->getCitas($idCliente,$offset, $this->limite);


$config['base_url'] = base_url() . 'cliente/citas?idcliente='.$idCliente; 
$config['total_rows'] = $this->cliente_models->countCitas($idCliente);
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
        $data['idPlancontrolado'] = $idPlancontrolado;
        $data['idCliente'] = $idCliente;
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
        $datab['usuario']= $this->session->userdata('usuario');
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('cliente/citas', $data);

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
