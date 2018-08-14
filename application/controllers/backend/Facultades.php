<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Facultades extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Facultades_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url() . "cpanel");
        }
    }

    public function index()
    {
        $contenido_interno = array(
            'facultades' => $this->Facultades_model->getFacultades(),
        );

        $contenido_exterior = array(
            'title'     => 'Facultades',
            'contenido' => $this->load->view('backend/facultades/index', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function add()
    {
        $data = array(
            'title'     => 'Agregar Facultad',
            'contenido' => $this->load->view('backend/facultades/add', '', true),
        );

        $this->load->view('backend/template', $data);
    }

    public function store()
    {
        $nombre = $this->input->post("nombre");

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|is_unique[facultades.nombre]', array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->add();
        } else {
            $datos = [
                "nombre" => $nombre,
            ];
            if ($this->Facultades_model->guardar($datos)) {
                //$this->session->set_flashdata("msg_success","La categoria ".$nombre." ha sido registrado");
                redirect(base_url() . "backend/facultades");
            } else {
                //$this->session->set_flashdata("msg_error","La categoria ".$name." no pudo registrarse");
                redirect(base_url() . "backend/facultades/add");
            }
        }
    }

    public function edit($idfacultad)
    {
        $contenido_interno = array(
            'facultad' => $this->Facultades_model->getFacultad($idfacultad),
        );

        $contenido_exterior = array(
            'title'     => 'Editar Facultad',
            'contenido' => $this->load->view('backend/facultades/edit', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function update()
    {
        $idfacultad = $this->input->post("idfacultad");
        $nombre     = $this->input->post("nombre");

        $facultad_actual = $this->Facultades_model->getFacultad($idfacultad);

        if ($nombre != $facultad_actual->nombre) {
            $is_unique = '|is_unique[facultades.nombre]';
        } else {
            $is_unique = '';
        }

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required' . $is_unique, array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->edit($idfacultad);
        } else {
            $datos = [
                "nombre" => $nombre,
            ];
            if ($this->Facultades_model->update($idfacultad, $datos)) {
                //$this->session->set_flashdata("msg_success","La informacion de la categoria  ".$name." se actualizo correctamente");
                redirect(base_url() . "backend/facultades");
            } else {
                //$this->session->set_flashdata("msg_error","La informacion de la categoria ".$name." no pudo actualizarse");
                redirect(base_url() . "backend/facultades/edit/" . $idarea);
            }
        }

    }

    public function delete($idarea)
    {
        if ($this->Facultades_model->delete($idarea)) {
            //$this->session->set_flashdata("msg_success","La categoria se elimino correctamente");
            echo "facultades";
        } else {
            //$this->session->set_flashdata("msg_error","No se pudo eliminar la categoria");
            redirect(base_url() . "backend/facultades");
        }
    }

}
