 <?php if (isset($lector->id_lector)): ?>
    <input type="hidden" name="idLector" value="<?php echo $lector->id_lector; ?>">
<?php endif;?>
<div class="col-md-6">
    <div class="form-group <?php echo form_error('nombres') == true ? 'has-error' : '' ?>">
        <label for="nombres">Nombres</label>
        <?php if (isset($lector->nombres)): ?>
            <?php $valor = form_error('nombres') == true ? set_value('nombres') : $lector->nombres;?>;
            <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" value="<?php echo $valor; ?>">
        <?php else: ?>
            <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" value="<?php echo set_value('nombres'); ?>">
        <?php endif;?>
        <?php echo form_error('nombres'); ?>
    </div>
    <div class="form-group <?php echo form_error('apellidos') == true ? 'has-error' : '' ?>">
        <label for="apellidos">Apellidos</label>
        <?php if (isset($lector->apellidos)): ?>
            <?php $valor = form_error('apellidos') == true ? set_value('apellidos') : $lector->apellidos;?>;
            <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" value="<?php echo $valor; ?>">
        <?php else: ?>
            <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" value="<?php echo set_value('apellidos'); ?>">

        <?php endif;?>
        <?php echo form_error('apellidos'); ?>

    </div>
    <div class="form-group <?php echo form_error('dni') == true ? 'has-error' : '' ?>">
        <label for="dni">DNI</label>
        <?php if (isset($lector->dni)): ?>
            <?php $valor = form_error('dni') == true ? set_value('dni') : $lector->dni;?>;
            <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI" value="<?php echo $valor; ?>">
        <?php else: ?>
            <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI" value="<?php echo set_value('dni'); ?>">
        <?php endif;?>
        <?php echo form_error('dni'); ?>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="telefono">Telefono</label>
        <?php if (isset($lector->telefono)): ?>
            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono" value="<?php echo $lector->telefono; ?>">
        <?php else: ?>
            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono">
        <?php endif;?>
    </div>
    <div class="form-group <?php echo form_error('direccion') == true ? 'has-error' : '' ?>">
        <label for="direccion">Direccion</label>
        <?php if (isset($lector->direccion)): ?>
            <?php $valor = form_error('direccion') == true ? set_value('direccion') : $lector->direccion;?>;
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Introduzca Direccion del Lector" value="<?php echo $valor; ?>">
        <?php else: ?>
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Introduzca Direccion del Lector" value="<?php echo set_value('direccion'); ?>">
        <?php endif;?>
        <?php echo form_error('direccion'); ?>
    </div>

    <div class="form-group <?php echo form_error('idtipolector') == true ? 'has-error' : '' ?>">
        <label for="idtipolector" class="control-label">Tipo de Lector</label>
        <select name="idtipolector" id="idtipolector" class="form-control">
            <option value="">Seleccione...</option>
            <?php foreach ($tipolectores as $tipolector): ?>
                <?php if (isset($lector->id_tipolector) && $tipolector->id == $lector->id_tipolector): ?>
                    <option value="<?php echo $tipolector->id; ?>" selected="selected"><?php echo $tipolector->nombre; ?></option>
                <?php else: ?>
                    <option value="<?php echo $tipolector->id; ?>"><?php echo $tipolector->nombre; ?></option>
                <?php endif;?>
            <?php endforeach;?>
        </select>
        <?php echo form_error('idtipolector'); ?>
    </div>
</div>

