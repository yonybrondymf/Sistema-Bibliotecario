<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Usuarios_model");
    }

    public function index()
    {
        if ($this->session->userdata("login")) {
            redirect(base_url() . "backend/dashboard");
        } else {
            $this->load->view('backend/login');
        }

    }

    public function login()
    {
        $email = $this->input->post("email");
        $pass  = $this->input->post("password");
        $this->load->model('Usuarios_model');
        $res = $this->Usuarios_model->logear($email, md5($pass));
        if ($res) {
            /*echo "Sucess";*/
            $data = array(
                'id_user' => $res->id_usuario,
                'user'    => $res->nombres,
                'login'   => true,
            );
            $this->session->set_userdata($data);
            redirect(base_url() . "backend/dashboard");
        } else {
            $this->session->set_flashdata("error","<span><strong>Lo sentimos,</strong> el email y contraseña ingresados no coinciden con nuestros registros</span>");
            redirect(base_url()."cpanel");
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url() . "cpanel");
    }
}
