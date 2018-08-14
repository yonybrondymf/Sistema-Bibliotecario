
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SISGEB - <?php echo $title; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->

    <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
</head>
<body>
    <div class="content">
        <div class="header">
            <h1>Sistema de Gestion Bibliotecario</h1>
        </div>
        <div class="container content-search">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>Mediante los cuadros de texto puede buscar cualquier libro</p>
                </div>
            </div>
            <div class="row">
                <form class="form-horizontal form-search" action="<?php echo base_url(); ?>frontend/principal/search" method="GET">
                    <div class="form-group">
                        <div class="col-md-2">
                            <select name="campo" class="form-control">
                                <option value="1" <?php echo $this->session->flashdata('campo') && $this->session->flashdata('campo') == 1 ? 'selected' : ''; ?>>Titulo</option>
                                <option value="2" <?php echo $this->session->flashdata('campo') && $this->session->flashdata('campo') == 2 ? 'selected' : ''; ?>>Codigo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="codtitulo" class="form-control" value="<?php echo $this->session->flashdata("codtitulo") == true ? $this->session->flashdata("codtitulo") : '' ?>" placeholder="Introduzca codigo o titulo del libro">
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="facultdad">
                                <option value="">Seleccione facultad...</option>
                                <?php foreach ($facultades as $facultad): ?>
                                    <?php if ($this->session->flashdata('facultad') && $this->session->flashdata('facultad') == $facultad->id): ?>
                                        <option value="<?php echo $facultad->id; ?>" selected="selected"><?php echo $facultad->nombre; ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo $facultad->id; ?>"><?php echo $facultad->nombre; ?></option>
                                    <?php endif;?>
                                <?php endforeach;?>
                             </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                        </div>
                        <div class="col-md-2">
                            <a href="<?php echo base_url(); ?>frontend/principal/search" class="btn btn-danger btn-block"><i class="fa fa-eye" aria-hidden="true"></i> Ver Todo</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>ISBN</th>
                                <th>Titulo</th>
                                <th>Autor</th>
                                <th>Disponibles</th>
                                <th>Facultad</th>
                                <th>Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($libros)): ?>
                            <?php foreach ($libros as $libro): ?>
                                <tr>
                                    <td><?php echo $libro->codigo_libro; ?></td>
                                    <td><?php echo $libro->isbn_libro; ?></td>
                                    <td><?php echo $libro->titulo_libro; ?></td>
                                    <td><?php echo $libro->autor_libro; ?></td>
                                    <?php $disponibles = $libro->ejemplares_libro - $libro->prestados_libro;?>
                                    <?php if ($disponibles == 0): ?>
                                        <td><span class="label label-danger">Ninguno</span></td>

                                    <?php else: ?>
                                        <td><?php echo $disponibles; ?></td>
                                    <?php endif;?>

                                    <td><?php echo $libro->facultad; ?></td>
                                    <td><button type="button" class="btn btn-link btn-detalle" value="<?php echo $libro->id_libro; ?>"data-toggle="modal" data-target="#myModal" >Ver</button></td>

                                </tr>
                            <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal  fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">DESCRIPCION DEL LIBRO</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="" alt="" class="imagen img-responsive">
                        </div>
                        <div class="col-sm-8">
                            <dl>
                                <dt>CODIGO:</dt>
                                <dd class="codigo_libro"></dd>
                                <dt>TITULO:</dt>
                                <dd class="titulo_libro"></dd>
                                <dt>SUBTITULO:</dt>
                                <dd class="subtitulo_libro"></dd>
                                <dt>AUTOR:</dt>
                                <dd class="autor_libro"></dd>
                                <dt>ISBN:</dt>
                                <dd class="isbn_libro"></dd>
                                <dt>AÑO DE PUBLICACION:</dt>
                                <dd class="publicacion_libro"></dd>
                                <dt>EDITORIAL:</dt>
                                <dd class="editorial_libro"></dd>
                                <dt>EDICCION:</dt>
                                <dd class="ediccion_libro"></dd>
                                <dt>IDIOMA:</dt>
                                <dd class="idioma_libro"></dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        <!-- /.modal-content -->
        </div>
      <!-- /.modal-dialog -->
    </div>

<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->

<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
    var base_url = "<?php echo base_url();?>";
</script>
<script>
    $(function () {

        /*$(".btn-detalle").on("click", function(event){
            event.preventDefault();
            //alert("Quieres mostrar los detalles");
            $.ajax({
                type: "POST",
                url: $(this).attr("href")
            }).done(function(resp) {
                if (!resp) {
                    alert("Quieres mostrar los detalles");
                    //var result = JSON.parse(resp);
                    //$("p.cod_libro").text(result.codigo_libro);
                }
            });
        });*/

        $(".btn-detalle").on("click", function(){
            idlibro = $(this).val();
           //alert(idlibro);

                $.ajax({
                    type: "POST",
                    url: base_url +" frontend/principal/detalle",
                    data: { id: idlibro }
                }).done(function(msg) {
                    if (msg) {
                       var result = JSON.parse(msg);
                       //alert(result.codigo_libro);
                       $(".codigo_libro").text(result.codigo_libro);
                       $(".titulo_libro").text(result.titulo_libro);
                       $(".subtitulo_libro").text(result.subtitulo_libro);
                       $(".autor_libro").text(result.autor_libro);
                       $(".isbn_libro").text(result.isbn_libro);
                       $(".publicacion_libro").text(result.publicacion_libro);
                       $(".editorial_libro").text(result.editorial_libro);
                       $(".ediccion_libro").text(result.ediccion_libro);
                       $(".idioma_libro").text(result.idioma_libro);
                       $("img.imagen").attr("src","http://localhost/sistemabiblioteca/assets/images/books/"+ result.imagen_libro);
                    }else{
                        alert("error");
                    }

                });


        });

        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "language": {
                            "lengthMenu": "Mostrar _MENU_ registros por pagina",
                            "zeroRecords": "No se encontraron resultados en su busqueda",
                            "searchPlaceholder": "Buscar registros",
                            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
                            "infoEmpty": "No existen registros",
                            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                            "search": "Buscar:",
                            "paginate": {
                                    "first":    "Primero",
                                    "last":    "Último",
                                    "next":    "Siguiente",
                                    "previous": "Anterior"
                            },
                        }
        });

    });
</script>
</body>
</html>