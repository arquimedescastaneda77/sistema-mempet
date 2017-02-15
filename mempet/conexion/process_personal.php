 
<?php

	include_once $_SERVER['DOCUMENT_ROOT'] . "/mempet/control/Constants.php";
	include_once ROOT . '/conexion/conexion.php';

	
	if (isset($_POST['tag'])) {
		try {
		   $conexion = new Conexion();
		   $conn = $conexion->getConexion();

			$sql = "SELECT * FROM tbl_persona";
			$result = $conn->prepare($sql) or die ($sql);

			if (!$result->execute()) return false;

			if ($result->rowCount() > 0) {
				$json = array();
				while ($row = $result->fetch()) {
					$json[] = array(
						'cedula' => $row['cedula'],
						'nombrec' => $row['nombrec'],
	                    'sexo' => $row['sexo'],
	                    'nacimiento' => $row['nacimiento'],
	                    'edad' => $row['edad'],
	                    'est_cvl' => $row['est_cvl'],
	                    'direccion' => $row['direccion'],
	                    'nacionalidad' => $row['nacionalidad'],
	                    'grupo_sanguineo' => $row['grupo_sanguineo']
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