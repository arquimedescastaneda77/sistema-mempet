$(document).ready(function() {

	$.ajax({
			url: '../../conexion/process_personal.php',
			type: 'post',
			data: { tag: 'getData'},
			dataType: 'json',
			success: function (data) {
				if (data.success) {
					$.each(data, function (index, record) {
						if ($.isNumeric(index)) { 
							var row = $("<tr />");
							$("<td />").text(record.cedula).appendTo(row);
							$("<td />").text(record.nombrec).appendTo(row);
							$("<td />").text(record.sexo).appendTo(row);
							$("<td />").text(record.nacimiento).appendTo(row);
							$("<td />").text(record.edad).appendTo(row);
							$("<td />").text(record.est_cvl).appendTo(row);
							$("<td />").text(record.direccion).appendTo(row);
							$("<td />").text(record.nacionalidad).appendTo(row);
							$("<td />").text(record.grupo_sanguineo).appendTo(row);							
							row.appendTo("table");
						}
					})
				}

				$('table').dataTable({
					"bJQueryUI": true,
					"sAjaxDataProp": "",
                    "processing": true,                   
                    "pageLength": 50,
                    "bDestroy" : true
				})
			}
	});
})