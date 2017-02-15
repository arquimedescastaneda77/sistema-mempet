<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="../../assets/js/ajax.js"></script>
        <link rel="stylesheet" href="../../assets/css/main.css">
       <link rel="stylesheet" href="../../unsemantic-master/assets/css/unsemantic-grid-responsive-no-ie7.css">

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
                    Extenciones |
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
                   <a href="../personal/Personal.php">Personal</a>
                </div>

                <div class="grid-25  grid-parent">
                    <a href="Informes.php">Informes</a>
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
       

        <div class=" grid-container grid-100 grid-parent mobile-grid-100 tabs-wrapper">

            <ul class="grid-10 tabs grid-unparent">
                <li>
                    <label for="tab1" class="barra1">Capacitacion</label>
                </li>

                <li>
                    <label for="tab2" class="barra2">Reportes</label>
                </li>

                <li>
                    <label for="tab3" class="barra3">Vacaciones</label>
                </li>
            </ul>
        
            <!--TABLA CAPACITACION-->
        <div class="grid-90 grid-parent  grid-container mobile-grid-100 tab-body-wrapper">
                
          <form action="../../control/ControladorCapacitacion.php" method="post">
            <input type="hidden" value="1" name="accion">
            <div id="tab-body-1" class="tab-body">

                <div class=" push-20 grid-60 grid-conteiner grid-parent  grid-container mobile-grid-100  form1">
            
                    <h2 class="title">Registro - Capacitaciones</h2>

                    <div class="grid-50 grid-parent  grid-container mobile-grid-100">

                        <label>Cedula</label>
                        <div class="buscador">
                            <input type="text" name="buscar">
                            <a  href="#" class="busqueda"><i class="icon-search"></i></a>
                        </div>

                        <label>Modalidad</label>
                        <input class="form2" type="text" name="modalidad">

                        <label>Fecha Inicial</label>
                        <input name="curso_ini" type="date" required="required" class="form2">

                        <label>Postulacion</label>
                        <select>
                            <option value="">Seleccione</option>
                            <option value="personal">Personal</option>
                            <option value="institucional">Institucional</option>
                        </select>

                        <label>Duracion</label>
                        <input class="form2" type="text" name="duracion">
                    </div>
                

                    <div class="grid-50 grid-parent  grid-container mobile-grid-100">

                        <label>Titulo</label>
                        <input class="form2" type="text" name="titulo" required="required">

                        <label>Lugar</label>
                        <input class="form2"type="text" name="lugar" required="required">

                        <label>Fecha Final</label>
                        <input class="form2" type="date" name="curso_fin" required="required">

                        <div class="checkbox">  
                            <br><h2 align="center">Beneficios</h2><br>
                            <input type="checkbox" name="checkbox" id="checkbox1">
                            <label for="checkbox1">Viaticos</label>

                            <input type="checkbox" name="checkbox" id="checkbox2">
                            <label for="checkbox2">Transporte</label>

                            <input type="checkbox" name="checkbox" id="checkbox3">
                            <label for="checkbox3">Hospedaje</label>
                        </div>

                        <!--Usuario campo de guardado automatico-->
                        <input name="usuario" type="hidden" value="" />

                    </div>

                    <div class="grid-100 grid-parent">

                        <input type="submit" class="submit" value="Enviar" />
                        <a class="btn_listar" href="listarPersona.php">Listar</a>

                    </div>
                </div>
            </div>
        </form>

        <!--TABLA REPORTES-->
        
        <form id="form_reportes" action="../../fpdf/reportes/ReporteGeneral.php" target="_blank" method="POST">
            <div align="center" id="tab-body-2" class="tab-body">
                <div class=" push-20 grid-60 grid-conteiner grid-parent  grid-container mobile-grid-100  form1">
                    <h2 class="title">Reportes - Generales</h2>
                        <div class="grid-50 grid-parent  grid-container mobile-grid-100">

                           <label>Cedula</label>
                            <div class="buscador">
                                <input type="text" name="cedula_reporte" id="cedula_reporte" required>
                                <a  href="#" class="busqueda"><i class="icon-search"></i></a>
                            </div>

                    	</div>

                        <div class="grid-50 grid-parent  grid-container mobile-grid-100">

                           <label>Tipo - Reporte</label>
                           <select id="tipo_reporte" name="tipo_reporte">
                                <option value="" disabled>Seleccione</option>        
                                <option value="1">Capacitaciones</option>
                                <option value="2">Trabajador</option>
                            </select>

                        </div>

                        <div class="grid-100 grid-parent">

                            <input type="submit"   name="submit_reportes" class="submit" value="Generar PDF" id="submit_reportes"/>
                            <a class="btn_listar" href="listarPermisos.php">Listar</a>

                        </div>    
                </div>
            </div>
        </form >        
            <div align="center" id="tab-body-3" class="tab-body">
                <div class=" push-20 grid-60 grid-conteiner grid-parent  grid-container mobile-grid-100  form1">
            
                    <h2 class="title">Registro - Vacacional</h2>
                    <div class="grid-50 grid-parent  grid-container mobile-grid-100">

                        <label>Cedula</label>
                        <div class="buscador">
                            <input type="text" name="buscar">
                            <a  href="#" class="busqueda"><i class="icon-search"></i></a>
                        </div>

                    </div>

                    <div class="grid-50 grid-parent  grid-container mobile-grid-100">

                          <label>Nombre Completo</label>
                        <input class="form2" type="text" name="nombrec" id="nombrec">

                        <label>Fecha de Ingreso</label>
                        <input class="form2" type="text" name="fecha_ingreso">

                    </div>

                    <div class="grid-100 grid-parent">

                        <a class="btn_enviar" href="#">Enviar</a>
           
                        <a class="btn_listar" href="listarTrabajador.php">Listar</a>

                    </div>
                </div>
             </div>
        </form>    
       </div>
      </div>      
    </body>

    <script src="../../assets/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
    <script src="../../assets/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
    
    <script src="../../assets/js/reportes.js"></script>

</html>