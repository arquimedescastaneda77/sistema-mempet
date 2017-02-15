 
<?php

	include_once $_SERVER['DOCUMENT_ROOT'] . "/mempet/control/Constants.php";
	include_once ROOT . '/conexion/conexion.php';

	
	if (isset($_POST['tag'])) {
		try {
		   $conexion = new Conexion();
		   $conn = $conexion->getConexion();

			$sql = "SELECT * FROM tbl_trabajador";
			$result = $conn->prepare($sql) or die ($sql);

			if (!$result->execute()) return false;

			if ($result->rowCount() > 0) {
				$json = array();
				while ($row = $result->fetch()) {
					$json[] = array(
						'cedula' => $row['cedula'],
						'nombre_t' => $row['nombret'],
	                    'ficha' => $row['ficha'],
	                    'departamento' => $row['departamento'],
	                    'tlf_p' => $row['tlf_p'],
	                    'cargo' => $row['cargo'],
	                    'nomina' => $row['nomina'],
	                    'email' => $row['email'],
	                    'carrera' => $row['especialidad'],
	                    'grado' => $row['grado'],
	                    'ingreso' => $row['ingreso']
					);
				}

				$json['success'] = true;
				echo json_encode($json);
			}
		} catch (PDOException $e) {
			echo 'Error: '. $e->getMessage();
		}
	}

?>