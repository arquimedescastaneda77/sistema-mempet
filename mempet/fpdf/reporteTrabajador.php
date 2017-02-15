<?php

error_reporting(0);
// NOMBRE DE LA BASE DE DATOS
$conexion = "port=5432 host=localhost  dbname=rrhh user= postgres password=1234";
$cnx = pg_connect($conexion) or die ("<h1>Error de conexion.</h1> ". pg_last_error());

pg_set_client_encoding($cnx,"unicode");

$cod='';

if(isset($_REQUEST["name_act"])){
    $cod=pg_escape_string($_REQUEST["name_act"]);
}
$act = pg_query("SELECT  nombrec from tbl_persona WHERE cedula=9274815");

$act1 = pg_query("SELECT id, ficha, nomina, cargo, extencion, ingreso, status from tbl_trabajador WHERE cedula=9274815 ORDER BY cedula");
$act2 = pg_query("SELECT id, parentesco, edad_c, condicion from tbl_familiar WHERE cedula=9274815 ORDER BY cedula");

$act3 = pg_query("SELECT id, cedula,edad, sexo, nacimiento, est_cvl, direccion, grupo_sanguineo, nacionalidad from tbl_persona WHERE cedula=9274815");

$act4 = pg_query("SELECT id_curso, modalidad, titulo, lugar, duracion, postulacion, beneficio from tbl_curso WHERE cedula=9274815");

//creas un nuevo act

require_once('fpdf.php'); //incluimos la libreria.

class PDF extends FPDF {

    function tabla($header,$data)//tabla nombre
    
    {

    $this->SetFillColor(173, 205, 243); //color de fondo de las celdas
    $this->SetTextColor(0);
    $this->SetDrawColor(1, 1, 1); // color de linea
    $this->SetLineWidth(.2);    // ancho de linea
    $this->SetFont('','B');     // negrita
    $w1=array(45);   // en este arreglo definiremos el ancho de cada columna

    for($i=0;$i<count($header);$i++)

    $this->Cell($w1[$i],6,$header[$i],1,0,'L',1); //por cada encabezado existente, crea una celda
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
    $w=array(10,25,25,25,30,25,35);   // en este arreglo definiremos el ancho de cada columna
    
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
        $this->Cell($w[5],8,$columna[5],'LR',0,'C',$fill);
        $this->Cell($w[6],8,$columna[6],'LR',0,'C',$fill);

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
    $w2=array(10,30,25,45);   // en este arreglo definiremos el ancho de cada columna
    
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
        $this->Cell($w2[0],7,$columna[0],'LR',0,'C',$fill); //celda(ancho,alto,salto de linea,border,alineacion,relleno)
        $this->Cell($w2[1],6,$columna[1],'LR',0,'C',$fill);
        $this->Cell($w2[2],8,$columna[2],'LR',0,'C',$fill);
        $this->Cell($w2[3],8,$columna[3],'LR',0,'C',$fill);

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
    $w3=array(10,20,13,13,40,25,25,25,30);   // en este arreglo definiremos el ancho de cada columna
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
        $this->Cell($w3[7],8,$columna[7],'LR',0,'C',$fill);
        $this->Cell($w3[8],8,$columna[8],'LR',0,'C',$fill);

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
    $w4=array(10,20,35,30,30,30,30);   // en este arreglo definiremos el ancho de cada columna
    // cabecera
$i=0;
while ($fila=pg_fetch_array($act3)){  //llenar variable dat con los campos de una fila unidos por ;
    $dat3[$i]=$fila[0].";".($fila[1]).";".($fila[2].";".$fila[3].";".$fila[4].";".$fila[5].";".$fila[6].";".$fila[8].";".$fila[7]); //concatenar para luego ser separado por explode()
    $i++;
}

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
        $this->Cell($w4[0],7,$columna[0],'LR',0,'C',$fill); //celda(ancho,alto,salto de linea,border,alineacion,relleno)
        $this->Cell($w4[1],6,$columna[1],'LR',0,'C',$fill);
        $this->Cell($w4[2],8,$columna[2],'LR',0,'C',$fill);
        $this->Cell($w4[3],8,$columna[3],'LR',0,'C',$fill);
        $this->Cell($w4[4],8,$columna[4],'LR',0,'C',$fill);
        $this->Cell($w4[5],8,$columna[5],'LR',0,'C',$fill);
        $this->Cell($w4[6],8,$columna[6],'LR',0,'C',$fill);

        $this->Ln();
        $fill=!$fill; //se alterna el valor del boolean $fill para cambiar relleno
    }
    $this->Cell(array_sum($w4),0,'','T');
}

