<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Libros extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Libros_model");
        $this->load->model("Facultades_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url() . "cpanel");
        }
    }

    public function index()
    {

        $contenido_interno = array(
            'libros' => $this->Libros_model->getLibros(),
        );

        $contenido_exterior = array(
            'title'     => 'Libros',
            'contenido' => $this->load->view('backend/libros/index', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function add()
    {

        $contenido_interno = array(
            'facultades' => $this->Facultades_model->getFacultades(),
        );

        $contenido_exterior = array(
            'title'     => 'Agregar Libro',
            'contenido' => $this->load->view('backend/libros/add', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);

    }

    public function store()
    {
        $codigo      = $this->input->post("codigo");
        $isbn        = $this->input->post("isbn");
        $titulo      = $this->input->post("titulo");
        $subtitulo   = $this->input->post("subtitulo");
        $autor       = $this->input->post("autor");
        $publicacion = $this->input->post("publicacion");
        $editorial   = $this->input->post("editorial");
        $ediccion    = $this->input->post("ediccion");
        $idioma      = $this->input->post("idioma");
        $ejemplares  = $this->input->post("ejemplares");
        $idfacultad  = $this->input->post("idfacultad");

        $this->form_validation->set_rules('codigo', 'Nombres', 'trim|required|is_unique[libros.codigo_libro]', array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_rules('titulo', 'Titulo', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('autor', 'Autor', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('ejemplares', 'Ejemplares', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('idfacultad', 'Facultad', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->add();
        } else {
            $config['upload_path']   = './assets/images/books';
            $config['allowed_types'] = 'gif|jpg|png';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('imagen')) {
                $imagen = "default-book.png";
            } else {
                $data   = array('upload_data' => $this->upload->data());
                $imagen = $data["upload_data"]["file_name"];
            }

            $dataLibro = array(
                'codigo_libro'      => $codigo,
                'isbn_libro'        => $isbn,
                'titulo_libro'      => $titulo,
                'subtitulo_libro'   => $subtitulo,
                'autor_libro'       => $autor,
                'publicacion_libro' => $publicacion,
                'editorial_libro'   => $editorial,
                'ediccion_libro'    => $ediccion,
                'idioma_libro'      => $idioma,
                'ejemplares_libro'  => $ejemplares,
                'prestados_libro'   => 0,
                'id_facultad'       => $idfacultad,
                "imagen_libro"      => $imagen,
            );

            if ($this->Libros_model->guardar($dataLibro)) {

                redirect(base_url() . "backend/libros");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "backend/libros/add");
            }
        }

    }

    public function edit($id)
    {

        $contenido_interno = array(
            'libro'      => $this->Libros_model->getLibro($id),
            'facultades' => $this->Facultades_model->getFacultades(),
        );

        $contenido_exterior = array(
            'title'     => 'Editar Libro',
            'contenido' => $this->load->view('backend/libros/edit', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function update()
    {
        $idLibro     = $this->input->post("idLibro");
        $codigo      = $this->input->post("codigo");
        $isbn        = $this->input->post("isbn");
        $titulo      = $this->input->post("titulo");
        $subtitulo   = $this->input->post("subtitulo");
        $autor       = $this->input->post("autor");
        $publicacion = $this->input->post("publicacion");
        $editorial   = $this->input->post("editorial");
        $ediccion    = $this->input->post("ediccion");
        $idioma      = $this->input->post("idioma");
        $ejemplares  = $this->input->post("ejemplares");

        $idfacultad = $this->input->post("idfacultad");

        $libro_actual = $this->Libros_model->getLibro($idLibro);

        if ($codigo != $libro_actual->codigo_libro) {
            $is_unique = '|is_unique[libros.codigo_libro]';
        } else {
            $is_unique = '';
        }

        $this->form_validation->set_rules('codigo', 'Nombres', 'trim|required' . $is_unique, array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_rules('titulo', 'Titulo', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('autor', 'Autor', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('ejemplares', 'Ejemplares', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_rules('idfacultad', 'Facultad', 'trim|required', array('required' => 'Debes proporcionar un %s.'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->edit($idLector);
        } else {
            $dataLibro = array(
                'codigo_libro'      => $codigo,
                'isbn_libro'        => $isbn,
                'titulo_libro'      => $titulo,
                'subtitulo_libro'   => $subtitulo,
                'autor_libro'       => $autor,
                'publicacion_libro' => $publicacion,
                'editorial_libro'   => $editorial,
                'ediccion_libro'    => $ediccion,
                'idioma_libro'      => $idioma,
                'ejemplares_libro'  => $ejemplares,
                'id_facultad'       => $idfacultad,
            );

            if ($this->Libros_model->update($idLibro, $dataLibro)) {
                redirect(base_url() . "backend/libros");
            } else {
                //$this->session->set_flashdata("error","No se pudo registrar al usuario");
                redirect(base_url() . "backend/libros/edit/" . $idLector);
            }
        }

    }

    public function delete($idlibro)
    {

        if ($this->Libros_model->delete($idlibro)) {
            echo "libros";
        } else {
            redirect(base_url() . "backend/libros");
        }
    }

    public function disponibilidad()
    {
        $codigo = $this->input->post("codigo");
        $res    = $this->Libros_model->disponibilidad($codigo);
        if ($res && $res->ejemplares_libro > $res->prestados_libro) {
            echo json_encode($res);
        } else {
            return false;
        }
    }

    public function changeImage()
    {
        $idLibro = $this->input->post("idLibro");

        $config['upload_path']   = './assets/images/books';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('imagen')) {
            $imagen = "";
        } else {
            $data   = array('upload_data' => $this->upload->data());
            $imagen = $data["upload_data"]["file_name"];
        }

        $dataLibro = array(
            'imagen_libro' => $imagen,
        );

        if ($this->Libros_model->update($idLibro, $dataLibro)) {
            redirect(base_url() . "backend/libros");
        } else {
            //$this->session->set_flashdata("error","No se pudo registrar al usuario");
            redirect(base_url() . "backend/libros/edit/" . $idLector);
        }

    }
}
