/*Personal*/
$(document).ready(function(){
	$("#form_registrarPersona")[0].reset();
	$( "#nacimiento").datepicker({ dateFormat: 'yy-mm-dd' });
	
	$("#submit_data_persona").click(function(){
		if($("#cedula").val().length==0){
			alert('Por favor ingresar cedula')
			return;
		}else
		setPersona();
	});

	$("#searchcid").click(function(){
 	if($("#cedula").val().length<7){
			alert('Por favor ingresar cedula con almenos 7 digitos')
			return;
		}
		else{
	 		$('#editar_data_persona').prop('disabled', false);		
			find_by_cedula($("#cedula").val());
		}
	});

	$("#btn_listar_persona").click(function(){
		listarPersona();
	});

	$("#editar_data_persona").click(function(){
		editarPersona();
	});
});

$.datepicker.setDefaults( $.datepicker.regional[ "Es" ] );

	$.datepicker.regional['Es'] = {
	 closeText: 'Cerrar',
	 prevText: '< Ant',
	 nextText: 'Sig >',
	 currentText: 'Hoy',
	 dateFormat: 'yy-mm-dd',
     showButtonPanel: true,
     changeMonth: true,
     changeYear: true,
	 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
	 weekHeader: 'Sm',
	 firstDay: 1,
	 isRTL: false,
	 showMonthAfterYear: false,
	 yearRange: '1980:c',
	 yearSuffix: ''
	 };
 $.datepicker.setDefaults($.datepicker.regional['Es']);
	$(function () {
	$("#nacimiento").datepicker();
	});
	 

function editarPersona(){
	$.ajax({
		url: '../../control/ControladorPersona.php',
		type: 'post',
		data: {
			accion:2,
			id_persona: $("#id_persona").val(),
			cedula: $("#cedula").val(),
			nombrec: $("#nombrec").val(),
			sexo: $("#sexo").val(),
			nacimiento: $("#nacimiento").val(),
			est_cvl: $("#est_cvl").val(),
			edad: $("#edad").val(),
			direccion: $("#direccion").val(),
			nacionalidad: $("#nacionalidad").val(),
			grupo_sanguineo: $("#grupo_sanguineo").val()
		},
		dataType: 'json',
		success: function (data) {
			if(data){
				$("#form_registrarPersona")[0].reset();
				alert('actualización exitosa');
				$('#editar_data_persona').prop("disabled", true);
				$('#submit_data_persona').prop("disabled", false);
								
			}
			else{
				alert('Error al editar la data.');
				$('#submit_data_persona').prop("disabled", false);
			}

		}
	});
}

function find_by_cedula(cedula){
	$.ajax({
		url: '../../control/ControladorPersona.php',
		type: 'post',
		data: {
			accion:3,
			cedula: cedula
		},
		dataType: 'json',
		success: function (data) {
			if(data.length>0){
				$("#form_registrarPersona")[0].reset();
				$("#id_persona").val(data[0].id_persona);
				$("#cedula").val(data[0].cedula);
				$("#nombrec").val(data[0].nombrec);
				$("#sexo").val(data[0].sexo);
				$("#nacimiento").val(data[0].nacimiento);
				$("#est_cvl").val(data[0].est_cvl);
				$("#edad").val(data[0].edad);
				$("#direccion").val(data[0].direccion);
				$("#nacionalidad").val(data[0].nacionalidad);
				$("#grupo_sanguineo").val(data[0].grupo_sanguineo);
				$("#usuario").val(data[0].usuario);
				$("#tabla_persona").hide();
				$("#form_registrarPersona").show();
				$('#submit_data_persona').prop("disabled", true);
				alert('Trabajador encontrado, solo puede editar la informacion')

			}
			else{
				alert('No hubo coincidencias con su busqueda')
				$("#form_registrarPersona")[0].reset();
				$("#cedula").val(cedula);
			}


		}
	});
}


function setPersona(){
	$.ajax({
		url: '../../control/ControladorPersona.php',
		type: 'post',
		data: {
			accion:1,
			id_persona: $("#id_persona").val(),
			cedula: $("#cedula").val(),
			nombrec: $("#nombrec").val(),
			sexo: $("#sexo").val(),
			nacimiento: $("#nacimiento").val(),
			est_cvl: $("#est_cvl").val(),
			edad: $("#edad").val(),
			direccion: $("#direccion").val(),
			nacionalidad: $("#nacionalidad").val(),
			grupo_sanguineo: $("#grupo_sanguineo").val()

		},
		dataType: 'json',
		success: function (data) {
			if(data){
				$("#form_registrarPersona")[0].reset();
				alert('registro exitoso');
			}
			else{
				alert('Error al almacenar la data.');
			}

		}
	});
}

function listarPersona(){
	$.ajax({
		url: '../../control/ControladorPersona.php',
		type: 'post',
		data: {
			accion:4
		},
		dataType: 'json',
		success: function (persona) {
			if(persona){
				montar_tabla(persona);
				//alert('entra.');
			}
			else{
				alert('Error al almacenar la data.');
			}

		}
	});
}

function montar_tabla(persona){
	var echo="";
	if(persona.length>0){
	    for(var i=0; i< persona.length; i++) {
	        echo+='<div class="grid-15 table1 grid-parent">' + persona[i].nombrec+'</div>'+
	        	 '<div class="grid-10 table1 grid-parent">' + persona[i].cedula+ '</div>'+
	        	 '<div class="grid-5 table1 grid-parent">' + persona[i].sexo+ '</div>'+
	        	 '<div class="grid-10 table1 grid-parent">' + persona[i].nacimiento+ '</div>'+
	        	 '<div class="grid-5 table1 grid-parent">' + persona[i].edad+ '</div>'+
	        	 '<div class="grid-10 table1 grid-parent">' + persona[i].est_cvl+ '</div>'+
	        	 '<div class="grid-25 table1 grid-parent">' + persona[i].direccion+ '</div>'+
	        	 '<div class="grid-10 table1 grid-parent">' + persona[i].nacionalidad+ '</div>'+
	        	 '<div class="grid-5 table1 grid-parent">' + persona[i].grupo_sanguineo+ '</div>'+
	        	 '<div class="grid-5 table1 grid-parent"><a class="button1" id="btn_editar-'+persona[i].cedula+'"><i class="icon-pencil"></i></a></div>';
	    }

	    $("#tabla_persona").empty().append(echo);
	    $("a[id^='btn_editar-']").click(function(){
	    	var id=this.id.split("-");
				var cedula=id[1];
			find_by_cedula(cedula);
		});
		$("#tabla_persona").show();
		$("#form_registrarPersona").hide();
	}
}

