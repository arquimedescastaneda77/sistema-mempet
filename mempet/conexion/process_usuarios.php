 
<?php

	include_once $_SERVER['DOCUMENT_ROOT'] . "/mempet/control/Constants.php";
	include_once ROOT . '/conexion/conexion.php';

	
	if (isset($_POST['tag'])) {
		try {
		   $conexion = new Conexion();
		   $conn = $conexion->getConexion();

			$sql = "SELECT * FROM sesiones";
			$result = $conn->prepare($sql) or die ($sql);

			if (!$result->execute()) return false;

			if ($result->rowCount() > 0) {
				$json = array();
				while ($row = $result->fetch()) {
					$json[] = array(
						'usuario' => $row['usuario'],
						'email' => $row['email'],
	                    'tipousuario' => $row['tipousuario'],
	                    'nombre_c' => $row['nombre_c'],
	                    'ced_trabajador' => $row['ced_trabajador']
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