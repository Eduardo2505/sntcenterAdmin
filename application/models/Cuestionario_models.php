<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Cuestionario_models extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();

	}

	function insertar($data) {

		$this->db->trans_begin();
		$this->db->insert('cuestionario', $data);
		$id = $this->db->insert_id();
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return -1;
		} else {

			$this->db->trans_commit();
			return $id;
		}
	}



	function buscar($id) {
		
		$this->db->where('idcliente',$id);
		$query = $this->db->get('cuestionario');
		return $query;

	}

	function update($id, $data) {
		$this->db->trans_begin();
		$this->db->where('idcliente', $id);
		$this->db->update('cuestionario', $data);
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
		} else {
			$this->db->trans_commit();
		}
	}



}