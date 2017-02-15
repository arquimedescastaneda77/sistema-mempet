<?php 
	require ("../modelo/modelo.php");
	$objModelo = new Formulario();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar</title>
<script type="text/javascript" src="../ajax/ajax.js"></script>
<script type="text/javascript">
	var nombres = "", apellidos="",cedula="", sexo="", est_cvl="", direccion="", edad="", imagen="", pais="", pk="", email="";	
	
	function modificarInformacion(){
		modelo = document.getElementById("nombres_editar").value;
		apellidos = document.getElementById("apellidos_editar").value;
		cedula = document.getElementById("cedula_editar").value;
		sexo = document.getElementById("sexo_editar").value;
		est_cvl = document.getElementById("est_cvl_editar").value;
		direccion = document.getElementById("direccion_editar").value;
    edad = document.getElementById("edad_editar").value;
    nacionalidad = document.getElementById("nacionalidad").value;
    grupo_sanguineo = document.getElementById("grupo_sanguineo").value;
    usuario = document.getElementById("usuario").value;
		id_persona = document.getElementById("id_persona_editar").value;
		if(nombres!="" && apellidos!="" && cedula!="" && sexo!="" && est_cvl!="" && direccion!="" && edad!="" && nacionalidad!="" && grupo_sanguineo!="" && usuario!=""){
			ajax_("../control/controlador.php?nombres_editar="+nombres+"&apellidos_editar="+apellidos+"&cedula_editar="+cedula+"&sexo_editar="+sexo+"&est_cvl_editar="+est_cvl+"&direccion_editar="+direccion+"&edad_editar="+edad+"&nacionalidad_editar="+nacionalidad+"&grupo_sanguineo_editar="+grupo_sanguineo+"&usuario_editar="+usuario+"&id_persona_editar="+id_persona);
		}else{
			alert("Ingrese toda la informacion.");
		}		
	}
</script>
</head>

<body>
<form>
  <?php	
		if(isset($_GET["nombres"]) && isset($_GET["apellidos"]) && isset($_GET["cedula"]) && isset($_GET["sexo"]) && isset($_GET["est_cvl"]) && isset($_GET["direccion"]) && isset($_GET["edad"]) && isset($_GET["nacionalidad"])&& isset($_GET["grupo_sanguineo"])&& isset($_GET["usuario"])){
			$id_persona=$_GET["id_persona"];
			$nombres=$_GET["nombres"];
			$apellidos=$_GET["apellidos"];
			$cedula=$_GET["cedula"];
			$sexo=$_GET["sexo"];
			$est_cvl=$_GET["est_cvl"];
			$direccion=$_GET["direccion"];
      $edad=$_GET["edad"];
      $nacionalidad=$_GET["nacionalidad"];
      $grupo_sanguineo=$_GET["grupo_sanguineo"];
      $usuario=$_GET["usuario"];

			}
	?>
  <br />
  <br />
  <table width="200" border="0" align="center">
    <input type="hidden" name="id_editar" id="id_editar" value="<?php echo $id; ?>" />
    <tr>
      <td>nombres</td>
      <td><input type="text" name="nombres_editar" id="nombres_editar" value="<?php echo $nombres; ?>" /></td>
    </tr>
    <tr>
      <td>Apellidos</td>
      <td><input type="text" name="apellidos_editar" id="apellidos_editar" value="<?php echo $apellidos; ?>" /></td>
    </tr>
    <tr>
      <td>cedula</td>
      <td><input type="text" name="cedula_editar" id="cedula_editar"  value="<?php echo $cedula; ?>" /></td>
    </tr>
    <tr>
      <td>sexo</td>
      <td><input type="text" name="sexo_editar" id="sexo_editar" value="<?php echo $sexo; ?>" /></td>
    </tr>
    <tr>
      <td>Estado Civil</td>
      <td><input type="text" name="est_cvl_editar" id="est_cvl_editar" value="<?php echo $est_cvl; ?>" /></td>
    </tr>
    <tr>
      <td>direccion</td>
      <td><input type="text" name="direccion_editar" id="direccion_editar" value="<?php echo $direccion; ?>" /></td>
    </tr>
    <tr>
      <td>edad</td>
      <td><input type="text" name="edad_editar" id="edad_editar" value="<?php echo $edad; ?>" /></td>
    </tr>
    <tr>
      <td>nacionalidad</td>
      <td><input type="text" name="nacionalidad_editar" id="nacionalidad_editar" value="<?php echo $nacionalidad; ?>" /></td>
    </tr>
    <tr>
      <td>grupo sanguineo</td>
      <td><input type="text" name="grupo_sanguineo_editar" id="grupo_sanguineo_editar" value="<?php echo $grupo_sanguineo; ?>" /></td>
    </tr>
    <tr>
      <td>usuario</td>
      <td><input type="text" name="usuario_editar" id="usuario_editar" value="<?php echo $usuario; ?>" /></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><input type="button" value="Modificar" onclick="modificarInformacion();" /></td>
    </tr>
  </table>
  <div id="resultado" align="center"></div>
</form>
<br />
<br />
<br />
</body>
</html>