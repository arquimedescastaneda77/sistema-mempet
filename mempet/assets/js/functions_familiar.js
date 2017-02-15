$(document).ready(function() {

	$.ajax({
			url: '../../conexion/process_familiar.php',
			type: 'post',
			data: { tag: 'getData'},
			dataType: 'json',
			success: function (data) {
				if (data.success) {
					$.each(data, function (index, record) {
						if ($.isNumeric(index)) { 
							var row = $("<tr />");
							$("<td />").text(record.cedula_fam).appendTo(row);
							$("<td />").text(record.cedula_fun).appendTo(row);
							$("<td />").text(record.nombrec).appendTo(row);
							$("<td />").text(record.condicion).appendTo(row);
							$("<td />").text(record.nacimiento).appendTo(row);
							$("<td />").text(record.edad).appendTo(row);
							$("<td />").text(record.parentesco).appendTo(row);
							$("<td />").text(record.usuario).appendTo(row);
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