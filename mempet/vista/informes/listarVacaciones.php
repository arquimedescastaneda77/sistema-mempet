<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Registro y Permisologia</title>
	
	<link rel="stylesheet" type="text/css" href="../../jquery/fancyapps-fancyBox-3a66a9b/source/jquery.fancybox.css?v=2.0.6" media="screen" />
	<link href="extras/modelo/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="extras/modelo/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="../../css/formulario.css">
	<link rel="stylesheet" href="../../css/tabla.css">
	

		<?php
			include_once "../../modelo/Permisos.php";
			$permiso = Permiso::listar(); //esta función la puedo llamar así porque es una funcion estatica, finaje en el modelo permiso dice, public STATIC function ...
			$cantidadRegistros = count($permiso);
		?>

	</head>
	<body>
    <form action="controladorPermisos.php" method="post" class="Estilo1">
    	<h1 align="center" style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;" class="Estilo2">Busqueda de Registros</h1>
      	</br>
      	<div>
        <input type="text" name="boxBuscar" autofocus="autofocus" value="" placeholder="Ingrese un datos."/>
        <input type="submit" name="botonBuscar" value="Buscar" id="botonBuscar" />
        <input type="submit" name="botonListar" value="Listar Todos" id="botonListar" />
        </div></br>

		<table>
			<thead>
				<th>ID </th>
				<th>CEDULA</th>
				<th>TIPO DE PERMISO</th>
				<th>MOTIVO</th>
				<th>FECHA DE INICIO</th>
				<th>FECHA DE CULMINACIÓN</th>
				<th>USUARIO</th>
			</thead> 
			<tbody>
				<?php
					for($i=0; $i<$cantidadRegistros; $i++) {
						echo '<tr><td>' . $permiso[$i]->id_permiso . '</td>';
						echo '<td>' . $permiso[$i]->cedula . '</td>';
						echo '<td>' . $permiso[$i]->tipo . '</td>';
						echo '<td>' . $permiso[$i]->motivo . '</td>';
						echo '<td>' . $permiso[$i]->fecha_ini . '</td>';
						echo '<td>' . $permiso[$i]->fecha_cul . '</td>';
						echo '<td>' . $permiso[$i]->usuario . '</td></tr>';
					}
				?>
			</tbody>
		</table>
    </form>
</body>
</html>