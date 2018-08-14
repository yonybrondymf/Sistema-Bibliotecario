<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios_model extends CI_Model
{
    public function getUsuarios()
    {
        $this->db->select("u.*, t.denominacion as tipousuario");
        $this->db->join("tipousuario t", "t.id = u.idtipousuario");
        $resultados = $this->db->get("usuarios u");
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getUsuario($id)
    {

        $this->db->select("u.*,t.denominacion as denominacion");
        $this->db->join("tipousuario t", "t.id = u.idtipousuario");
        $this->db->where("u.id_usuario", $id);
        $resultados = $this->db->get("usuarios u");
        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }

    }

    public function guardar($datos)
    {
        return $this->db->insert("usuarios", $datos);
    }

    public function update($id, $data)
    {
        $this->db->where("id_usuario", $id);
        return $this->db->update("usuarios", $data);
    }

    public function delete($id)
    {
        $this->db->where("id_usuario", $id);
        return $this->db->delete("usuarios");
    }

    public function logear($email, $password)
    {
        $this->db->select("u.*,t.denominacion");
        $this->db->join("tipousuario t", "t.id = u.idtipousuario");
        $this->db->where('u.email', $email);
        $this->db->where('u.pass_usuario', $password);
        $resultados = $this->db->get("usuarios u");
        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }
    }
}
