<?php

//error_reporting(0);
// NOMBRE DE LA BASE DE DATOS
$conexion = "port=5432 host=localhost  dbname=rrhh user= postgres password=1234";
$cnx = pg_connect($conexion) or die ("<h1>Error de conexion.</h1> ". pg_last_error());

pg_set_client_encoding($cnx,"unicode");

if(isset($_REQUEST["cedula"])){
$cedula=pg_escape_string($_REQUEST["cedula"]);
}
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
if ($dat1>0) {
    $pdf->SetFont('Arial','B','10');
    $pdf->Cell(40,8,'CURSOS REALIZADOS: ',0,1,'J');
    $pdf->tabla1($head1,$dat1);
}
else{
    $pdf->SetFont('Arial','B','10');
    $pdf->Cell(200,8,'EL TRABAJADOR NO CUENTA CON CURSOS REGISTRADOS',0,1,'C');
}
$pdf->Output(null,null,true); //el resto es historia
?>