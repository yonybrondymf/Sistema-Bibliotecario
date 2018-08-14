<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Usuarios_model");
        $this->load->model("Tipousuarios_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url() . "cpanel");
        }
    }

    public function index()
    {

        $contenido_interno = array(
            'usuarios' => $this->Usuarios_model->getUsuarios(),
        );

        $contenido_exterior = array(
            'title'     => 'Usuarios',
            'contenido' => $this->load->view('backend/usuarios/index', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function add()
    {

        $contenido_interno = array(
            'tipousuarios' => $this->Tipousuarios_model->getTipousuarios(),
        );

        $contenido_exterior = array(
            'title'     => 'Agregar Usuario',
            'contenido' => $this->load->view('backend/usuarios/add', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);

    }

    public function store()
    {
        $nombres   = $this->input->post("nombres");
        $apellidos = $this->input->post("apellidos");
        $dni       = $this->input->post("dni");
        $telefono  = $this->input->post("telefono");

        $email    = $this->input->post("email");
        $password = $this->input->post("password");

        $idtipousuario = $this->input->post("idtipousuario");

        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('dni', 'DNI', 'trim|required|exact_length[8]|is_unique[usuarios.dni]', array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe', 'exact_length' => 'El %s debe ser 8 digitos'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[usuarios.email]', array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe', 'valid_email' => 'El %s no es valido'));
        $this->form_validation->set_rules('password', 'Contraseña', 'trim|required', array('required' => 'Debes proporcionar una %s.'));
        $this->form_validation->set_rules('idtipousuario', 'Tipo Usuario', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->add();
        } else {
            $dataUsuario = array(

                'nombres'       => ucwords($nombres),
                'apellidos'     => ucwords($apellidos),
                'dni'           => $dni,
                'telefono'      => $telefono,
                'email'         => $email,
                'pass_usuario'  => md5($password),
                'idtipousuario' => $idtipousuario,
            );

            if ($this->Usuarios_model->guardar($dataUsuario)) {
                redirect(base_url() . "backend/usuarios");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "backend/usuarios/add");
            }
        }

    }

    public function edit($id)
    {

        $contenido_interno = array(
            'usuario'      => $this->Usuarios_model->getUsuario($id),
            'tipousuarios' => $this->Tipousuarios_model->getTipoUsuarios(),
        );

        $contenido_exterior = array(
            'title'     => 'Editar Usuario',
            'contenido' => $this->load->view('backend/usuarios/edit', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function update()
    {
        $idUsuario     = $this->input->post("idUsuario");
        $nombres       = $this->input->post("nombres");
        $apellidos     = $this->input->post("apellidos");
        $dni           = $this->input->post("dni");
        $telefono      = $this->input->post("telefono");
        $email         = $this->input->post("email");
        $idtipousuario = $this->input->post("idtipousuario");

        $usuario_actual = $this->Usuarios_model->getUsuario($idUsuario);

        if ($dni != $usuario_actual->dni) {
            $is_unique_dni = '|is_unique[usuarios.dni]';
        } else {
            $is_unique_dni = '';
        }
        if ($email != $usuario_actual->email) {
            $is_unique_email = '|is_unique[usuarios.email]';
        } else {
            $is_unique_email = '';
        }
        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('dni', 'DNI', 'trim|required|exact_length[8]' . $is_unique_dni, array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe', 'exact_length' => 'El %s debe ser 8 digitos'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email' . $is_unique_email, array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe', 'valid_email' => 'El %s no es valido'));
        $this->form_validation->set_rules('idtipousuario', 'Tipo Usuario', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

        if ($this->form_validation->run() == false) {
            $this->edit($idUsuario);
        } else {
            $dataUsuario = array(
                'nombres'       => $nombres,
                'apellidos'     => $apellidos,
                'dni'           => $dni,
                'telefono'      => $telefono,
                'email'         => $email,
                'idtipousuario' => $idtipousuario,
            );

            if ($this->Usuarios_model->update($idUsuario, $dataUsuario)) {
                redirect(base_url() . "backend/usuarios");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "backend/usuarios/edit/" . $idUsuario);
            }
        }

    }

    public function delete($idusuario)
    {

        if ($this->Usuarios_model->delete($idusuario)) {
            echo "usuarios";
        } else {
            redirect(base_url() . "backend/usuarios");
        }
    }

}
