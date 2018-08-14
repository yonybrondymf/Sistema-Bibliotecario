<section class="content">
      <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Registrar Prestamo</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
             </div>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <table id="example1" class="table table-bordered table-dataTables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Codigo</th>

                                <th>Titulo</th>

                                <th>Estado</th>
                                <th>Facultad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($libros): ?>
                                <?php $i = 1;?>
                            <?php foreach ($libros as $libro): ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $libro->codigo_libro; ?></td>
                                    <td><?php echo $libro->titulo_libro; ?></td>
                                    <?php $disponibles = $libro->ejemplares_libro - $libro->prestados_libro;?>
                                    <?php if ($disponibles == 0): ?>
                                        <td><span class="label label-danger">No Disponible</span></td>

                                    <?php else: ?>
                                        <td><span class="label label-success">Disponible</span></td>
                                    <?php endif;?>
                                    <td><?php echo $libro->facultad; ?></td>

                                    <?php if ($disponibles == 0): ?>
                                        <td><button type="button" class="btn btn-warning btn-sm" disabled="disabled"><i class="fa fa-check" aria-hidden="true"></i> Seleccionar</button></td>

                                    <?php else: ?>
                                        <td><button type="button" class="btn btn-warning btn-sm btn-select" value="<?php echo $libro->id_libro ?>" data-toggle="modal" data-target="#myModal" ><i class="fa fa-check" aria-hidden="true"></i> Seleccionar</button></td>
                                    <?php endif;?>
                                </tr>
                                <?php $i++;?>
                            <?php endforeach;?>
                        <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      <!-- /.box -->
    </div>
</section>

    <div class="modal modal-primary fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
                <strong>FORMULARIO DE PRESTAMO</strong>
          </div>
          <form class="form-horizontal" id="form-prestamo" role="form" action="<?php echo base_url(); ?>backend/prestamos/store" method="POST">
          <div class="modal-body">

                <div class="form-group">
                    <label  class="col-sm-3 control-label" for="codigo">Codigo del Libro:</label>
                    <div class="col-sm-4">
                        <input type="hidden" name="idLibro">
                        <input type="text" class="form-control" id="codigo" disabled="disabled" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="dni" >DNI del Lector:</label>
                    <div class="col-sm-4">
                        <input type="hidden" name="idLector">
                        <input type="text" class="form-control" id="dni" placeholder="dni" required/>
                    </div>
                    <button type="button" id="btn-comprobardni" class="btn btn-warning btn-flat"> <i class="fa fa-search" aria-hidden="true"></i> Comprobar</button>
                    <a href="<?php echo base_url(); ?>backend/lectores/add" class="btn btn-danger btn-flat"><i class="fa fa-sign-in" aria-hidden="true"></i> Registrar</a>

                </div>
                <div class="form-group">
                    <label for="nombre" class="col-sm-3 control-label">Lector:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="nombres" placeholder="Nombres del Lector" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fecha" class="col-md-3 control-label">Fecha Prestamo:</label>
                    <div class="col-md-4">
                        <input type="text" name="fecprestamo" class="form-control" id="fecha" placeholder="Ingrese fecha de Prestamo" required>
                    </div>
                </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-outline">Guardar</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
