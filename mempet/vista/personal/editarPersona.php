
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar Persona</title>
<script type="text/javascript" src="../../ajax/ajax.js"></script>
  <link href="extras/modelo/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="../../css/formulario.css">
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/supersized.css">
</head>
<body>


	<form action="../../control/ControladorPersona.php" method="post" class="page-container">
		<input type="hidden" value="2" name="accion">
		<input type="hidden" value="<?php echo $id ?>" name="id">
    	<h1 align="center">EDITANDO PERSONAL</h1></br>

                <input name="nombrec" type="text" id="nombrec" value="<?php echo $persona[0]->nombrec ?>" placeholder="Nombre Completo" size="20" maxlength="50" class="fname" required="required"/></br>

                <input name="cedula" type="text" id="cedula" value="<?php echo $persona[0]->cedula ?>" placeholder="Cedula" size="15" maxlength="9" required="required" class="cedula"/></br>

                  <div class="radio"><IMG SRC="../../img/genero.png">
                    <input type="radio" name="sexo" value="Masculino" <?php if($persona[0]->sexo == 'Masculino') echo 'selected="selected"' ?>><label for="masculino">masculino</label>
                    <input type="radio" name="sexo" value="Femenino" <?php if($persona[0]->sexo == 'Femenino') echo 'selected="selected"' ?>><label for="femenino">femenino</label>
				  </div><br>

                <h3>F. Nacimiento</h3></br>
                <input name="nacimiento" type="date" value="<?php echo $persona[0]->nacimiento ?>" size="11" maxlength="11" required="required" class="fname"/></br>

                <input name="edad" type="text" value="<?php echo $persona[0]->edad ?>" size="11" placeholder="Edad" maxlength="11" required="required" class="fname"/></br>

				<select name="est_cvl" value="" required="required">
					<option value="">ESTADO CIVIL</option>
					<option value="soltero" <?php if($persona[0]->est_cvl == 'soltero') echo 'selected="selected"' ?> >Soltero</option>
					<option value="casado" <?php if($persona[0]->est_cvl == 'casado') echo 'selected="selected"' ?> >Casado</option>
					<option value="viudo" <?php if($persona[0]->est_cvl == 'viudo') echo 'selected="selected"' ?> >Viudo</option>
				</select></br>

                <input type="text" name="direccion" id="direccion" value="<?php echo $persona[0]->direccion ?>" placeholder="Direccion" size="40" maxlength="40" class="address" required="required" /></label></br>

                    <select name="nacionalidad" id="nacionalidad" required="required">
				  		<option value="">NACIONALIDAD</option>
                      	<option value="venezolano" <?php if($persona[0]->nacionalidad == 'venezolano') echo 'selected="selected"' ?>>Venezolano</option>
					  	<option value="extranjero" <?php if($persona[0]->nacionalidad == 'extranjero') echo 'selected="selected"' ?>>Extranjero</option>
					</select><br>

	                <select name="grupo_sanguineo" id="tipo" required="required">
							<option value="O-" <?php if($persona[0]->grupo_sanguineo == 'O-') echo 'selected="selected"' ?>>O-</option>
							  <option value="O+" <?php if($persona[0]->grupo_sanguineo == 'O+') echo 'selected="selected"' ?>>O+</option>
							  <option value="A-" <?php if($persona[0]->grupo_sanguineo == 'A-') echo 'selected="selected"' ?>>A-</option>
							  <option value="A+" <?php if($persona[0]->grupo_sanguineo == 'A+') echo 'selected="selected"' ?>>A+</option>
							  <option value="B-" <?php if($persona[0]->grupo_sanguineo == 'B-') echo 'selected="selected"' ?>>B-</option>
							  <option value="B+" <?php if($persona[0]->grupo_sanguineo == 'B+') echo 'selected="selected"' ?>>B+</option>
							  <option value="AB-" <?php if($persona[0]->grupo_sanguineo == 'AB-') echo 'selected="selected"' ?>>AB-</option>
							  <option value="AB+" <?php if($persona[0]->grupo_sanguineo == 'AB+') echo 'selected="selected"' ?>>AB+</option>
					        </select></br><br>

                  <input name="usuario" type="hidden" value="" />
                <tfoot>
                        	<input type="submit" id="submit" value="submit" />
  			                  <a href='listarPersona.php' target="_blank"><input type="button" id="submit" value="Listar"/></a><br />
                 
                </tfoot>
            </div>

  	</form>

</body>
</html>
