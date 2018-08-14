<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipolectores_model extends CI_Model {

	public function getTipolectores(){
		$resultados = $this->db->get("tipolector");
		return $resultados->result();
	}

	public function getTipousuario($idtipousuario){
		$this->db->where("id_tipousuario",$idtipousuario);
		$consulta = $this->db->get("tipousuario");
		return $consulta->row();
	}

	public function guardar($datos){
		return $this->db->insert("tipousuario",$datos);
	}

	public function update($idtipousuario,$datos){
		$this->db->where("id_tipousuario",$idtipousuario);
		return $this->db->update("tipousuario",$datos);
	}

	public function delete($id){
		$this->db->where("id_tipousuario",$id);
		return $this->db->delete("tipousuario");
	}
}
