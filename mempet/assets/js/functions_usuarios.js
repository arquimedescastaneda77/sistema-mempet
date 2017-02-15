$(document).ready(function() {

	$.ajax({
			url: '../../conexion/process_usuarios.php',
			type: 'post',
			data: { tag: 'getData'},
			dataType: 'json',
			success: function (data) {
				if (data.success) {
					$.each(data, function (index, record) {
						if ($.isNumeric(index)) { 
							var row = $("<tr />");
							$("<td />").text(record.ced_trabajador).appendTo(row);
							$("<td />").text(record.usuario).appendTo(row);
							$("<td />").text(record.email).appendTo(row);
							$("<td />").text(record.tipousuario).appendTo(row);
							$("<td />").text(record.nombre_c).appendTo(row);
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