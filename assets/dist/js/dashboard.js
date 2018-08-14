$(function () {
		$(".info-libro").hide();
		$("#example1").DataTable({
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
		$("#example2").DataTable({
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
		$(document).on("click","#btn-comprobardni", function(){
			dni = $("#dni").val();
			if(dni==""){
				alertify.error("El campo DNI esta vacio");
			}
			else if(dni.length != 8){
				alertify.error("El campo DNI tener 8 digitos");
			}
			else{

				$.ajax({
				  	type: "POST",
				  	url: base_url+"backend/lectores/comprobardni",
				  	data: { dni: dni }
				}).done(function(msg) {
				    if (msg === "nf") {
				    	$("#nombres").val("");
				    	alertify.error("El Lector no existe...haga clic boton Registrar para registrarlo");
				    }
				    else if (msg === "na") {
				    	$("#nombres").val("");
				    	alertify.error("El Lector esta registrado...pero no esta disponible");
				    }
				    else{
				    	var result = JSON.parse(msg);
				    	$("input[name=idLector]").val(result.id_lector);
				    	$("#nombres").val(result.nombres + " " +result.apellidos);
				    }
				});
			}

		});

		$(document).on("click", "a.btn-remove",function(e){
			e.preventDefault();
			url = $(this).attr("href");
			alertify.confirm("Deseas Eliminar este registro?", function(e){

				if(e){
					$.ajax({
					  	method: "POST",
					  	url: url,
					}).done(function(resp) {
					   window.location.href= base_url+"backend/"+resp;
					});
				}
			});

		});
		$(document).on("click",".btn-image", function(){
			idLibro = $(this).val();
			imagen = $(this).parent().parent().find("td:eq(6)").children("img").attr("src");
			$(".image-actual").attr("src",imagen);
			$("input[name=idLibro]").val(idLibro);
		});
		$("a#logout").on("click", function(e){
			e.preventDefault();
			url = $(this).attr("href");
			alertify.confirm("¿Estas seguro de salir del Sistema?", function(e){

				if(e){
					$.ajax({
					  	method: "POST",
					  	url: url,
					}).done(function(resp) {
					   window.location.href= base_url +"cpanel";
					});
				}
			});

		});
		$("#datepicker").datepicker( {
		    format: " yyyy",
		    viewMode: "years",
		    minViewMode: "years",
		    autoclose: true
	    });

	    $('#fecha').datepicker({
	    	format: 'dd/mm/yyyy',
	    	language: "es",
	    	todayBtn: true,
	      	autoclose: true,
	      	todayBtn: 'linked'
	    });

	    $("#form-prestamo").submit(function(e){
	    	e.preventDefault();
	    	if($("#nombres").val()=="")
	    	{
	    		alertify.alert("El campo Lector esta vacio...Si ingreso un DNI haga clic en el boton Comprobar");
	    	}
	    	else{
	    		$.ajax({
	    			url : $(this).attr("action"),
	    			type : $(this).attr("method"),
	    			data: $(this).serialize()
	    		})
	    		.done(function(resp) {

					window.location.href= base_url+"backend/prestamos/"+resp;
				});
	    	}

	    });
	    $(document).on("click", ".btn-select",function(){
	    	codigo = $(this).parent().parent().find("td:eq(1)").text();
	    	idLibro = $(this).val();

	    	$("input[name=idLibro]").val(idLibro);
	    	$("#codigo").val(codigo);

	    });
	});