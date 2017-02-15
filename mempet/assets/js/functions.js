$(document).ready(function() {

	$.ajax({
			url: '../../conexion/process.php',
			type: 'post',
			data: { tag: 'getData'},
			dataType: 'json',
			success: function (data) {
				if (data.success) {
					$.each(data, function (index, record) {
						if ($.isNumeric(index)) { 
							var row = $("<tr />");
							$("<td />").text(record.cedula).appendTo(row);
							$("<td />").text(record.nombre_t).appendTo(row);
							$("<td />").text(record.ficha).appendTo(row);
							$("<td />").text(record.departamento).appendTo(row);
							$("<td />").text(record.tlf_p).appendTo(row);
							$("<td />").text(record.cargo).appendTo(row);
							$("<td />").text(record.nomina).appendTo(row);
							$("<td />").text(record.email).appendTo(row);
							$("<td />").text(record.carrera).appendTo(row);
							$("<td />").text(record.grado).appendTo(row);
							$("<td />").text(record.ingreso).appendTo(row);
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