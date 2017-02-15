<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Permisos</title>
<script type="text/javascript" src="../ajax/ajax.js"></script>
<script type="text/javascript" src="../jquery/fancyapps-fancyBox-3a66a9b/lib/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="../jquery/fancyapps-fancyBox-3a66a9b/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="../jquery/fancyapps-fancyBox-3a66a9b/source/jquery.fancybox.js?v=2.0.6"></script>
  <link rel="stylesheet" href="../../css/formulario.css">
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/supersized.css">
</head>
<body>

	<?php
		if(isset($_GET['resp'])) {
			if ($_GET['resp'] == 1)
				echo '<label>Registro almacenado</label>';
			else
				echo '<label>Ha ocurrido un error</label>';
		}
	?>

  <script>
function soloNumeros(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "1234567890";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}

</script>

	<form action="../../control/ControladorPermisos.php" method="post" class="page-container">
		<input type="hidden" value="1" name="accion">
    	<h1 align="center">Registrar de Cursos Realizados</h1></br>
		<body align="center">
            <div>
                <input name="cedula" type="text" id="cedula" value="" placeholder="Cedula" size="15" maxlength="9" onkeypress="return soloNumeros(event)" required="required" class="cedula"/></br>

                 <select name="tipo" value="" required="required">
                      <option value="">Tipo de Permiso</option>
                      <option value="Personal">Personal</option>
                      <option value="Medico">Medico</option>
                 </select></br>

                  <input name="motivo" type="text" id="motivo" value="" placeholder="Ingrese motivo del Permiso" size="15" maxlength="30"  required="required" class="fname"/></br>
           
           <h1>Fecha de Inicio del Permiso</h1>
           
           		<input name="fecha_ini" type="date" id="fecha_ini" value="" size="15" maxlength="11"  required="required" class="fname"/></br>
          
           <h1>Fecha de Culminacion del Permiso</h1>

				  <input name="fecha_cul" type="date" value="" id="fecha_cul" size="11" maxlength="11" required="required" class="fname"/></br>
                

                  <input name="usuario" type="hidden" value="" id="id_permiso" />
                <tfoot>
                        	<input type="submit" id="submit" value="submit" />
  			                  <a href='listarCurso.php' target="_blank"><input type="button" id="submit" value="Listar"/></a><br />               
                </tfoot>
            </div>
    </body>
  </form>
</body>
</html>