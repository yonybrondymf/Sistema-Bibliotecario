<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Principal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Libros_model");
        $this->load->model("Facultades_model");
    }

    public function index()
    {

        $data = array(
            'title' => "Sistema de biblioteca",
        );
        $this->load->view('frontend/index', $data);
    }

    public function search()
    {
        $codtitulo = $this->input->get("codtitulo", true);
        $facultad  = $this->input->get("facultdad", true);
        $campo     = $this->input->get("campo", true);
        if ($codtitulo || $facultad || $campo) {
            $libros = $this->Libros_model->verificar($codtitulo, $facultad, $campo);
            $this->session->set_flashdata("codtitulo", $codtitulo);
            $this->session->set_flashdata("campo", $campo);
            $this->session->set_flashdata("facultad", $facultad);
        } else {
            $this->session->set_flashdata("codtitulo", false);
            $this->session->set_flashdata("campo", false);
            $this->session->set_flashdata("facultad", false);
            $libros = $this->Libros_model->getLibros();
        }
        $data = array(
            'title'      => "Sistema de biblioteca",
            'facultades' => $this->Facultades_model->getFacultades(),
            'libros'     => $libros,
        );
        $this->load->view('frontend/result', $data);
    }

    public function detalle(){
        $id= $this->input->post("id");
        $detail_libro = $this->Libros_model->getLibro($id);
        if (!$detail_libro) {
            return false;
        }
        else{
            
            echo json_encode($detail_libro);
        }
        
    }
}
