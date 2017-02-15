<?php

	include_once 'Constants.php';
	include_once ROOT . 'modelo/sesiones.php';

	foreach($_POST as $nombre_campo => $valor)
		{
		   $asignacion = "\$" . $nombre_campo . "='".addslashes($valor)."';";
		   eval($asignacion);
		}

	switch($accion)
	{
		case '1':
		 $objDataBase = new Usuario ($usuario, $password, $email, $tipousuario, $cedula);

			if(intval($id_sesion)>0){
				$datos= $objDataBase->searchersId($id_sesion);
				if(count($datos)>0){
					$objDataBase->setId($id_sesion);
					$datos = $objDataBase->editar();
				}

			}
			else{
				$datos = $objDataBase->guardar('usuario, password,  tipousuario, email, ced_trabajador');
			}
		

		break;

		case '2':
			$objDataBase = new Usuario($usuario, $password, $email, $tipousuario, $cedula);

			$datos = $objDataBase->editar();
		
		break;

		case '3':
			$objDataBase = new Usuario($cedula, $usuario=null, $password=null, $tipousuario=null, $email=null, $id=null);
			$datos= $objDataBase->searchersCid($cedula);
			

		break;

		case '4':
			$objDataBase = new Usuario();
			$datos= $objDataBase->listar();
		break;

		case '5':
			$objDataBase = new Usuario($cedula, $usuario=null, $password=null, $tipousuario=null, $email=null, $id=null);
			$datos= $objDataBase->searchersCid2($cedula);
		break;

		default:

	    $datos = "Error accion no encontrada";
	}

    $salida = json_encode($datos);
    echo $salida;

?>
		