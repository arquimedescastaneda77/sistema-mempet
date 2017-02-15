 
<?php

	include_once $_SERVER['DOCUMENT_ROOT'] . "/mempet/control/Constants.php";
	include_once ROOT . '/conexion/conexion.php';

	
	if (isset($_POST['tag'])) {
		try {
		   $conexion = new Conexion();
		   $conn = $conexion->getConexion();

			$sql = "SELECT * FROM tbl_familiar";
			$result = $conn->prepare($sql) or die ($sql);

			if (!$result->execute()) return false;

			if ($result->rowCount() > 0) {
				$json = array();
				while ($row = $result->fetch()) {
					$json[] = array(
						'cedula_fam' => $row['cedula'],
	                    'cedula_fun' => $row['ced_trabajador'],
						'nombrec' => $row['nombref'],
	                    'condicion' => $row['condicion'],
	                    'nacimiento' => $row['nacimiento_familiar'],
	                    'edad' => $row['edad_c'],
	                    'parentesco' => $row['parentesco'],
	                    'usuario' => $row['usuario'],
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