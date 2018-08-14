<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Libros_model extends CI_Model
{
    public function getLibros()
    {
        $this->db->select("l.*, f.nombre as facultad");
        $this->db->join("facultades f", "f.id = l.id_facultad");
        $resultados = $this->db->get("Libros l");
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getLibro($id)
    {

        $this->db->select("l.*, f.nombre as facultad");
        $this->db->join("facultades f", "f.id = l.id_facultad");
        $this->db->where("l.id_libro", $id);
        $resultados = $this->db->get("libros l");
        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }

    }

    public function guardar($datos)
    {
        return $this->db->insert("libros", $datos);
    }

    public function update($id, $data)
    {
        $this->db->where("id_libro", $id);
        return $this->db->update("libros", $data);
    }

    public function delete($id)
    {
        $this->db->where("id_libro", $id);
        return $this->db->delete("libros");
    }
    public function disponibilidad($codigo)
    {
        

        $this->db->select("l.*, f.nombre as facultad");
        $this->db->join("facultades f", "f.id = l.id_facultad");
        $this->db->where("l.codigo_libro", $codigo);
        $resultados = $this->db->get("libros l");
        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }
    }
    public function verificar($codtitulo, $idfacultad, $campo)
    {
        $this->db->select("l.*,f.nombre as facultad");
        $this->db->join("facultades f", "f.id = l.id_facultad");
        if ($idfacultad !== "") {
            $this->db->where("l.id_facultad", $idfacultad);
        }
       
        if ($campo == 1) {
            $this->db->like('l.titulo_libro', $codtitulo);
        }
        else{
            $this->db->where('l.codigo_libro', $codtitulo);
        }
         
        
        

        $resultados = $this->db->get('libros l');
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }
}
