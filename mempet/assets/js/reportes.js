$(document).ready(function(){
	$("#form_reportes")[0].reset();
	$("#searchcid").click(function(){
 	if($("#cedula").val().length<7){
			alert('La cedula deberia contener almenos 7 digitos')
		}
		else {find_by_cedula($("#cedula").val());}
	});

	/*$("#tipo_reporte").change(function(){
           // alert($("#tipo_reporte").val());
            $('#submit_reportes').val($(this).val());
	});*/
	$("#submit_reportes").click(function(){
		//alert($("#cedula_reporte").val());
		switch ($("#tipo_reporte").val()) 
		{

		   case '1':
		   			ReporteTrabajador();
		      break;

		   case '2':
		   			ReporteCurso();
			  break;

		   default:
		      alert('Por Favor Elija un Tipo de Reporte')
		}
	});

	$("#btn_listar_reportes").click(function(){
		listarPersona();
	});
});

function ReporteCurso(){
	$.ajax({
		url: '../../fpdf/reportes/cursoP.php',
		type: 'post',
		data: {
			cedula: $("#cedula_reporte").val()	
		},
		dataType: 'json',
		success: function (data) {
			if(data){
				$("#form_reportes")[0].reset();
				alert('GENERANDO PDF');
			}
			else{
				alert('Error al Generar PDF');
			}

		}
	});
}