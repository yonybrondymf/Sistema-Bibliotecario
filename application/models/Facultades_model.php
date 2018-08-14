<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facultades_model extends CI_Model {

	public function getFacultades(){
		$resultados = $this->db->get("facultades");
		return $resultados->result();
	}

	public function getFacultad($idfacultad){
		$this->db->where("id",$idfacultad);
		$consulta = $this->db->get("facultades");
		return $consulta->row();
	}

	public function guardar($datos){
		return $this->db->insert("facultades",$datos);
	}

	public function update($idfacultad,$datos){
		$this->db->where("id",$idfacultad);
		return $this->db->update("facultades",$datos);
	}

	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("facultades");
	}
}
