<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Usuarios_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url() . "cpanel");
        }
    }

    public function index()
    {
        $data = array(
            'title'     => 'Tablero Principal',
            'contenido' => $this->load->view('backend/dashboard', '', true),
        );

        $this->load->view('backend/template', $data);
    }
}
