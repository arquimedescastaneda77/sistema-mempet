
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Preparacion y Capacitacions</title>
	
	<link rel="stylesheet" type="text/css" href="../../jquery/fancyapps-fancyBox-3a66a9b/source/jquery.fancybox.css?v=2.0.6" media="screen" />
	<link href="extras/modelo/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="extras/modelo/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="../../assets/css/formulario.css">
	<link rel="stylesheet" href="../../assets/css/tabla.css">
	

		<?php
			include_once "../../modelo/Capacitacion.php";
			$Capacitacion = Capacitacion::listar(); //esta función la puedo llamar así porque es una funcion estatica, finaje en el modelo Capacitacion dice, public STATIC function ...
			$cantidadRegistros = count($Capacitacion);
		?>

	</head>
	<body>
    <form action="controlador.php" method="post" class="Estilo1">
    	<h1 align="center" style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;" class="Estilo2">Busqueda de Registros</h1>
      	</br>
      	<div>
        <input type="text" name="boxBuscar" autofocus="autofocus" value="" placeholder="Ingrese un datos."/>
        <input type="submit" name="botonBuscar" value="Buscar" id="botonBuscar" />
        <input type="submit" name="botonListar" value="Listar Todos" id="botonListar" />
        </div></br>

		<table>
			<thead>
				<th>CEDULA</th>
				<th>MODALIDAD</th>
				<th>TITULO</th>
				<th>LUGAR</th>
				<th>BENEFICIOS</th>
				<th>POSTULACIÓN</th>
				<th>DURACIÓN</th>
				<th>USUARIO</th>
			</thead>
			<tbody>
				<?php
					for($i=0; $i<$cantidadRegistros; $i++) {
						echo '<tr><td>' . $Capacitacion[$i]->id_Capacitacion . '</td>';
						echo '<td>' . $Capacitacion[$i]->cedula . '</td>';
						echo '<td>' . $Capacitacion[$i]->modalidad . '</td>';
						echo '<td>' . $Capacitacion[$i]->titulo . '</td>';
						echo '<td>' . $Capacitacion[$i]->lugar . '</td>';
						echo '<td>' . $Capacitacion[$i]->beneficio . '</td>';
						echo '<td>' . $Capacitacion[$i]->postulacion . '</td>';
						echo '<td>' . $Capacitacion[$i]->duracion . '</td>';
						echo '<td>' . $Capacitacion[$i]->usuario . '</td></tr>';
					}
				?>
			</tbody>
		</table>
    </form>
</body>
</html>
