<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prestamos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Prestamos_model");
        $this->load->model("Libros_model");
        $this->load->model("Lectores_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url() . "cpanel");
        }
    }
    public function index()
    {
        redirect(base_url() . "backend/prestamos/all");
    }

    public function pending()
    {
        $contenido_interno = array(
            'prestamos' => $this->Prestamos_model->getPrestamos(),
        );

        $contenido_exterior = array(
            'title'     => 'Prestamos Pendientes',
            'contenido' => $this->load->view('backend/prestamos/pending', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);

    }
    public function all()
    {
        $contenido_interno = array(
            'prestamos' => $this->Prestamos_model->getPrestamos(),
        );

        $contenido_exterior = array(
            'title'     => 'Todos los Prestamos ',
            'contenido' => $this->load->view('backend/prestamos/all', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);

    }

    public function add()
    {
        $contenido_interno = array(
            'libros' => $this->Libros_model->getLibros(),
        );
        $contenido_exterior = array(
            'title'     => 'Agregar Prestamos',
            'contenido' => $this->load->view('backend/prestamos/add', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }
    public function store()
    {
        $idLibro     = $this->input->post("idLibro");
        $idLector    = $this->input->post("idLector");
        $fecprestamo = $this->input->post("fecprestamo");
        $infolibro   = $this->Libros_model->getLibro($idLibro);
        $datos       = array(
            "id_libro"        => $idLibro,
            "id_lector"       => $idLector,
            "fechaprestamo"   => $fecprestamo,
            "estado_prestamo" => 0,
            "id_usuario"      => $this->session->userdata("id_user"),
        );
        if ($this->Prestamos_model->guardar($datos)) {
            $dataLibro = array(
                'prestados_libro' => $infolibro->prestados_libro + 1,
            );
            $dataLector = array(
                'estado' => 0,
            );
            $this->Lectores_model->update($idLector, $dataLector);
            $this->Libros_model->update($idLibro, $dataLibro);
            //$this->session->set_flashdata("msg_success","La categoria ".$nombre." ha sido registrado");
            echo "pending";
        } else {
            //$this->session->set_flashdata("msg_error","La categoria ".$name." no pudo registrarse");
            redirect(base_url() . "backend/facultades/add");
        }
    }

    public function update($idprestamo)
    {
        date_default_timezone_set('America/Lima');
        $res       = $this->Prestamos_model->getPrestamo($idprestamo);
        $infolibro = $this->Libros_model->getLibro($res->id_libro);

        $dataPrestamo = array(
            'fechadevolucion' => date('d/m/Y'),
            'estado_prestamo' => 1,
        );
        if ($this->Prestamos_model->update($idprestamo, $dataPrestamo)) {
            $dataLibro = array(
                'prestados_libro' => $infolibro->prestados_libro - 1,
            );
            $dataLector = array(
                'estado' => 1,
            );

            if ($this->Libros_model->update($res->id_libro, $dataLibro) && $this->Lectores_model->update($res->id_lector, $dataLector)) {
                //$this->session->set_flashdata("msg_success","La informacion de la categoria  ".$name." se actualizo correctamente");
                redirect(base_url() . "backend/prestamos");
            } else {
                //$this->session->set_flashdata("msg_error","La informacion de la categoria ".$name." no pudo actualizarse");
                redirect(base_url() . "backend/prestamos");
            }
        } else {
            redirect(base_url() . "backend/prestamos");
        }

    }
}
