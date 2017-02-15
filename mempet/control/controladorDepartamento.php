<?php
	
	include_once '../control/Constants.php';
	include_once ROOT . 'modelo/Departamento.php';

	$departamento = $_POST['departamento'];
	$division = $_POST['division'];
	$encargado = $_POST['encargado'];
	$usuario = $_POST['usuario'];

	$accion = $_POST['accion'];

	$objDataBase = new Departamento ($departamento, $division, $encargado);

	if($accion == 1) { //si acción == 1 se procede a guardar el registro
		$resp = $objDataBase->guardar('departamento, division, encargado');
	
	header("Location: ../vista/departamento/registrarDepartamento.php");
	}

