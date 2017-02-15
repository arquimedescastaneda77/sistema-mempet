<?php

	include_once '../control/Constants.php';
	include_once ROOT . 'modelo/Capacitacion.php';
	
	$cedula = $_POST['cedula'];
	$modalidad = $_POST['modalidad'];
	$titulo = $_POST['titulo'];
	$lugar = $_POST['lugar'];
	$beneficio = $_POST['beneficio'];
	$postulacion = $_POST['postulacion'];
    $duracion = $_POST['duracion'];
	$usuario = $_POST['usuario'];

	$accion = $_POST['accion'];

	$objDataBase = new Curso($cedula, $modalidad, $titulo, $lugar, $beneficio, $postulacion, $duracion);

	if($accion == 1) { //si acción == 1 se procede a guardar el registro
		$resp = $objDataBase->guardar('cedula, modalidad, titulo, lugar, beneficio, postulacion, duracion');
		//header('Location: ' . $_SERVER['HTTP_REFERER'] . '?resp=' . $resp);
	header("Location: ../vista/curso/Informes.php");
	}
	if($accion == 2) { //si acción == 2 se procede a editar los registro
		$objDataBase->setId($id);
		$resp = $objDataBase->editar();
		header("Location: ../vista/informes/editarInformes.php");
	}
?>