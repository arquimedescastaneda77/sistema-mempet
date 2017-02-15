<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../assets/css/main.css">
       <link rel="stylesheet" href="../../unsemantic-master/assets/css/unsemantic-grid-responsive-no-ie7.css">

       <?php
            include_once "../../modelo/Persona.php";
             //esta función la puedo llamar así porque es una funcion estatica, finaje en el modelo persona dice, public STATIC function ...
            $persona;
            if(isset($_GET['nombrec'])) {
                $nombrec = $_GET['nombrec'];
                $persona = Persona::buscar($nombrec); //esta función la puedo llamar así porque es una funcion estatica, finaje en el modelo persona dice, public STATIC function ...
            }
            else {
                $persona = Persona::listar();
            }
            $cantidadRegistros = count($persona);
            //echo $persona;
        ?>
    </head>
    <body>
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
                   <a href="registrarPersonal.php">Personal</a>
                </div>

                <div class="grid-25  grid-parent">
                    <a href="../informes/registrarPermisos.php">Informes</a>
                </div>

                <div class="grid-25  grid-parent">
                    <a href="../Referidos/registrosDepart.php">Referidos</a>
                </div>
             </div>  
        </div>
    </header>

   
        
        <div class="grid-100 grid-parent grid-container mobile-grid-100">

            <a  href="registrarPersonal.php" class="undo"><i class="icon-undo2"></i> Volver</a>

               <div align="center" class="grid-100 grid-container grid-parent">
                    <div class="buscador">
                        <button><i class="icon-clear-formatting"></i></button>
                        <input type="text" name="buscar" placeholder="Ingrese datos">
                        <button class="busqueda"><i class="icon-search"></i></button>
                    </div>
                </div>
                <div class="grid-100 grid-parent">

                    <div class="grid-100 grid-container grid-parent">

                        <div class="grid-100 table grid-parent">

                            <div class="grid-15 table_titulo grid-parent">
                                    Cédula
                            </div>

                            <div class="grid-25 table_titulo grid-parent">
                                    Nombre
                            </div>
                             
                            <div class="grid-15 table_titulo grid-parent">
                                    Edad
                            </div>

                             <div class="grid-20 table_titulo grid-parent">
                                    Grupo Sanguineo
                            </div>

                             <div class="grid-20 table_titulo grid-parent">
                                 Nacionalidad
                            </div>
                            <div class="grid-5 table_titulo grid-parent">

                            </div>
              
                            <?php
                                for($i=0; $i<$cantidadRegistros; $i++) {
                                    echo '<div class="grid-15 table1 grid-parent">' . $persona[$i]->cedula . '</div>';
                                    echo ' <div class="grid-25 table1 grid-parent">' . $persona[$i]->nombrec. '</div>';
                                    echo '<div class="grid-15 table1 grid-parent">' . $persona[$i]->edad . '</div>';
                                     echo '<div class="grid-20 table1 grid-parent">' . $persona[$i]->grupo_sanguineo . '</div>';
                                     echo '<div class="grid-20 table1 grid-parent">' . $persona[$i]->nacionalidad . '</div>';
                                    echo '<div class="grid-5 table1 grid-parent"><a class="button1" href="editarPersona.php?id='.$persona[$i]->cedula.'"><i class="icon-pencil"></i></a></div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            <div class="grid-100 grid-parent" id="div_listar_persona">
            </div>
        </div>
    </body>
    <script src="../../assets/js/jquery.js"></script>
    <script src="../../assets/js/personal.js"></script>
</html>