function Header()
    {
        $this->Image('img/pdvsa.png',20,15,70,20);
        $this->Ln(30);
        $this->SetFont('Arial','B','10');
    } 

function Footer() {     //Go to 1.5 cm from bottom     $this->SetY(-15);   
     $this->SetFont('Arial','I',8);      
     $this->Image('img/Imagen1.jpg',20,250,180,20);
     }
}
$pdf = new PDF("P","mm","letter");
        
$pdf->AliasNbPages(); //funcion que calcula el numero de paginas
$head = array("       Nombre y Apellido"); // cabecera
$i=0;
while ($fila=pg_fetch_array($act)){  //llenar variable dat con los campos de una fila unidos por ;
    $dat[$i]=$fila[0].";".($fila[1]); //concatenar para luego ser separado por explode()
    $i++;
}

$head1 = array("ID","Ficha","Nomina","Cargo","Extencion","Ingreso", "Estatus"); // cabecera de la tabla datos internos
$i=0;
while ($fila=pg_fetch_array($act1)){  //llenar variable dat con los campos de una fila unidos por ;
    $dat1[$i]=$fila[0].";".($fila[1]).";".($fila[2].";".$fila[3].";".$fila[4].";".$fila[5].";".$fila[6]); //concatenar para luego ser separado por explode()
    $i++;
}

$head2 = array("ID","Parentesco","Edad","Condicion Medica"); // cabecera
$i=0;
while ($fila=pg_fetch_array($act2)){  //llenar variable dat con los campos de una fila unidos por ;
    $dat2[$i]=$fila[0].";".($fila[1]).";".($fila[2].";".$fila[3]); //concatenar para luego ser separado por explode()
    $i++;
}

$head3 = array("ID","Cedula","Edad","Sexo","Fecha de Nacimiento","Estado Civil","Direccion", "Nacionalidad","Tipo de Sangre"); // cabecera
$i=0;
while ($fila=pg_fetch_array($act3)){  //llenar variable dat con los campos de una fila unidos por ;
    $dat3[$i]=$fila[0].";".($fila[1]).";".($fila[2].";".$fila[3].";".$fila[4].";".$fila[5].";".$fila[6].";".$fila[8].";".$fila[7]); //concatenar para luego ser separado por explode()
    $i++;
}

$head4 = array("ID","Modalidad","Titulo","Lugar","Duracion","Postulacion","Beneficios"); // cabecera
$i=0;
while ($fila=pg_fetch_array($act4)){  //llenar variable dat con los campos de una fila unidos por ;
    $dat4[$i]=$fila[0].";".($fila[1]).";".($fila[2].";".$fila[3].";".$fila[4].";".$fila[5].";".$fila[6].";".$fila[8].";".$fila[7]); //concatenar para luego ser separado por explode()
    $i++;
}

$pdf->AddPage(); //crear documento
$pdf->Ln(0);
$pdf->Cell(40);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,1,'REPORTES DEL PERSONAL INTERNO REGISTRADO',0,1,'L');//0 para misma linea, 1 para salto de linea
$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(180,1,"Cumana, ".date('d \d\e M \d\e\l Y'),0,1,'R');
$pdf->Ln(5);
//$pdf->Cell(180,1,"Hora: ".date('h:i:s'),0,1,'R');
$pdf->SetFont('Arial','B',10);
        
        $pdf->Ln(5);
        $pdf->Cell(180,10,'INFORME DE DATOS PERSONALES',0,1,'C');
        $pdf->SetFont('Arial','B','10');
        $pdf->Image('img/foto.jpg',150,60,35,35);//derecha, arriba, ancho, largo
        
$pdf->Ln(3);
$pdf->SetFont('Arial','B','10');
$pdf->Cell(40,8,'TRABAJADOR: ',0,1,'J');
$pdf->tabla($head,$dat);
$pdf->Ln(2); 
$pdf->SetFont('Arial','B','10');
$pdf->Cell(40,8,'DATOS PERSONALES: ',0,1,'J');
$pdf->tabla3($head3,$dat3);
$pdf->Ln(2);
$pdf->SetFont('Arial','B','10');
$pdf->Cell(40,8,'DATOS INTERNOS: ',0,1,'J');
$pdf->tabla1($head1,$dat1);
$pdf->Ln(2);  
$pdf->SetFont('Arial','B','10');
$pdf->Cell(40,8,'DATOS FAMILIARES: ',0,1,'J');
$pdf->tabla2($head2,$dat2);
$pdf->Ln(2);  
$pdf->SetFont('Arial','B','10');
$pdf->Cell(40,8,'DATOS ACADEMICOS: ',0,1,'J');
$pdf->tabla4($head4,$dat4); 

$pdf->Output(null,null,true); //el resto es historia

?>