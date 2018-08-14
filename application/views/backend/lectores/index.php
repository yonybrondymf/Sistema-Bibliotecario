<section class="content">
      <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Lista de  Lectores</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
             </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12 text-right">
                    <a href="<?php echo base_url(); ?>backend/lectores/add" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Lector</a>
                </div>
            </div>
            <!-- /.row -->
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <table id="example1" class="table table-bordered table-dataTables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>DNI</th>
                                <th>Telefono</th>
                                <th>Direccion</th>
                                <th>Disponible</th>
                                <th>Tipo de Lector</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($lectores): ?>
                            <?php $i = 1;?>
                            <?php foreach ($lectores as $lector): ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $lector->nombres; ?></td>
                                    <td><?php echo $lector->apellidos; ?></td>
                                    <td><?php echo $lector->dni; ?></td>
                                    <td><?php echo $lector->telefono; ?></td>

                                    <td><?php echo $lector->direccion; ?></td>
                                    <?php if ($lector->estado == 1): ?>
                                        <td><i class="fa fa-check text-green" aria-hidden="true"></i></td>
                                    <?php else: ?>
                                        <td><i class="fa fa-times text-red" aria-hidden="true"></i></td>
                                    <?php endif;?>


                                    <td><?php echo $lector->tipolector; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>backend/lectores/edit/<?php echo $lector->id_lector; ?>" class="btn btn-info btn-xs btn-flat" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <a href="<?php echo base_url(); ?>backend/lectores/delete/<?php echo $lector->id_lector; ?>" class="btn btn-warning btn-remove btn-xs btn-flat" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
                                    </td>
                                </tr>
                                <?php $i++;?>
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