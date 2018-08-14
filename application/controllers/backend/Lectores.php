<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lectores extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Lectores_model");
        $this->load->model("Tipolectores_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url() . "cpanel");
        }
    }

    public function index()
    {

        $contenido_interno = array(
            'lectores' => $this->Lectores_model->getLectores(),
        );

        $contenido_exterior = array(
            'title'     => 'Lectores',
            'contenido' => $this->load->view('backend/lectores/index', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function add()
    {

        $contenido_interno = array(
            'tipolectores' => $this->Tipolectores_model->getTipolectores(),
        );

        $contenido_exterior = array(
            'title'     => 'Agregar Lector',
            'contenido' => $this->load->view('backend/lectores/add', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);

    }

    public function store()
    {
        $nombres   = $this->input->post("nombres");
        $apellidos = $this->input->post("apellidos");
        $dni       = $this->input->post("dni");
        $telefono  = $this->input->post("telefono");

        $direccion = $this->input->post("direccion");

        $idtipolector = $this->input->post("idtipolector");

        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('dni', 'DNI', 'trim|required|exact_length[8]|is_unique[lectores.dni]', array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe', 'exact_length' => 'El %s debe ser 8 digitos'));
        $this->form_validation->set_rules('direccion', 'Direccion', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('idtipolector', 'Tipo Lector', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->add();
        } else {
            $dataUsuario = array(

                'nombres'       => ucwords($nombres),
                'apellidos'     => ucwords($apellidos),
                'dni'           => $dni,
                'telefono'      => $telefono,
                'direccion'     => $direccion,
                'estado'        => 1,
                'id_tipolector' => $idtipolector,
            );

            if ($this->Lectores_model->guardar($dataUsuario)) {
                redirect(base_url() . "backend/lectores");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "backend/lectores/add");
            }
        }

    }

    public function edit($id)
    {

        $contenido_interno = array(
            'lector'       => $this->Lectores_model->getLector($id),
            'tipolectores' => $this->Tipolectores_model->getTipolectores(),
        );

        $contenido_exterior = array(
            'title'     => 'Editar Lector',
            'contenido' => $this->load->view('backend/lectores/edit', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function update()
    {
        $idLector     = $this->input->post("idLector");
        $nombres      = $this->input->post("nombres");
        $apellidos    = $this->input->post("apellidos");
        $dni          = $this->input->post("dni");
        $telefono     = $this->input->post("telefono");
        $direccion    = $this->input->post("direccion");
        $idtipolector = $this->input->post("idtipolector");

        $lector_actual = $this->Lectores_model->getLector($idLector);

        if ($dni != $lector_actual->dni) {
            $is_unique = '|is_unique[lectores.dni]';
        } else {
            $is_unique = '';
        }
        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('dni', 'DNI', 'trim|required|exact_length[8]' . $is_unique, array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe', 'exact_length' => 'El %s debe ser 8 digitos'));
        $this->form_validation->set_rules('direccion', 'Direccion', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('idtipolector', 'Tipo Lector', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->edit($idLector);
        } else {
            $dataLector = array(
                'nombres'       => ucwords($nombres),
                'apellidos'     => ucwords($apellidos),
                'dni'           => $dni,
                'telefono'      => $telefono,
                'direccion'     => $direccion,
                'id_tipolector' => $idtipolector,
            );

            if ($this->Lectores_model->update($idLector, $dataLector)) {
                redirect(base_url() . "backend/lectores");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "backend/lectores/edit/" . $idLector);
            }
        }

    }

    public function delete($idlector)
    {

        if ($this->Lectores_model->delete($idlector)) {
            echo "lectores";
        } else {
            redirect(base_url() . "backend/lectores");
        }
    }

    public function comprobardni()
    {
        $dni = $this->input->post("dni");
        $res = $this->Lectores_model->comprobardni($dni);
        if ($res) {
            if ($res->estado == 1) {
                echo json_encode($res);
            } else {
                echo "na"; // not available
            }

        } else {
            echo "nf"; // not found
        }
    }

}
