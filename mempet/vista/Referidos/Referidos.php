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
                    <a href="../informes/Informes.php">Informes</a>
                </div>
                
                 <div class="grid-25  grid-parent">
                    <a href="Referidos.php">Referidos</a>
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
                    <label for="tab1" class="barra1">Departamentos</label>
                </li>

                <li>
                    <label for="tab2" class="barra2">Cargar CSV</label>
                </li>
            </ul>
        

        <div class="grid-90 grid-parent  grid-container mobile-grid-100 tab-body-wrapper">
                
          <form action="../../control/ControladorCapacitacion.php" method="post">
            <input type="hidden" value="1" name="accion">
            <div id="tab-body-1" class="tab-body">

                <div class=" push-20 grid-60 grid-conteiner grid-parent  grid-container mobile-grid-100  form1">
            
                    <h2 class="title">Registrar Departamento</h2>

                    <div class="grid-50 grid-parent  grid-container mobile-grid-100">

                        <label>Nombre Departamento</label>
                        <input class="form2" type="text" name="departamento" required>

                        <label>Encargado</label>
                        <input class="form2" name="encargado" type="text" required>

                        <label>Extension</label>
                        <input class="form2" type="text" name="extension" required>
                    </div>
                

                    <div class="grid-50 grid-parent  grid-container mobile-grid-100">

                        <label>Jefatura de Zona</label>
                        <input class="form2" type="text" name="zona" required>

                        <label>Agrupar</label>
                        <input class="form2" type="text" name="grupo" required>

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

                <div align="center" id="tab-body-2" class="tab-body">

                    <div class=" push-20 grid-60 grid-conteiner grid-parent  grid-container mobile-grid-100  form1">
                    
                            <h2 class="title">Cargar CSV</h2>
                            <form>
                            <div class="grid-50 grid-parent  grid-container mobile-grid-100">

                                <label>Fecha - Inicial</label>
                                <input class="form2" type="text" name="fecha_ini" required>
                              
                               <label>Tipo - Permiso</label>
                                <input class="form2" type="text" name="tipo" required>

                        	</div>

                            <div class="grid-50 grid-parent  grid-container mobile-grid-100">

                            	<label>Trabajador</label>
                                <input class="form2" type="text" name="trabajador" required>
                                
                                <label>Fecha - Final</label>
                                <input class="form2" type="textarea" name="fecha_cul" required>

                            </div>

                            <div class="grid-100 grid-parent">

                              <input type="submit" class="submit" value="Enviar" />
                              <a class="btn_listar" href="listarUsuario.php">Listar</a>

                            </div>
                        </form>    
                    </div>
                </div>  
             </div>
       </div>      
    </body>
</html>