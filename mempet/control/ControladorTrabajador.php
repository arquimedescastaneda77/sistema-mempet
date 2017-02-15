<?php

	include_once 'Constants.php';
	include_once ROOT . 'modelo/Trabajador.php';

	foreach($_POST as $nombre_campo => $valor)
		{
		   $asignacion = "\$" . $nombre_campo . "='".addslashes($valor)."';";
		   eval($asignacion);
		}

	switch($accion)
	{
		case '1':
		 $objDataBase = new Trabajador ($cedula, $nomina, $cargo, $grado, $status, $ingreso, $nombret, $ficha, $tlf, $email, $carrera, $departamento);

			if(intval($id_sesion)>0){
				$datos= $objDataBase->searchersId($id_sesion);
				if(count($datos)>0){
					$objDataBase->setId($id_sesion);
					$datos = $objDataBase->editar();
				}

			}
			else{
				$datos = $objDataBase->guardar('cedula, nomina, cargo, grado, status, ingreso, nombret, ficha, tlf_p, email, especialidad, departamento');
			}
			//$datos= $objDataBase->listar();

		break;

		case '2':
			$objDataBase = new Trabajador($cedula, $nomina, $cargo, $grado, $status, $ingreso, $nombret, $ficha, $tlf, $email, $carrera, $departamento);
			//$objDataBase->setId($id);
			$datos = $objDataBase->editar();
			//header("Location: ../vista/Usuariol/listarUsuarios.php");
		break;

		case '3':
			$objDataBase = new Trabajador($cedula, $nombret=null, $ficha=null, $nomina=null, $departamento=null, $cargo=null, $tlf_p=null, $email=null, $grado=null, $carrera=null, $ingreso=null, $status=null, $usuario=null);
			$datos= $objDataBase->searchersCid($cedula);
		break;

		case '4':
			$objDataBase = new Trabajador();
			$datos= $objDataBase->listar();
		break;

		case '5':
			$objDataBase = new Trabajador($cedula, $nombret=null, $ficha=null, $nomina=null, $departamento=null, $cargo=null, $tlf_p=null, $email=null, $grado=null, $carrera=null, $ingreso=null, $status=null, $usuario=null);
			$datos= $objDataBase->searchersCid2($cedula);
		break;

		default:
	    $datos = "Error accion no encontrada";
	}

    $salida = json_encode($datos);
    echo $salida;

?>
		