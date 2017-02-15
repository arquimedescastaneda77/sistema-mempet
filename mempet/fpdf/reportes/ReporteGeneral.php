<?php
if(isset($_REQUEST["cedula_reporte"])){
$cedula=pg_escape_string($_REQUEST["cedula_reporte"]);
$accion = $_POST["tipo_reporte"];
}

//error_reporting(0);
// NOMBRE DE LA BASE DE DATOS
$conexion = "port=5432 host=localhost  dbname=rrhh user= postgres password=gamn2090";
$cnx = pg_connect($conexion) or die ("<h1>Error de conexion.</h1> ". pg_last_error());

pg_set_client_encoding($cnx,"unicode");

switch($accion)
{
 
  /*======================================================REPORTE GENERAL CURSOS===================================================================================*/   

case 1:

        $SQL="SELECT  nombrec, cedula from tbl_persona WHERE cedula='{$cedula}'";
        $act = pg_query($SQL);
        $PEOPLE=pg_fetch_assoc($act);
        $act1 = pg_query("SELECT  * from tbl_capacitacion WHERE cedula='{$cedula}'");

        require_once('../fpdf.php'); //incluimos la libreria.

        class PDF extends FPDF {

        function tabla($header,$data)//tabla nombre
            
            {

            $this->SetFillColor(173, 205, 243); //color de fondo de las celdas
            $this->SetTextColor(0);
            $this->SetDrawColor(1, 1, 1); // color de linea
            $this->SetLineWidth(.2);    // ancho de linea
            $this->SetFont('','B');     // negrita
            $w=array(45,30);   // en este arreglo definiremos el ancho de cada columna

            for($i=0;$i<count($header);$i++)

            $this->Cell($w[$i],6,$header[$i],1,0,'C',1); //por cada encabezado existente, crea una celda
            $this->Ln();
            //Colores, ancho de línea y fuente en negrita de CONTENIDO
            $this->SetFillColor(255); //
            $this->SetTextColor(0);
            $this->SetFont('Arial');
            //Datos
            $fill=false; // variable para alternar relleno
            foreach($data as $row)
         {
          $columna = explode(";",$row); //separar los datos en posiciones de arreglo
          //celda(ancho,alto,salto de linea,border,alineacion,relleno)
                $this->Cell($w[0],8,$columna[0],'LR',0,'C',$fill);
                $this->Cell($w[1],8,$columna[1],'LR',0,'C',$fill); //celda(ancho,alto,salto de linea,border,alineacion,relleno)

                $this->Ln();
                $fill=!$fill; //se alterna el valor del boolean $fill para cambiar relleno
            }
            $this->Cell(array_sum($w),0,'','T');

            }
              
        function tabla1($header,$data)
            {

            $this->SetFillColor(173, 205, 243); //color de fondo de las celdas
            $this->SetTextColor(0);
            $this->SetDrawColor(1, 1, 1); // color de linea
            $this->SetLineWidth(.2);    // ancho de linea
            $this->SetFont('','B');     // negrita
            $w1=array(20,25,35,25,30,35,25);   // en este arreglo definiremos el ancho de cada columna

            for($i=0;$i<count($header);$i++)

            $this->Cell($w1[$i],6,$header[$i],1,0,'C',1); //por cada encabezado existente, crea una celda
            $this->Ln();
            //Colores, ancho de línea y fuente en negrita de CONTENIDO
            $this->SetFillColor(224, 224, 224); //
            $this->SetTextColor(0);
            $this->SetFont('Arial');
            //Datos
            $fill=false; // variable para alternar relleno
            foreach($data as $row)
         {
          $columna = explode(";",$row); //separar los datos en posiciones de arreglo
          //celda(ancho,alto,salto de linea,border,alineacion,relleno)
                $this->Cell($w1[0],8,$columna[0],'LR',0,'C',$fill); //celda(ancho,alto,salto de linea,border,alineacion,relleno)
                $this->Cell($w1[1],8,$columna[1],'LR',0,'C',$fill);
                $this->Cell($w1[2],8,$columna[2],'LR',0,'C',$fill);
                $this->Cell($w1[3],8,$columna[3],'LR',0,'C',$fill);
                $this->Cell($w1[4],8,$columna[4],'LR',0,'C',$fill);
                $this->Cell($w1[5],8,$columna[5],'LR',0,'C',$fill);
                $this->Cell($w1[6],8,$columna[6],'LR',0,'C',$fill);
                $this->Ln();
                $fill=!$fill; //se alterna el valor del boolean $fill para cambiar relleno
            }
            $this->Cell(array_sum($w1),0,'','T');

            }

        function Header()
            {
                $this->Image('../img/logo.png',20,15,180,15);
                $this->Ln(30);
                $this->SetFont('Arial','B','10');
            } 

        function Footer() {     //Go to 1.5 cm from bottom     $this->SetY(-15);   
             $this->SetFont('Arial','I',8);      
             $this->Image('../img/imagen.jpg',20,250,180,10);//Izquierda a derecha, posicion, Ancho, Alto; 
             }
        }
        $pdf = new PDF("P","mm","letter");
           
        $pdf->AliasNbPages(); //funcion que calcula el numero de paginas
        $head = array("TRABAJADOR", utf8_decode("Cédula")); // cabecera
        $i=0;
        $dat=[
            //llenar variable dat con los campos de una fila unidos por ;
            //concatenar para luego ser separado por explode()
            $PEOPLE["nombrec"].";".$PEOPLE["cedula"]
        ];
        $head1 = array(utf8_decode("Cédula"),"Modalidad",utf8_decode("Título"),"Lugar",utf8_decode("Duración"),utf8_decode("Postulación"),"Beneficios"); // cabecera
        $dat1=[
            
        ];
        while($course=pg_fetch_assoc($act1)){
            $dat1[]=$course["cedula"].";".$course["modalidad"].";".$course["titulo"].";".$course["lugar"].";".$course["duracion"].";".$course["postulacion"].";".$course["beneficio"];
        }
        $pdf->AliasNbPages(); //funcion que calcula el numero de paginas


        $pdf->AddPage(); //crear documento
        $pdf->Ln(0);
        $pdf->Cell(40);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,1,utf8_decode('REPORTES ACADÉMICO DEL PERSONAL'),0,1,'L');//0 para misma linea, 1 para salto de linea
        $pdf->Ln(10);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(200,1,utf8_decode("Cumaná, ").date('d \d\e M \d\e\l Y'),0,1,'R');
        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',10);
                
                $pdf->Ln(5);
                $pdf->Cell(180,10,'HISTORIAL DE CURSOS REALIZADOS',0,1,'C');
                $pdf->SetFont('Arial','B','10');
               // $pdf->Image('img/cursos.png',160,60,40,40);//derecha, arriba, ancho, largo
                
        $pdf->Ln(10);
        $pdf->SetFont('Arial','B','10');
        $pdf->Cell(40,8,'TRABAJADOR: ',0,1,'J');
        $pdf->tabla($head,$dat);
        $pdf->Ln(5);
        $pdf->SetFont('Arial','B','10');
        $pdf->Cell(40,8,'CURSOS REALIZADOS: ',0,1,'J');
        $pdf->tabla1($head1,$dat1);
        $pdf->Output(null,null,true); //el resto es HISTORIAL

    break;

 /*======================================================REPORTE GENERAL TRABAJADOR===================================================================================*/   
    case 2:

    $SQL="SELECT tbl_persona.cedula,tbl_persona.edad,tbl_trabajador.email,tbl_persona.direccion, tbl_persona.sexo, tbl_persona.nacimiento, tbl_persona.est_cvl, tbl_persona.grupo_sanguineo, tbl_persona.nacionalidad,tbl_persona.nombrec,tbl_trabajador.ficha, tbl_trabajador.nomina, tbl_trabajador.cargo, /*tbl_trabajador.extencion,*/ tbl_trabajador.ingreso, tbl_trabajador.status from tbl_persona 
        INNER JOIN tbl_trabajador on tbl_trabajador.cedula=tbl_persona.cedula WHERE tbl_persona.cedula='{$cedula}'";
        $act = pg_query($SQL);
        $_USER= pg_fetch_assoc($act);

        $SQL2="SELECT parentesco, edad_c, condicion from tbl_familiar WHERE ced_trabajador='{$cedula}' ORDER BY cedula";
        $act2 = pg_query($SQL2);

        $SQL3="SELECT modalidad, titulo, lugar, duracion, postulacion, beneficio from tbl_capacitacion WHERE cedula='{$cedula}'";
        $act3 = pg_query($SQL3);

        require_once('../fpdf.php'); //incluimos la libreria.

        class PDF extends FPDF { //tabla nombre

            function tabla($header,$data)//tabla nombre
            
            {

            $this->SetFillColor(173, 205, 243); //color de fondo de las celdas
            $this->SetTextColor(0);
            $this->SetDrawColor(1, 1, 1); // color de linea
            $this->SetLineWidth(.2);    // ancho de linea
            $this->SetFont('','B');     // negrita
            $w1=array(100);   // en este arreglo definiremos el ancho de cada columna

            for($i=0;$i<count($header);$i++)

            $this->Cell($w1[$i],6,$header[$i],1,0,'C',1); //por cada encabezado existente, crea una celda
            $this->Ln();
            //Colores, ancho de línea y fuente en negrita de CONTENIDO
            $this->SetFillColor(255); //
            $this->SetTextColor(0);
            $this->SetFont('Arial');
            //Datos
            $fill=false; // variable para alternar relleno
            foreach($data as $row)
         {
          $columna = explode(";",$row); //separar los datos en posiciones de arreglo
          //celda(ancho,alto,salto de linea,border,alineacion,relleno)
                $this->Cell($w1[0],8,$columna[0],'LR',0,'C',$fill); //celda(ancho,alto,salto de linea,border,alineacion,relleno)

                $this->Ln();
                $fill=!$fill; //se alterna el valor del boolean $fill para cambiar relleno
            }
            $this->Cell(array_sum($w1),0,'','T');

            }
            
        function tabla1($header,$data)//tabla trabajador
        {
            //Colores, ancho de línea y fuente en negrita de CABECERA
            $this->SetFillColor(173, 205, 243); //color de fondo de las celdas
            $this->SetTextColor(0);
            $this->SetDrawColor(1, 1, 1); // color de linea
            $this->SetLineWidth(.2);    // ancho de linea
            $this->SetFont('','B');     // negrita
            $w=array(30,35,35,30,30);   // en este arreglo definiremos el ancho de cada columna
            
            for($i=0;$i<count($header);$i++)
            
            $this->Cell($w[$i],6,$header[$i],1,0,'C',1); //por cada encabezado existente, crea una celda
            $this->Ln();
            
            //Colores, ancho de línea y fuente en negrita de CONTENIDO
            $this->SetFillColor(224, 224, 224); //
            $this->SetTextColor(0);
            $this->SetFont('Arial');
            //Datos
            $fill=false; // variable para alternar relleno
            foreach($data as $row)
            {
          $columna = explode(";",$row); //separar los datos en posiciones de arreglo
                $this->Cell($w[0],7,$columna[0],'LR',0,'C',$fill); //celda(ancho,alto,salto de linea,border,alineacion,relleno)
                $this->Cell($w[1],6,$columna[1],'LR',0,'C',$fill);
                $this->Cell($w[2],8,$columna[2],'LR',0,'C',$fill);
                $this->Cell($w[3],8,$columna[3],'LR',0,'C',$fill);
                $this->Cell($w[4],8,$columna[4],'LR',0,'C',$fill);
                //$this->Cell($w[5],8,$columna[5],'LR',0,'C',$fill);
                //$this->Cell($w[6],8,$columna[6],'LR',0,'C',$fill);

                $this->Ln();
                $fill=!$fill; //se alterna el valor del boolean $fill para cambiar relleno
            }
            $this->Cell(array_sum($w),0,'','T');
        }

        function tabla2($header,$data)//tabla familiar
        {
            //Colores, ancho de línea y fuente en negrita de CABECERA
            $this->SetFillColor(173, 205, 243); //color de fondo de las celdas
            $this->SetTextColor(0);
            $this->SetDrawColor(1, 1, 1); // color de linea
            $this->SetLineWidth(.2);    // ancho de linea
            $this->SetFont('','B');     // negrita
            $w2=array(30,25,45);   // en este arreglo definiremos el ancho de cada columna
            
            for($i=0;$i<count($header);$i++)
            
            $this->Cell($w2[$i],6,$header[$i],1,0,'C',1); //por cada encabezado existente, crea una celda
            $this->Ln();
            
            //Colores, ancho de línea y fuente en negrita de CONTENIDO
            $this->SetFillColor(224, 224, 224); //
            $this->SetTextColor(0);
            $this->SetFont('Arial');
            //Datos
            $fill=false; // variable para alternar relleno
            foreach($data as $row)
            {
          $columna = explode(";",$row); //separar los datos en posiciones de arreglo
                //$this->Cell($w2[0],7,$columna[0],'LR',0,'C',$fill); //celda(ancho,alto,salto de linea,border,alineacion,relleno)
                $this->Cell($w2[0],6,$columna[0],'LR',0,'C',$fill);
                $this->Cell($w2[1],8,$columna[1],'LR',0,'C',$fill);
                $this->Cell($w2[2],8,$columna[2],'LR',0,'C',$fill);

                $this->Ln();
                $fill=!$fill; //se alterna el valor del boolean $fill para cambiar relleno
            }
            $this->Cell(array_sum($w2),0,'','T');
        }

        function tabla3($header,$data)// tabla datos personales
        {
            //Colores, ancho de línea y fuente en negrita de CABECERA
            $this->SetFillColor(173, 205, 243); //color de fondo de las celdas
            $this->SetTextColor(0);
            $this->SetDrawColor(1, 1, 1); // color de linea
            $this->SetLineWidth(.2);    // ancho de linea
            $this->SetFont('','B');     // negrita
            $w3=array(30,20,20,35,30,30,30);   // en este arreglo definiremos el ancho de cada columna
            //

            for($i=0;$i<count($header);$i++)
            
            $this->Cell($w3[$i],6,$header[$i],1,0,'C',1); //por cada encabezado existente, crea una celda
            $this->Ln();
            
            //Colores, ancho de línea y fuente en negrita de CONTENIDO
            $this->SetFillColor(224, 224, 224); //
            $this->SetTextColor(0);
            $this->SetFont('Arial');
            //Datos
            $fill=false; // variable para alternar relleno
            foreach($data as $row)
            {
          $columna = explode(";",$row); //separar los datos en posiciones de arreglo
                $this->Cell($w3[0],7,$columna[0],'LR',0,'C',$fill); //celda(ancho,alto,salto de linea,border,alineacion,relleno)
                $this->Cell($w3[1],6,$columna[1],'LR',0,'C',$fill);
                $this->Cell($w3[2],8,$columna[2],'LR',0,'C',$fill);
                $this->Cell($w3[3],8,$columna[3],'LR',0,'C',$fill);
                $this->Cell($w3[4],8,$columna[4],'LR',0,'C',$fill);
                $this->Cell($w3[5],8,$columna[5],'LR',0,'C',$fill);
                $this->Cell($w3[6],8,$columna[6],'LR',0,'C',$fill);
                //$this->Cell($w3[7],8,$columna[7],'LR',0,'C',$fill);
                //$this->Cell($w3[8],8,$columna[8],'LR',0,'C',$fill);
                

                $this->Ln();
                $fill=!$fill; //se alterna el valor del boolean $fill para cambiar relleno
            }
            $this->Cell(array_sum($w3),0,'','T');
        }

        function tabla4($header,$data)// tabla curso
        {
            //Colores, ancho de línea y fuente en negrita de CABECERA
            $this->SetFillColor(173, 205, 243); //color de fondo de las celdas
            $this->SetTextColor(0);
            $this->SetDrawColor(1, 1, 1); // color de linea
            $this->SetLineWidth(.2);    // ancho de linea
            $this->SetFont('','B');     // negrita
            $w4=array(30,40,30,30,30,30);   // en este arreglo definiremos el ancho de cada columna
            for($i=0;$i<count($header);$i++)
            
            $this->Cell($w4[$i],6,$header[$i],1,0,'C',1); //por cada encabezado existente, crea una celda
            $this->Ln();
            
            //Colores, ancho de línea y fuente en negrita de CONTENIDO
            $this->SetFillColor(224, 224, 224); //
            $this->SetTextColor(0);
            $this->SetFont('Arial');
            //Datos
            $fill=false; // variable para alternar relleno
            foreach($data as $row)
            {
          $columna = explode(";",$row); //separar los datos en posiciones de arreglo
                //$this->Cell($w4[0],7,$columna[0],'LR',0,'C',$fill); //celda(ancho,alto,salto de linea,border,alineacion,relleno)
                $this->Cell($w4[0],6,$columna[0],'LR',0,'C',$fill);
                $this->Cell($w4[1],8,$columna[1],'LR',0,'C',$fill);
                $this->Cell($w4[2],8,$columna[2],'LR',0,'C',$fill);
                $this->Cell($w4[3],8,$columna[3],'LR',0,'C',$fill);
                $this->Cell($w4[4],8,$columna[4],'LR',0,'C',$fill);
                $this->Cell($w4[5],8,$columna[5],'LR',0,'C',$fill);

                $this->Ln();
                $fill=!$fill; //se alterna el valor del boolean $fill para cambiar relleno
            }
            $this->Cell(array_sum($w4),0,'','T');
        }

        function tabla5($header,$data)//tabla correos
        {
            //Colores, ancho de línea y fuente en negrita de CABECERA
            $this->SetFillColor(173, 205, 243); //color de fondo de las celdas
            $this->SetTextColor(0);
            $this->SetDrawColor(1, 1, 1); // color de linea
            $this->SetLineWidth(.2);    // ancho de linea
            $this->SetFont('','B');     // negrita
            $w5=array(100);   // en este arreglo definiremos el ancho de cada columna
            
            for($i=0;$i<count($header);$i++)
            
            $this->Cell($w5[$i],6,$header[$i],1,0,'C',1); //por cada encabezado existente, crea una celda

            $this->Ln();
            
            //Colores, ancho de línea y fuente en negrita de CONTENIDO
            $this->SetFillColor(224, 224, 224); //
            $this->SetTextColor(0);
            $this->SetFont('Arial');
            //Datos
            $fill=false; // variable para alternar relleno
            foreach($data as $row)
            {
          $columna = explode(";",$row); //separar los datos en posiciones de arreglo
                $this->Cell($w5[0],7,$columna[0],'LR',0,'C',$fill); //celda(ancho,alto,salto de linea,border,alineacion,relleno)
               // $this->Cell($w5[1],6,$columna[1],'LR',0,'C',$fill);

                $this->Ln();
                $fill=!$fill; //se alterna el valor del boolean $fill para cambiar relleno
            }
            $this->Cell(array_sum($w5),0,'','T');
        }

        function tabla6($header,$data)//tabla direccion
        {
            //Colores, ancho de línea y fuente en negrita de CABECERA
            $this->SetFillColor(173, 205, 243); //color de fondo de las celdas
            $this->SetTextColor(0);
            $this->SetDrawColor(1, 1, 1); // color de linea
            $this->SetLineWidth(.2);    // ancho de linea
            $this->SetFont('','B');     // negrita
            $w6=array(195);   // en este arreglo definiremos el ancho de cada columna
            
            for($i=0;$i<count($header);$i++)
            
            $this->Cell($w6[$i],6,$header[$i],1,0,'C',1); //por cada encabezado existente, crea una celda
            $this->Ln();
            
            //Colores, ancho de línea y fuente en negrita de CONTENIDO
            $this->SetFillColor(224, 224, 224); //
            $this->SetTextColor(0);
            $this->SetFont('Arial');
            //Datos
            $fill=false; // variable para alternar relleno
            foreach($data as $row)
            {
          $columna = explode(";",$row); //separar los datos en posiciones de arreglo
                $this->Cell($w6[0],7,$columna[0],'LR',0,'C',$fill); //celda(ancho,alto,salto de linea,border,alineacion,relleno)
               // $this->Cell($w6[1],6,$columna[1],'LR',0,'C',$fill);

                $this->Ln();
                $fill=!$fill; //se alterna el valor del boolean $fill para cambiar relleno
            }
            $this->Cell(array_sum($w6),0,'','T');
        }
        function Header()
            {
                $this->Image('../img/logo.png',20,15,180,15);
                $this->Ln(30);
                $this->SetFont('Arial','B','10');
            } 

        function Footer() {     //Go to 1.5 cm from bottom     $this->SetY(-15);   
             $this->SetFont('Arial','I',8);      
             $this->Image('../img/imagen.jpg',20,250,180,10);//Izquierda a derecha, posicion, Ancho, Alto;
             }
        }
        $pdf = new PDF("P","mm","letter");
                
        $pdf->AliasNbPages(); //funcion que calcula el numero de paginas
        $head = array("Nombre y Apellido"); // cabecera
        $i=0;

        //GLOBAL $_USER;

        $dat=[
            $_USER['nombrec']
        ];
        $head3 = [utf8_decode(
            "Cédula"),
            "Edad",
            "Sexo",
            "F. Nacimiento",
            "Estado Civil",
            "Tipo de Sangre", 
            "Nacionalidad"
            ]; 
        $dat3=[
            implode(';',[
                $_USER['cedula'],
                $_USER['edad'],
                $_USER['sexo'],
                $_USER['nacimiento'],
                $_USER['est_cvl'],
                $_USER['grupo_sanguineo'],
                $_USER['nacionalidad']
            ]) 
            //concatenar para luego ser separado por explode()
        ];
        $head6 = [utf8_decode("Dirección")]; // cabecera
        $dat6=[$_USER['direccion']]; //concatenar para luego ser separado por explode()
        $head1 = [
            "Ficha",
            utf8_decode("Nómina"),
            "Cargo",
           // utf8_decode("Extención"),
            "Estatus",
            "Ingreso"
        ];
        $dat1=[
            implode(';',[
                $_USER['ficha'],
                $_USER['nomina'],
                $_USER['cargo'],
               // $_USER['extencion'],
                $_USER['status'],
                $_USER['ingreso']
            ])
        ];
        $head5 = ["Correo"]; // cabecera
        $dat5=[
            $_USER['email']
        ];
        $head2 = [
            "Parentesco",
            "Edad",
            utf8_decode("Condición Médica")
        ];
        $dat2=[];
        while($row=pg_fetch_assoc($act2)){
            $dat2[]=implode(';',[
                $row['parentesco'],
                $row['edad_c'],
                $row['condicion']
            ]);
            //concatenar para luego ser separado por explode()
        }
        $head4 = [
            "Modalidad",
           utf8_decode("Título"),
            "Lugar",
           utf8_decode("Duración"),
            utf8_decode("Postulación"),
            "Beneficios"
        ];
        $dat4=[];
        while($row=pg_fetch_array($act3)){
            $dat4[]=implode(';',[
                $row['modalidad'],
                $row['titulo'],
                $row['lugar'],
                $row['duracion'],
                $row['postulacion'],
                $row['beneficio']
            ]);
        }
        $pdf->AddPage(); //crear documento
        $pdf->Ln(0);
        $pdf->Cell(40);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,1,'REPORTES DEL PERSONAL INTERNO REGISTRADO',0,1,'L');//0 para misma linea, 1 para salto de linea
        $pdf->Ln(10);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(200,1,utf8_decode("Cumaná, ").date('d \d\e M \d\e\l Y'),0,1,'R');
        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',10);
            $pdf->Ln(5);
            $pdf->Cell(180,10,'INFORME DE DATOS PERSONALES',0,1,'C');
            $pdf->SetFont('Arial','B','10');
            //  $pdf->Image('img/foto.jpg',150,60,35,35);//derecha, arriba, ancho, largo
                
        $pdf->Ln(3);
        $pdf->SetFont('Arial','B','10');
        $pdf->Cell(40,8,'TRABAJADOR: ',0,1,'J');
        $pdf->tabla($head,$dat);
        $pdf->Ln(2); 
        $pdf->SetFont('Arial','B','10');
        $pdf->Cell(40,8,'DATOS PERSONALES: ',0,1,'J');
        $pdf->tabla3($head3,$dat3);
        $pdf->Ln(2);
        $pdf->tabla6($head6,$dat6);
        $pdf->Ln(2);
        $pdf->SetFont('Arial','B','10');
        $pdf->Cell(40,8,'DATOS INTERNOS: ',0,1,'J');
        $pdf->tabla1($head1,$dat1);
        $pdf->Ln(2);

        if(count($dat5)>0){
                $pdf->tabla5($head5,$dat5);
                    }
        $pdf->Ln(2);
        if(count($dat2)>0){
            $pdf->SetFont('Arial','B','10');
            $pdf->Cell(40,8,'DATOS FAMILIARES: ',0,1,'J');
            $pdf->tabla2($head2,$dat2);
            $pdf->Ln(2);   
        }
        if(count($dat4)>0){
            $pdf->SetFont('Arial','B','10');
            $pdf->Cell(40,8,utf8_decode('DATOS ACADÉMICOS: '),0,1,'J');
            $pdf->tabla4($head4,$dat4);
        }
        $pdf->Output(null,null,true); //el resto es historia
        break;
}
?>