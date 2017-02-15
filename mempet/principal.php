<?php
  session_start();
  include 'conexion/conexion.php';

  if(isset($_SESSION['usuario'])) {
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Principal</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="unsemantic-master/assets/css/unsemantic-grid-responsive-no-ie7.css">
        <!-- IMPORTAMOS LOS ESTILOS DEL FRAMEWORK DE BOOTSTRAP -->
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.css">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme-min-css">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    </head>
    <body>
    <header>
        <!--header-->
        <div class="grid-100 decoration"></div>
        <div class="grid-100 grid-container principal">
            <img src="assets/img/banner.jpg" alt="logo">
            <ul class="grid-80 navigation grid-parent">
             
             <li class="grid-10 grid-parent">
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
                 <li class="grid-30 grid-parent">
                    <a href="conexion/logout.php">cerrar sesion</a>
                </li>
            </ul>
        </div>

        <div class="grid-100 decoration2">

            <div class="grid-100 decoration2">

             <div class="grid-100 grid-container grid-parent">

                <div class="grid-25  grid-parent">
                    <a href="principal.php">Inicio</a>
                </div>

                <div class="grid-25  grid-parent">
                   <a href="vista/personal/Personal.php">Personal</a>
                </div>

                <div class="grid-25  grid-parent">
                    <a href="vista/informes/Informes.php">Informes</a>
                </div>
                
                 <div class="grid-25  grid-parent">
                    <a href="vista/Referidos/Referidos.php">Referidos</a>
                </div>
                </div>  
            </div>
        </div>
        <div class="grid-100 decoration"></div>
        hola
        <div class="grid-100 grid-container principal">
            
        </div>
         <footer></footer>
         <!-- IMPORTAMOS LOS ARCHIVOS JAVASCRIPT DEL FRAMEWORK DE BOOTSTRAP -->
        <script type="text/javascript" src="assets/js/bootstrap.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.1.8.1.js"></script>
        <script type="text/javascript" src="assets/js/jquery.1.8.1.js"></script>
    </header>
    </body>
    </html>
<?php
}else{
    echo '<script> window.location="index.html"; </script>';
}
?>