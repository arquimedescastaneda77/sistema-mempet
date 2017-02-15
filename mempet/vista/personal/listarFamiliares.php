<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Listado-Trabajadores</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../assets/css/main.css">
        <link rel="stylesheet" href="../../unsemantic-master/assets/css/unsemantic-grid-responsive-no-ie7.css">
        <link href="../../assets/css/style.css" type="text/css" rel="stylesheet"/>
        <link href="../../assets/css/jquery-ui.css" type="text/css" rel="stylesheet"/>
        <link href="../../assets/css/datatables.css" type="text/css" rel="stylesheet"/>
    
    <script src="../../assets/js/jquery.js"></script>
    <script src="../../assets/js/jquery-ui.js"></script>
    <script src="../../assets/js/datatables.js"></script>
    <script src="../../assets/js/functions_familiar.js"></script>
    </head>
    <body>

         <script type="text/javascript">
        
        $(document).ready(function(){
            $('#tablex').DataTable().destroy();
           var $table= $('#tablex').DataTable({                        
                        "language": {
                                     "loadingRecords": " ",
                                     "lengthMenu": "Mostrando _MENU_ registros por página",
                                     "zeroRecords": "Nada econtrado - Perdón",
                                     "info": "Mostrando página _PAGE_ de _PAGES_",
                                     "infoEmpty": "No hay registros disponibles",
                                     "infoFiltered": "(filtrado de _MAX_ registros totales)" ,
                                     "search": "Búsqueda"                                             
                                  }
            });
        });
        
        $table.fnDestroy();
    </script>


        

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
                    <a href="../informes/Informes.php">Informes</a>
                </div>

                <div class="grid-25  grid-parent">
                    <a href="../Referidos/registrosDepart.php">Referidos</a>
                </div>
            </div>  
        </div>
    </header>

    <header class"table">
        <h1>Personal Registrados</h1>
    </header>
    
        <table id="tablex" class="display" style="text-align:center" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Cedula Beneficiario</th>
                    <th>Cedula Funcionario</th>
                    <th>Nombre Beneficiario</th>
                    <th>Condición</th>
                    <th>Nacimiento</th>
                    <th>Edad</th>
                    <th>Parentesco</th>
                    <th>Usuario</th>
                </tr>
            </thead>        
            <tfoot>
                <tr>
                    <th>Cedula Beneficiario</th>
                    <th>Cedula Funcionario</th>
                    <th>Nombre Beneficiario</th>
                    <th>Condición</th>
                    <th>Nacimiento</th>
                    <th>Edad</th>
                    <th>Parentesco</th>
                    <th>Usuario</th>
                </tr>
            </tfoot>
</table>
   
</body>
</html>