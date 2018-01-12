<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cliente_models extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();

    }

    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('cliente', $data);
        $id = $this->db->insert_id();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        } else {

            $this->db->trans_commit();
            return $id;
        }
    }

    

    function buscar($pedidoInicial) {
        $this->db->where('pedidoInicial',$pedidoInicia);
        $query = $this->db->get('cliente');
        return $query;
        
    }
    function getid($id) {
        $this->db->where('idCliente',$id);
        $query = $this->db->get('cliente');
        return $query;
        
    }

    function get($filtro) {
     $this->db->like('nombre', $filtro); 
     $query = $this->db->get('cliente');
     return $query;

 }

 function count($filtro) {
    $this->db->like('nombre',$filtro); 
    $query = $this->db->get('cliente');
    return $query->num_rows();
}




}