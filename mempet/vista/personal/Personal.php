<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Registrar Personal </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="../../assets/js/ajax.js"></script>
        <link rel="stylesheet" href="../../assets/css/main.css">
       <link rel="stylesheet" href="../../unsemantic-master/assets/css/unsemantic-grid-responsive-no-ie7.css">
       <link rel="stylesheet" href="../../assets/jquery-ui-1.12.1.custom/jquery-ui.css">

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
    <header>
        <!--header-->
        <div class="grid-100 decoration"></div>
        <div class="grid-100 grid-container principal">

            <div class="grid-20 grid-parent">

                <img src="../../assets/img/imagen1.png" alt="logo">

            </div>

            <ul class="grid-80 navigation grid-parent">
                <li class="grid-20 grid-parent">

                </li>

                <li class="grid-20 grid-parent">
                  Divisiones |
                    <ul>
                        <li>Recursos Humanos</li>
                        <li>Planificacion y control</li>
                        <li>Informatica</li>
                        <li>Mercado Internos</li>
                    </ul>
                </li>

                <li class="grid-20 grid-parent">
                    Extensiones |
                    <ul>
                        <li><a href="http://wikimapia.org/29855122/es/COMPLEJO-MACARAPANA-PDVSA">PDVSA-Carupano</a></li>
                        <li><a href="http://www.pdvsa.com/">PDVSA-Caracas</a></li>
                        <li><a href="http://www.pdvsa.com/">PDVSA-Güiria</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="grid-100 decoration2">
            <div class="grid-100 grid-container grid-parent">

                <div class="grid-25  grid-parent">
                    <a href="../../principal.php">Inicio</a>
                </div>

                <div class="grid-25  grid-parent">
                   <a href="Personal.php">Personal</a>
                </div>

                <div class="grid-25  grid-parent">
                    <a href="../informes/Informes.php">Informes</a>
                </div>

                 <div class="grid-25  grid-parent">
                    <a href="../Referidos/Referidos.php">Referidos</a>
                </div>

            </div>
        </div>
    </header>


        <input id="tab1" type="radio" name="barra" value="1">
        <input id="tab2" type="radio" name="barra" value="2">
        <input id="tab3" type="radio" name="barra" value="3">
        <input id="tab4" type="radio" name="barra" value="4">

        <div class=" grid-container grid-100 grid-parent mobile-grid-100 tabs-wrapper">

            <ul class="grid-10 tabs grid-unparent">
                <li>
                    <label for="tab1" class="barra1">Persona </label>
                </li>

                <li>
                    <label for="tab3" class="barra3">Trabajador </label>
                </li>

                <li>
                    <label for="tab2" class="barra2">Usuarios </label>
                </li>

                <li>
                    <label for="tab4" class="barra4">Familiares</label>
                </li>
            </ul>


        <div class="grid-90 grid-parent  grid-container mobile-grid-100 tab-body-wrapper">

          <form id="form_registrarPersona">
            <input type="hidden" value="1" name="accion">
            <div id="tab-body-1" class="tab-body">

                <div class=" push-20 grid-60 grid-conteiner grid-parent  grid-container mobile-grid-100  form1">

                    <h2 class="title">Nuevo Personal</h2>

                    <div class="grid-50 grid-parent  grid-container mobile-grid-100">

                        <label>Cedula</label>
                        <div class="buscador">
                            <input type="text" name="cedula" id="cedula" maxlength="8">
                            <input type="hidden" name="id_persona" id="id_persona" maxlength="8">
                            <a id="searchcid" name="searchcid" class="busqueda" value="0"><i class="icon-search"></i></a>
                        </div>
                        <label>Nombre Completo</label>
                        <input class="form2" type="text" name="nombrec" id="nombrec" required>


                        <label>Genero</label>
                        <select name="sexo" id="sexo" required>
                            <option value="">Seleccione</option>
                            <option value="F">Femenino</option>
                            <option value="M">Masculino</option>
                        </select>

                        <label>Fecha - Nacimiento</label>
                        <input name="nacimiento" id="nacimiento" type="text" required class="form2">

                        <label>Edo. Civil</label>
                        <select name="est_cvl" required id="est_cvl">
                            <option value="">Seleccione</option>
                            <option value="soltero">Soltero</option>
                            <option value="casado">Casado</option>
                            <option value="viudo">Viudo</option>
                        </select>

                    </div>


                    <div class="grid-50 grid-parent  grid-container mobile-grid-100">


                        <label>Edad</label>
                        <input class="form2"type="text" name="edad" id="edad" maxlength="2" required>

                        <label>Direccion</label>
                        <input class="form2" type="text" name="direccion" id="direccion" required>

                        <label>Nacionalidad</label>
                        <select name="nacionalidad" id="nacionalidad" required>
                            <option value="">Seleccione</option>
                            <option value="V">Venezolano</option>
                            <option value="E">Extranjero</option>
                        </select>

                        <label>Grupo Sanguineo</label>
                        <select name="grupo_sanguineo" id="grupo_sanguineo" required>
                              <option value="">Seleccione</option>
                              <option value="O-">O-</option>
                              <option value="O+">O+</option>
                              <option value="A-">A-</option>
                              <option value="A+">A+</option>
                              <option value="B-">B-</option>
                              <option value="B+">B+</option>
                              <option value="AB-">AB-</option>
                              <option value="AB+">AB+</option>
                        </select>

                        <!--Usuario campo de guardado automatico-->
                        <input name="usuario" id="usuario" type="hidden" value="" />

                    </div>

                    <div class="grid-100 grid-parent">

                        <input type="button" class="submit" value="Guardar" id="submit_data_persona" />
                        <input type="button" class="submit" id="editar_data_persona" value="Editar" disabled="yes" />
                        <a class="btn_listar" href="listarPersonal.php">Listar</a>

                    </div>
                </div>
            </div>
        </form>

                 <!--FORMULARIO USUARIO-->
            <form id="usuarios_form">
                <input type="hidden" value="1" name="accion">
                <input type="hidden" value="" name="id">
                <div align="center" id="tab-body-2" class="tab-body">
                    <div class=" push-20 grid-60 grid-conteiner grid-parent  grid-container mobile-grid-100  form1">

                        <h2 class="title">Registrar Usuarios</h2>
                        <div class="grid-50 grid-parent  grid-container mobile-grid-100">

                           <label>Cedula</label>
                            <div class="buscador">
                                <input type="text" name="cedula2" id="cedula2" maxlength="8">
                                <a  id="searchcid2" class="busqueda"><i class="icon-search"></i></a>
                            </div>

                           <label>Nombre - Usuario</label>
                            <input class="form2" type="text" id="usuario2" maxlength="10" name="usuario2" required>
                           
                           <label>E-mail Personal</label>
                            <input class="form2" type="email" name="email2" id="email2" required> 

                                                     

                    	</div>

                        <div class="grid-50 grid-parent  grid-container mobile-grid-100">                        	

                            <label>password</label>
                            <input class="form2" type="password" name="password2" id="password2" required>
                            
                            <label>Repetir - password</label>
                           <input class="form2" id="password" type="password" name="password" required>                                                        
                                
                             <label>Tipo - Usuario</label>
                            <select id="tipousuario2" name="tipousuario2" required="required">
                                  <option value="">Seleccione</option>
                                  <option value="admin">Administrador</option>
                                  <option value="user">Usuario</option>
                            </select>
                        </div>

                        <div class="grid-100 grid-parent">

                             <input type="button" class="submit" id="submit_data_usuario" value="Guardar" />
                             <input type="button" class="submit" id="editar_data_usuario" value="Editar" disabled="yes" />
                            <a class="btn_listar" href="listarUsuarios.php">Listar</a>

                        </div>
                    </div>
                </div>
            </form>

             <!--TABLA TRABAJADOR-->
             <form id="trabajador_form">
             <input type="hidden" value="1" name="accion">
             <input type="hidden" value="" name="id">
             <div align="center" id="tab-body-3" class="tab-body">

                <div class=" push-20 grid-60 grid-conteiner grid-parent  grid-container mobile-grid-100  form1">

                    <h2 class="title">Agregar Trabajador</h2>

                    <div class="grid-50 grid-parent  grid-container mobile-grid-100">

                        <label>Cedula</label>
                        <div class="buscador">
                            <input type="text" id="cedula3" name="cedula3" maxlength="8" required>
                            <a id="searchcid3" name="searchcid3" class="busqueda" value="0"><i class="icon-search"></i></a>
                        </div>

                        <label>Nomina</label>
                        <input class="form2" type="text" name="nomina3" id="nomina3" maxlength="10" required>


                        <label>Cargo</label>
                        <select name="cargo3" id="cargo3" required>
                            <option value="">Seleccione</option>
                            <option value="RRHH">RRHH</option>
                            <option value="Director general">Director general</option>
                            <option value="Director de administracion">Director de administraci&oacute;n</option>
                        </select>

                        <label>Estudios</label>
                        <select name="grado" id="grado3" required onchange="getGrado(this)">
                            <option value="">Seleccione</option>
                            <option value="Bachiller">Bachiller</option>
                            <option value="Tecnico Medio">T&eacute;cnico Medio</option>
                            <option value="Tecnico Superior">T&eacute;cnico Superior</option>
                            <option value="Licenciado">Licenciado</option>
                            <option value="Ingeniero">Ingeniero</option>
                            <option value="Magister">Magister</option>
                            <option value="Doctorado">Doctorado</option>
                        </select>

                        <label>Estado</label>
                        <select name="status" id="status3" required>
                            <option value="">Seleccione</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                            <option value="Jubilado">Jubilado</option>
                        </select>

                         <label>Fecha de Ingreso</label>
                        <input class="form2" type="date" readonly id="ingreso3" min="01/01/1975" name="ingreso" required>
                    </div>


                    <div class="grid-50 grid-parent  grid-container mobile-grid-100">

                    	<label>Nombre - trabajador</label>
                        <input class="form2" type="text" id="nombret3" name="nombret3" required>

                        <label>Ficha</label>
                        <input class="form2" type="text" id="ficha3" name="ficha" maxlength="10" required>

                        <label>Departamento</label>
                        <input class="form2" type="text" id="departamento3" name="departamento" required>

                        
                        <label>T&eacute;lefono Personal</label>                        
                        <div class="phone"><select name="tlf3_pre" id="tlf3_pre" required class="phone">
                            <option value="0414">0414</option>
                            <option value="0424">0424</option>
                            <option value="0416">0416</option>
                            <option value="0426">0426</option>
                            <option value="0412">0412</option>
                        </select>

                        <input class="phone" type="text" id="tlf3" name="tlf_p" required maxlength="7"></div>

                        <label>E-mail institucional</label>
                        <input class="form2" type="email" id="email3" name="email_i" required>

                        <label>Carrera</label>
                        <select id="carrera3" name="carrera3">
                            <option value="">Seleccione</option>
                            <option value="Administracion">Administraci&oacute;n</option>
                            <option value="Contabilidad">Contabilidad</option>
                            <option value="Informatica">Informatica</option>
                            <option value="Sistemas">Sistemas</option>
                            <option value="Ingenieroia Industrial">Ingenieroia Industrial</option>
                            <option value="Contador Auditor">Contador Auditor</option>
                        </select>

                    </div>

                    <div class="grid-100 grid-parent">

                        <input type="button" class="submit" id="submit_data_trabajador" value="Enviar" />
                        <input type="button" class="submit" id="editar_data_trabajador" value="Editar" disabled/>
                        <a class="btn_listar" href="listarTrabajador.php">Listar</a>

                    </div>
                </div>
            </div>
       </form>

            <form id="familiar_form">
             <input type="hidden" value="1" name="accion">
             <input type="hidden" value="" name="id">
             <div id="tab-body-4" class="tab-body">
                <div class=" push-20 grid-60 grid-conteiner grid-parent  grid-container mobile-grid-100  form1">

                    <h2 class="title">Carga Familiar</h2>

                    <div class="grid-50 grid-parent  grid-container mobile-grid-100">

                        <label>Cedula - Trabajador</label>
                        <div class="buscador">
                            <input type="text" id="cedula4" name="ced_trabajador" required>
                            <a  id="searchcid4" class="busqueda"><i class="icon-search"></i></a>
                        </div>

                        <label>Parentesco</label>
                        <select id="parentesco4" name="parentesco" required>
                            <option value="">Seleccione</option>
                            <option value="Hermano">Hermano/Hermana</option>
                            <option value="Padre">Padre/Madre</option>
                            <option value="Hijo">Hijo</option>
                            <option value="Esposa">Esposa</option>
                            <option value="Esposo">Esposo</option>

                        </select>

                        <label>Condicion - Familiar</label>
                        <input class="form2"type="text" id="condicion4" name="condicion" required>

                        <label>Fecha de Nacimiento</label>
                        <input class="form2" id="fecha_nac4" type="date" name="nacimiento_f" readonly required>

                    </div>


                    <div class="grid-50 grid-parent  grid-container mobile-grid-100">
                        <label>Cedula - Familiar</label>
                        <div class="buscador">
                            <input type="text" id="cedula_fam" name="cedula_fam" required>
                            <a  id="searchcid6" class="busqueda"><i class="icon-search"></i></a>
                        </div>

                        <label>Familiares</label>
                        <div class="buscador">
                            <select class="browser-default" id="cedula5" name="cedula5" required disabled>
                                <option value="" disabled selected>Elija el familiar</option>
                            </select>                        
                        </div>

                        <label>Nombre - Familiar</label>
                        <input class="form2"type="text" id="nombre_fam4" name="nombref" required>

                        <label>Edad - Familiar</label>
                        <input class="form2" id="edad_fam4" type="text" name="edad_f" maxlength="2" required>

                    </div>

                    <div class="grid-100 grid-parent">

                        <input type="button" class="submit" id="submit_data_familia" value="Enviar" />
                        <input type="button" class="submit" id="editar_data_familiar" value="Editar" disabled="yes" />
                        <a class="btn_listar" href="listarFamiliares.php">Listar</a>

                    </div>
                  </div>
                </div>
            </form>
        </div>
    </div>


</body>
<script src="../../assets/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
<script src="../../assets/jquery-ui-1.12.1.custom/jquery-ui.js"></script>

<script src="../../assets/js/personal.js"></script>
<script src="../../assets/js/usuarios.js"></script>
<script src="../../assets/js/trabajadores.js"></script>
<script src="../../assets/js/familiares.js"></script> 


</html>