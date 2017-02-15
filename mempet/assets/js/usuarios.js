/*usuarios*/

$(document).ready(function(){
	$("#usuarios_form")[0].reset();
	$("#submit_data_usuario").click(function(){
		if($("#cedula2").val().length==0){
			alert('Por favor ingresar cedula')
			return;
		}else
		setUsuario();
	});

	$("#searchcid2").click(function(){
		if($("#cedula2").val().length<7){
			alert('La cedula deberia contener almenos 7 digitos')
		}
		else{
			$('#editar_data_usuario').prop("disabled", false);
			find_by_cedula1($("#cedula2").val());
		}
	});

	
		

	$("#editar_data_usuario").click(function(){
		editarUsuario();
	});

	$("#btn_listar_usuario").click(function(){
		listarUsuario();
	});
});

function editarUsuario(){
	$.ajax({
		url: '../../control/ControladorSesiones.php',
		type: 'post',
		data: {
			accion:2,
			//id_sesion: $("#id_sesion").val(),
			cedula: $("#cedula2").val(),
			usuario: $("#usuario2").val(),
			email: $("#email2").val(),
			password: $("#password2").val(),
			tipousuario: $("#tipousuario2").val(),
			//usuario: $("#usuario").val()
		},
		dataType: 'json',
		success: function (data) {
			if(data){
				$("#usuarios_form")[0].reset();
				alert('Actualización exitosa');
				$('#editar_data_usuario').prop("disabled", true);
				//montar_tabla(data)
				//$("#form_registrarUsuario").hide();
				//$("#tabla_usuario").show();
			}
			else{
				alert('Error al almacenar la data.');
				//alert ('<?php echo $query; ?>');

			}

		}
	});
}


function find_by_cedula1(cedula){
	$.ajax({
		url: '../../control/ControladorSesiones.php',
		type: 'post',
		data: {
			accion: 3,
			cedula: cedula
		},
		dataType: 'json',
		success: function (data) {
			if(data.length>0){
				$("#usuarios_form")[0].reset();
				$("#id_sesion2").val(data[0].id_persona);
				$("#cedula2").val(data[0].ced_trabajador);
				$("#usuario2").val(data[0].usuario);
				$("#tipousuario2").val(data[0].tipousuario);
				$("#password2").val(data[0].password);
				$("#password").val(data[0].password);
				$("#email2").val(data[0].email);
				$("#tabla_sesiones").hide();
				$("#form_registrarUsuario").show();
				alert('Existe coincidencias de busqueda');
			}
			 else{
				find_by_cedula_traba(cedula);
			}


		}
	});
}

function find_by_cedula_traba(cedula){
	$.ajax({
		url: '../../control/ControladorSesiones.php',
		type: 'post',
		data: {
			accion: 5,
			cedula: cedula
		},
		dataType: 'json',
		success: function (data) {
			if(data.length>0){
				$("#usuarios_form")[0].reset();
				$("#id_sesion2").val(data[0].id_persona);
				$("#cedula2").val(data[0].cedula);
				$("#email2").val(data[0].email);
				$("#tabla_sesiones").hide();
				$("#form_registrarUsuario").show();
				alert('La cedula solicitada existe en la tabla trabajador pero no posee usuario')
			}
			else{
				$("#usuarios_form")[0].reset();
				$("#cedula2").val(cedula);
				alert('No hubo coincidencias con su busqueda')
				
			}


		}
	});
}


function setUsuario(){
	$.ajax({
		url: '../../control/ControladorSesiones.php',
		type: 'post',
		data: {
			accion:1,
			id_sesion: $("#id_sesion").val(),
			cedula: $("#cedula2").val(),
			usuario: $("#usuario2").val(),
			password: $("#password2").val(),
			email: $("#email2").val(),
			tipousuario: $("#tipousuario2").val(),
			
		},
		dataType: 'json',
		success: function (data) {
			if(data){
				$("#usuarios_form")[0].reset();
				alert('registro exitoso');
				montar_tabla(data)
				$("#form_registrarUsuario").hide();
				$("#tabla_usuario").show();
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
				//(usuario);
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
			find_by_cedula1(cedula);
		});
		$("#tabla_usuario").show();
		$("#form_registrarUsuario").hide();
	}
}


