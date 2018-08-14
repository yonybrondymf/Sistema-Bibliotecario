<section class="content">
      <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Devoluciones Pendientes</h3>

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
                                <th>Codigo de Libro</th>
                                <th>DNI</th>
                                <th>Lector</th>
                                <th>Fec. de Prestamo</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($prestamos): ?>
                                <?php $i = 1;?>
                                <?php foreach ($prestamos as $prestamo): ?>
                                    <?php if ($prestamo->estado_prestamo == 0): ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $prestamo->codigo_libro; ?></td>

                                            <td><?php echo $prestamo->dni; ?></td>
                                            <td><?php echo $prestamo->nombres . " " . $prestamo->apellidos; ?></td>
                                            <td><?php echo $prestamo->fechaprestamo; ?></td>

                                            <td>
                                                <a href="<?php echo base_url(); ?>backend/prestamos/update/<?php echo $prestamo->id; ?>" class="btn btn-danger btn-xs btn-flat" title="Finalizar Prestamo"><i class="fa fa-hourglass-end" aria-hidden="true"></i> Finalizar</a>

                                            </td>
                                        </tr>
                                        <?php $i++;?>
                                    <?php endif;?>
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
      <!-- /.box -->
</section>