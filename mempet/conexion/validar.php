<?php
	session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
<head>
	<title>Validando...</title>
	<meta charset="utf-8">
</head>
</head>
<body>
		<?php
			include 'conexion.php';
			if(isset($_POST['login'])){

				$conexion = new Conexion();

				$usuario = $_POST['usuario'];
				$password = $_POST['password'];

				$query = $conexion->getConexion()->prepare("SELECT * FROM sesiones WHERE usuario='$usuario' AND password='$password' limit 1");
                $query->execute();
        		$log = $query->fetchAll(PDO::FETCH_OBJ);
                $conexion->cerrarConexion();

				if (count($log) > 0) {
					
					$row = $log[0];
					
					$_SESSION["usuario"] = $row->usuario;
				  	echo 'Iniciando sesión para '.$_SESSION['usuario'].' <p>';
					echo '<script> window.location="../principal.php"; </script>';
				}
				else{
					echo '<script> alert("Usuario o password incorrectos.");</script>';
					echo '<script> window.location="../index.php"; </script>';
				}
               
				
			}
		?>	
</body>
</html>