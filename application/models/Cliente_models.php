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

    function get($filtro, $offset, $limin) {
     $this->db->like('nombre', $filtro); 
     $this->db->limit($limin,$offset);
     $query = $this->db->get('cliente');
     return $query;

 }

 function count($filtro) {
    $this->db->like('nombre',$filtro); 
    $query = $this->db->get('cliente');
    return $query->num_rows();
}

function countCitas($idCliente) {
   $Query='SELECT 
   c.*
   FROM
   consulta c
   INNER JOIN
   plancontratado p ON c.idplancontratado = p.idplancontratado where p.idCliente='.$idCliente;
   $query = $this->db->query($Query);
   return $query->num_rows();
}

function getCitas($id, $offset, $limin) {
    $Query='SELECT 
    c.*
    FROM
    consulta c
    INNER JOIN
    plancontratado p ON c.idplancontratado = p.idplancontratado where p.idCliente='.$id.'
    LIMIT '.$offset.','.$limin;
    $query = $this->db->query($Query);
    return $query;

}

function countplancontratado($idCliente) {
    $this->db->where('idCliente',$idCliente);
    $query = $this->db->get('plancontratado');
    return $query->num_rows();
}


function insertarplancontratado($data) {

    $this->db->trans_begin();
    $this->db->insert('plancontratado', $data);
    $id = $this->db->insert_id();
    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return -1;
    } else {

        $this->db->trans_commit();
        return $id;
    }
}

function insertarConsulta($data) {

    $this->db->trans_begin();
    $this->db->insert('consulta', $data);
    $id = $this->db->insert_id();
    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return -1;
    } else {

        $this->db->trans_commit();
        return $id;
    }
}


function buscarplancontratado($idCliente) {
    $this->db->where('idCliente',$idCliente);
    $query = $this->db->get('plancontratado');
    $row = $query->row();
    $idre = $row->idplancontratado;
    return $idre;
}


    function updateConsulta($id, $data) {

        $this->db->trans_begin();
        $this->db->where('idconsulta', $id);
        $this->db->update('consulta', $data);


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
             return 0;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }



}