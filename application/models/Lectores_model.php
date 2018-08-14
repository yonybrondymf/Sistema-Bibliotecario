<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lectores_model extends CI_Model
{
    public function getLectores()
    {
        $this->db->select("l.*, t.nombre as tipolector");
        $this->db->join("tipolector t", "t.id = l.id_tipolector");
        $resultados = $this->db->get("lectores l");
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getLector($id)
    {

        $this->db->select("l.*,t.nombre as nombre");
        $this->db->join("tipolector t", "t.id = l.id_tipolector");
        $this->db->where("l.id_lector", $id);
        $resultados = $this->db->get("lectores l");
        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }

    }

    public function guardar($datos)
    {
        return $this->db->insert("lectores", $datos);
    }

    public function update($id, $data)
    {
        $this->db->where("id_lector", $id);
        return $this->db->update("lectores", $data);
    }

    public function delete($id)
    {
        $this->db->where("id_lector", $id);
        return $this->db->delete("lectores");
    }

    public function comprobardni($dni)
    {
        $this->db->select("*");
        $this->db->where('dni', $dni);
        $resultados = $this->db->get('lectores');
        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }
    }
}
