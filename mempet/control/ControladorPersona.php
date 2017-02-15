<?php

	include_once '../control/Constants.php';
	include_once ROOT . 'modelo/Persona.php';

	foreach($_POST as $nombre_campo => $valor)
	{
	   $asignacion = "\$" . $nombre_campo . "='".addslashes($valor)."';";
	   eval($asignacion);
	}

	switch($accion)
	{
		case '1':
			$objDataBase = new Persona($nombrec, $cedula, $sexo, $nacimiento, $edad, $est_cvl, $direccion, $nacionalidad, $grupo_sanguineo);
			if(intval($id_persona)>0){
				$datos= $objDataBase->searchersId($id_persona);
				if(count($datos)>0){
					$objDataBase->setId($id_persona);
					$datos = $objDataBase->editar();
				}

			}
			else{
				$datos = $objDataBase->guardar('nombrec, cedula, sexo, nacimiento, edad, est_cvl, direccion, nacionalidad, grupo_sanguineo');
			}
			$datos= $objDataBase->listar();
			

		break;

		case '2':
			$objDataBase = new Persona($nombrec, $cedula, $sexo, $nacimiento, $edad, $est_cvl, $direccion, $nacionalidad, $grupo_sanguineo);
			//$objDataBase->setId($id);
			$datos = $objDataBase->editar();
		
		break;

		case '3':
			$objDataBase = new Persona();
			$datos= $objDataBase->searchersCid($cedula);
		break;

		case '4':
			$objDataBase = new Persona();
			$datos= $objDataBase->listar();
		break;

		default:
	    $datos = "Error accion no encontrada";
	  
	}

    $salida = json_encode($datos);
    echo $salida;

?>