<?php if(isset($facultad->id)):?>
    <input type="hidden" name="idfacultad" value="<?php echo $facultad->id;?>">
<?php endif;?>
<div class="form-group <?php echo form_error('nombre') == true ? 'has-error' : '' ?>">
	<div class="col-md-12">
		<label for="nombre">Nombre:</label>
	    <?php if(isset($facultad->nombre)):?>
	      <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $facultad->nombre;?>" required>
	      <?php echo form_error('nombre'); ?>
	    <?php else:?>
	      <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo set_value('nombre'); ?>"required>
	      <?php echo form_error('nombre'); ?>
	    <?php endif;?>
	</div>
</div>