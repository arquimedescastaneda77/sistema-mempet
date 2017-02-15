<?php

	include_once 'Constants.php';
	include_once ROOT . 'modelo/Familia.php';

	foreach($_POST as $nombre_campo => $valor)
		{
		   $asignacion = "\$" . $nombre_campo . "='".addslashes($valor)."';";
		   eval($asignacion);
		}

	switch($accion)
	{
		case '1':
		 $objDataBase = new Familia ($cedula, $parentesco, $edad_f, $condicion, $nacimiento_f, $nombref, $ced_trabajador);

		/* echo $usuario2. " es el usuario";
		 echo $password2. " es el pass";
		 echo $email2. " es el mail";
		 echo $tipousuario2. " es el tipo";
		 echo $cedula2;*/

			if(intval($id_sesion)>0){
				$datos= $objDataBase->searchersId($id_sesion);
				if(count($datos)>0){
					$objDataBase->setId($id_sesion);
					$datos = $objDataBase->editar();
				}

			}
			else{
				$datos = $objDataBase->guardar('cedula, parentesco, edad_c, condicion, nacimiento_familiar, nombref, ced_trabajador');
			}
			//$datos= $objDataBase->listar();

		break;

		case '2':
			$objDataBase = new Familia($cedula, $parentesco, $edad_f, $condicion, $nacimiento_f, $nombref, $ced_trabajador);
			//$objDataBase->setId($id);
			$datos = $objDataBase->editar();
			//header("Location: ../vista/Usuariol/listarUsuarios.php");
		break;

		case '3':
			$objDataBase = new Familia($cedula, $parentesco=null, $edad_f=null, $condicion=null, $nacimiento_f=null, $nombref=null, $ced_trabajador=null, $usuario=null, $id=null);
			$datos= $objDataBase->searchersCid1($cedula);
		break;

		case '4':
			$objDataBase = new Familia();
			$datos= $objDataBase->listar();
		break;

		case '5':
			$objDataBase = new Familia($cedula, $parentesco=null, $edad_f=null, $condicion=null, $nacimiento_f=null, $nombref=null, $ced_trabajador=null, $usuario=null, $id=null);
			$datos= $objDataBase->searchersCid2($cedula);
		break;

		case '6':
			$objDataBase = new Familia($cedula, $parentesco=null, $edad_f=null, $condicion=null, $nacimiento_f=null, $nombref=null, $ced_trabajador=null, $usuario=null, $id=null);
			$datos= $objDataBase->listafam($cedula);
		break;

		case '7':
			$objDataBase = new Familia($cedula_t, $parentesco=null, $edad_f=null, $condicion=null, $nacimiento_f=null, $nombref=null, $ced_trabajador=null, $usuario=null, $id=null);
			$datos= $objDataBase->searchersCid3($cedula_t, $cedula_f);
		break;

		default:
	    $datos = "Error accion no encontrada";
	}

    $salida = json_encode($datos);
    echo $salida;

?>
		