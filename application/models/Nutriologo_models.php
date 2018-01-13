<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nutriologo_models extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

     
    function buscar($id) {

        $this->db->where('idUsuario', $id);
        $query = $this->db->get('usuario');

        return $query;
    }



}