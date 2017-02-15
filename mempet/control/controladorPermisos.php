<?php

	include_once '../control/Constants.php';
	include_once ROOT . 'modelo/Permisos.php';

	$cedula = $_POST['cedula'];
	$tipo = $_POST['tipo'];
	$motivo = $_POST['motivo'];
	$fecha_ini = $_POST['fecha_ini'];
	$fecha_cul = $_POST['fecha_cul'];
	$usuario = $_POST['usuario'];

	$accion = $_POST['accion'];

	$objDataBase = new Permisos ($cedula, $tipo, $motivo, $fecha_ini, $fecha_cul);

	if($accion == 1) { //si acción == 1 se procede a guardar el registro
		$resp = $objDataBase->guardar('cedula, tipo, motivo, fecha_ini, fecha_cul');
		//header('Location: ' . $_SERVER['HTTP_REFERER'] . '?resp=' . $resp);
	header("Location: ../vista/permisos/registrarPermisos.php");
	}

	/*id_permiso serial NOT NULL,
  cedula integer NOT NULL,
  tipo character varying(30) NOT NULL,
  motivo character varying(30) NOT NULL,
  usuario character varying(30),
  fecha_ini character varying(30) NOT NULL,
  fecha_cul character varying(30) NOT NULL,*/