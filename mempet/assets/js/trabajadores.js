/*trabajadores*/
$(document).ready(function(){
	$("#trabajador_form")[0].reset();
	
	$("#submit_data_trabajador").click(function(){
		if($("#cedula3").val().length==0){
			alert('Por favor ingresar cedula')
			return;
		}else
		setTrabajador();
	});

	$("#searchcid3").click(function(){
		if($("#cedula3").val().length<7){
			alert('La cedula deberia contener almenos 7 digitos')
		}
		else{
			$('#editar_data_trabajador').prop("disabled", false);
			find_by_cedula2($("#cedula3").val());
		}
	});

	$("#btn_listar_trabajador").click(function(){
		listarUsuario();
	});

	$("#editar_data_trabajador").click(function(){
		editarTrabajador();
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
	$("#ingreso3").datepicker();
	});
	 

function editarTrabajador(){
	$.ajax({
		url: '../../control/ControladorTrabajador.php',
		type: 'post',
		data: {
			accion:2,
			id_sesion: $("#id_sesion").val(),
			cedula: $("#cedula3").val(),
			nomina: $("#nomina3").val(),
			cargo: $("#cargo3").val(),
			grado: $("#grado3").val(),
			status: $("#status3").val(),
			ingreso: $("#ingreso3").val(),
			nombret: $("#nombret3").val(),
			ficha: $("#ficha3").val(),
			tlf: $("#tlf3_pre").val().concat($("#tlf3").val()),
			email: $("#email3").val(),
			carrera: $("#carrera3").val(),
			departamento: $("#departamento3").val()
		},
		dataType: 'json',
		success: function (data) {
			if(data){
	 			$("#trabajador_form")[0].reset();
				alert('Actualización exitosa');
				$('#editar_data_trabajador').prop("disabled", true);
				$('#submit_data_trabajador').prop("disabled", false);
				
			}
			else{
				alert('Error al almacenar la data.');
				$('#submit_data_trabajador').prop("disabled", false);

			}

		}
	});
}

function getGrado(sel) {
    var value = sel.value;
    if(value == 'Bachiller')  
    {
    	$('#carrera3').prop("disabled", true);

    }
    else
    {
    	$('#carrera3').prop("disabled", false);
    }
}

function find_by_cedula2(cedula){
	$.ajax({
		url: '../../control/ControladorTrabajador.php',
		type: 'post',
		data: {
			accion: 3,
			cedula: cedula
		},
		dataType: 'json',
		success: function (data) {
			if(data.length>0){
				$("#id_sesion3").val(data[0].id_persona);
				$("#cedula3").val(data[0].cedula);
				$("#nombret3").val(data[0].nombret);
				$("#nomina3").val(data[0].nomina);
				$("#email3").val(data[0].email);
				$("#cargo3").val(data[0].cargo);				
				$("#grado3").val(data[0].grado);
				$("#status3").val(data[0].status);
				$("#ingreso3").val(data[0].ingreso);
				$("#ficha3").val(data[0].ficha);
				$("#departamento3").val(data[0].departamento);
				$("#tlf3").val(data[0].tlf_p);
				$("#carrera3").val(data[0].especialidad);
				$("#tabla_trabajadores").hide();
				$("#form_registrarTrabajador").show();
				$('#submit_data_trabajador').prop("disabled", true);
				alert('Trabajador encontrado, solo puede editar')
			}
			else{
				find_by_cedula_persona(cedula);
			}


		}
	});
}

function find_by_cedula_persona(cedula){
	$.ajax({
		url: '../../control/ControladorTrabajador.php',
		type: 'post',
		data: {
			accion: 5,
			cedula: cedula
		},
		dataType: 'json',
		success: function (data) {
			if(data.length>0){
				$("#usuarios_form")[0].reset();
				$("#id_sesion3").val(data[0].id_persona);
				$("#cedula3").val(data[0].cedula);
				$("#nombret3").val(data[0].nombrec);
				$("#tabla_trabajadores").hide();
				$("#form_registrarTrabajador").show();
				alert('usuario registrado solo en Personal, no es un trabajador')
			}
			else{
				alert('No hubo coincidencias con su busqueda, verifique en persona')
				$("#trabajador_form")[0].reset();
				$("#cedula3").val(cedula);
			}


		}
	});
}

function setTrabajador(){
	$.ajax({
		url: '../../control/ControladorTrabajador.php',
		type: 'post',
		data: {
			accion:1,
			id_sesion: $("#id_sesion").val(),
			cedula: $("#cedula3").val(),
			nomina: $("#nomina3").val(),
			cargo: $("#cargo3").val(),
			grado: $("#grado3").val(),
			status: $("#status3").val(),
			ingreso: $("#ingreso3").val(),
			nombret: $("#nombret3").val(),
			ficha: $("#ficha3").val(),
			tlf: $("#tlf3_pre").val().concat($("#tlf3").val()),
			email: $("#email3").val(),
			carrera: $("#carrera3").val(),
			departamento: $("#departamento3").val()
		},
		dataType: 'json',
		success: function (data) {
			if(data.length>0){
				$("#trabajador_form")[0].reset();
				$("#form_registrarTrabajador").hide();
				$("#tabla_Trabajador").show();
				alert('registro exitoso');
			}
			else{
				alert('Error al almacenar la data.');
			}

		}
	});
}

function listarUsuario(){
	$.ajax({
		url: '../../control/ControladorSesiones.php',
		type: 'post',
		data: {
			accion:4
		},
		dataType: 'json',
		success: function (usuario) {
			if(usuario){
				montar_tabla(usuario);
			}

		}
	});
}

function montar_tabla(usuario){
	var echo="";
	if(usuario.length>0){
	    for(var i=0; i< usuario.length; i++) {
	        echo+='<div class="grid-10 table1 grid-parent">' + usuario[i].cedula+ '</div>'+
	        	 '<div class="grid-10 table1 grid-parent">' + usuario[i].nacimiento+ '</div>'+
	        	 '<div class="grid-5 table1 grid-parent">' + usuario[i].edad+ '</div>'+
	        	 '<div class="grid-10 table1 grid-parent">' + usuario[i].est_cvl+ '</div>'+
	        	 '<div class="grid-25 table1 grid-parent">' + usuario[i].direccion+ '</div>'+
	        	 '<div class="grid-10 table1 grid-parent">' + usuario[i].nacionalidad+ '</div>'+
	        	 '<div class="grid-5 table1 grid-parent">' + usuario[i].grupo_sanguineo+ '</div>'+
	        	 '<div class="grid-5 table1 grid-parent"><a class="button1" id="btn_editar-'+usuario[i].cedula+'"><i class="icon-pencil"></i></a></div>';
	    }

	    $("#tabla_usuario").empty().append(echo);
	    $("a[id^='btn_editar-']").click(function(){
	    	var id=this.id.split("-");
				var cedula=id[1];
			find_by_cedula(cedula);
		});
		$("#tabla_usuario").show();
		$("#form_registrarUsuario").hide();
	}
}



