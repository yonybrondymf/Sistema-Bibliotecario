<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prestamos_model extends CI_Model
{
    public function getPrestamos()
    {
        $this->db->select("p.*, le.*,li.*");
        $this->db->join("lectores le", "le.id_lector = p.id_lector");
        $this->db->join("libros li", "li.id_libro= p.id_libro");
        $resultados = $this->db->get("prestamos p");
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getPrestamo($id)
    {

        $this->db->select("*");
        $this->db->where("id", $id);
        $resultados = $this->db->get("prestamos");
        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }

    }

    public function guardar($datos)
    {
        return $this->db->insert("prestamos", $datos);
    }

    public function update($id, $data)
    {
        $this->db->where("id", $id);
        return $this->db->update("prestamos", $data);
    }

    public function delete($id)
    {
        $this->db->where("id_libro", $id);
        return $this->db->delete("libros");
    }

}
