/*trabajadores*/

$(document).ready(function(){
	$("#familiar_form")[0].reset();
	$("#submit_data_familia").click(function(){
		if($("#cedula4").val().length==0){
			alert('Ingrese cedula para continuar')
			return;
			
		}else{
			setFamilia();
		}	
	});

	$("#searchcid4").click(function(){
		
		 	if ($("#cedula4").val().length<7){
			alert('Por favor ingresar cedula con almenos 7 digitos')
			return;
			} 
			else{
			$('#editar_data_familiar').prop("disabled", false);
			existetrab($("#cedula4").val());
		}
	});
	
	$("#cedula_fam").blur(function(){
		
		 	if ($("#cedula_fam").val().length<7){
			alert('Por favor ingresar cedula con almenos 7 digitos')
			return;
			} 
			else{
			//$('#editar_data_familiar').prop("disabled", false);
			//cargarfamiliares($("#cedula4").val());
			find_by_cedula5($("#cedula4").val(),$("#cedula_fam").val());
		}
	});

	$("#btn_listar_familia").click(function(){
		listarUsuario();
	});

	$("#editar_data_familiar").click(function(){
		editarFamilia();
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
	 yearRange: '1940:c',
	 yearSuffix: ''
	 };

	$.datepicker.setDefaults($.datepicker.regional['Es']);
	$(function () {
	$("#fecha_nac4").datepicker();
	});
});


function existetrab(cedula){

	$.ajax({
		url: '../../control/ControladorTrabajador.php',
		type: 'post',
		data: {
			accion: 3,
			cedula: $("#cedula4").val(),
		},
		dataType: 'json',
		success: function (data) {
			if(data.length>0){
				//$("#familiar_form")[0].reset();
			$('#submit_data_familia').prop("disabled", false);
				alert('Trabajador existe');
				/*montar_tabla(data)
				$("#form_registrarFamilia").hide();
				$("#tabla_Familia").show();*/
			}
			else{
			$('#submit_data_familia').prop("disabled", true);				
				existeper(cedula);			
			}

		}
	});

}

function existeper(cedula){

	$.ajax({
		url: '../../control/ControladorPersona.php',
		type: 'post',
		data: {
			accion: 3,
			cedula: $("#cedula4").val(),
		},
		dataType: 'json',
		success: function (data) {
			if(data.length>0){
				//$("#familiar_form")[0].reset();
				alert('La cedula está registrada, pero no es trabajador, no podrá asignarle carga familiar');
				/*montar_tabla(data)
				$("#form_registrarFamilia").hide();
				$("#tabla_Familia").show();*/
			}
			else{
				alert('La cedula no está registrada en la base de datos');
			}

		}
	});

}

function editarFamilia(){
	$.ajax({
		url: '../../control/ControladorFamilia.php',
		type: 'post',
		data: {
			accion:2,
			id_sesion: $("#id_sesion").val(),
			cedula: $("#cedula5").val(),
			parentesco: $("#parentesco4").val(),
			edad_f: $("#edad_fam4").val(),
			condicion: $("#condicion4").val(),
			nacimiento_f: $("#fecha_nac4").val(),
			nombref: $("#nombre_fam4").val(),
			ced_trabajador: $("#cedula4").val(),
		},
		dataType: 'json',
		success: function (data) {
			if(data){
				$("#familiar_form")[0].reset();
				alert('Actualización exitosa');
				$('#editar_data_familiar').prop("disabled", true);
				/*montar_tabla(data)
				$("#form_registrarFamilia").hide();
				$("#tabla_Familia").show();*/
			}
			else{
				alert('Error al almacenar la data.');
				//alert ('<?php echo $query; ?>');
			}

		}
	});
}

 function cargarfamiliares(cedula){
        //Disparar funcion al hacer clic en el boton Ajax
        $.ajax({
          data: {
	          	 accion : 6 ,
	          	 cedula :cedula
          		},
          type: "POST",
          async: true,
          dataType: "json",
          url: "../../control/ControladorFamilia.php",         
          success: function(resp){
            if (resp.success){
              $("#cedula5").html(resp.lista_fam);  
            }else{
              alert(resp.message);
				$("#familiar_form")[0].reset();
            } 
          }
        });
      }//fin function


$(document).ready(function(){
	$("#familiar_form")[0].reset();
	$("#cedula5").change(function(){
		if($("#cedula5").val().length<7){
			alert('La cedula deberia contener almenos 7 digitos')
		}
		else{
			find_by_cedula4($("#cedula5").val());
		}
	});
});



function find_by_cedula3(cedula){
	$.ajax({
		url: '../../control/ControladorFamilia.php',
		type: 'post',
		data: {
			accion: 3,
			cedula: cedula
		},
		dataType: 'json',
		success: function (data) {
			if(data.length>0){
				$("#id_sesion4").val(data[0].id_familiar);
				$("#cedula4").val(data[0].ced_trabajador);
				$("#cedula5").val(data[0].cedula);
				$("#parentesco4").val(data[0].parentesco);
				$("#condicion4").val(data[0].condicion);
				
				$("#fecha_nac4").val(data[0].nacimiento_familiar);				
				$("#nombre_fam4").val(data[0].nombref);
				$("#edad_fam4").val(data[0].edad_c);
				$("#ingreso3").val(data[0].ingreso);
				$("#ficha3").val(data[0].ficha);
				$("#departamento3").val(data[0].departamento);
				$("#tlf3").val(data[0].tlf_p);
				$("#carrera3").val(data[0].especialidad);
				
				$("#tabla_familia").hide();
				$("#form_registrarFamilia").show();
			}
			else{
				alert('No hubo coincidencias con su busqueda')
				$("#familiar_form")[0].reset();
				$("#cedula4").val(cedula);
			}


		}
	});
}

function find_by_cedula4(cedula){
	$.ajax({
		url: '../../control/ControladorFamilia.php',
		type: 'post',
		data: {
			accion: 5,
			cedula: cedula
		},
		dataType: 'json',
		success: function (data) {
			if(data.length>0){
				$("#id_sesion4").val(data[0].id_familiar);
				$("#cedula4").val(data[0].ced_trabajador);
				$("#cedula5").val(data[0].cedula);
				$("#parentesco4").val(data[0].parentesco);
				$("#condicion4").val(data[0].condicion);
				
				$("#fecha_nac4").val(data[0].nacimiento_familiar);				
				$("#nombre_fam4").val(data[0].nombref);
				$("#edad_fam4").val(data[0].edad_c);
				$("#ingreso3").val(data[0].ingreso);
				$("#ficha3").val(data[0].ficha);
				$("#departamento3").val(data[0].departamento);
				$("#tlf3").val(data[0].tlf_p);
				$("#carrera3").val(data[0].especialidad);
				
				$("#tabla_familia").hide();
				$("#form_registrarFamilia").show();
			}
			else{
				alert('Esa cedula no se encuentra en familiar, proceda a ingresarlo');
				//$("#familiar_form")[0].reset();
			}


		}
	});
}

function find_by_cedula5(cedula_t, cedula_f){
	$.ajax({
		url: '../../control/ControladorFamilia.php',
		type: 'post',
		data: {
			accion: 7,
			cedula_t: cedula_t,
			cedula_f: cedula_f
		},
		dataType: 'json',
		success: function (data) {
			if(data.length>0){
			$('#cedula5').prop("disabled", false);
			$('#cedula_fam').prop("disabled", true);
			cargarfamiliares($("#cedula4").val());
			//$("#cedula5").prev('li').prop('cedula5', 'temporal1');
			//$("#temporal").prev('li').prop('temporal', 'cedula5');

			}
			else{
				alert('Ingrese los datos del familiar');
				//$("#familiar_form")[0].reset();
				//$("#cedula4").val(cedula);
			}


		}
	});
}

function setFamilia(){
	
		//var cedula: 
	
	$.ajax({
		url: '../../control/ControladorFamilia.php',
		type: 'post',			
		data: {
			accion:1,
			id_sesion: $("#id_sesion").val(),
			cedula: $("#cedula_fam").val(),
			parentesco: $("#parentesco4").val(),
			edad_f: $("#edad_fam4").val(),
			condicion: $("#condicion4").val(),
			nacimiento_f: $("#fecha_nac4").val(),
			nombref: $("#nombre_fam4").val(),
			ced_trabajador: $("#cedula4").val(),
		},
		dataType: 'json',
		success: function (data) {
			if(data){
				$("#familiar_form")[0].reset();
				alert('registro exitoso');
				montar_tabla(data)
				$("#form_registrarFamilia").hide();
				$("#tabla_Familia").show();
				alert('registro exitoso');
			}
			else{
				alert('Error al almacenar la data.');
			}

		}
	});
}

function listarFamilia(){
	$.ajax({
		url: '../../control/ControladorFamilia.php',
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



