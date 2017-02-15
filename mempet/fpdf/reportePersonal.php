<?php

error_reporting(0);
// NOMBRE DE LA BASE DE DATOS
$conexion = "port=5432 host=localhost  dbname=rrhh user= postgres password=1234";
$cnx = pg_connect($conexion) or die ("<h1>Error de conexion.</h1> ". pg_last_error());

pg_set_client_encoding($cnx,"unicode");
//$act = pg_query("SELECT nombre, fecha_programacion, cod FROM actividades");
//$act1= pg_query("SELECT alumno_ci,nombre_apellido,nota FROM notas,usuario");
$cod='';
if(isset($_REQUEST["name_act"])){
    $cod=pg_escape_string($_REQUEST["name_act"]);
}
$act = pg_query("SELECT  cedula, nombrec, sexo, nacimiento, edad, grupo_sanguineo from tbl_persona ORDER BY cedula");



require_once('fpdf.php'); //incluimos la libreria.

class PDF extends FPDF {

    function tabla($header,$data)
    {

    $this->SetFillColor(173, 205, 243); //color de fondo de las celdas
    $this->SetTextColor(0);
    $this->SetDrawColor(1, 1, 1); // color de linea
    $this->SetLineWidth(.2);    // ancho de linea
    $this->SetFont('','B');     // negrita
    $w1=array(30,55,18,30,18,35);   // en este arreglo definiremos el ancho de cada columna

    for($i=0;$i<count($header);$i++)

    $this->Cell($w1[$i],6,$header[$i],1,0,'C',1); //por cada encabezado existente, crea una celda
    $this->Ln();
    //Colores, ancho de línea y fuente en negrita de CONTENIDO
    $this->SetFillColor(224, 224, 224); //color de las celdas internas se debe usar el rgb dado que es lo unico que permite el llenado del color
    $this->SetTextColor(0);
    $this->SetFont('Arial');
    //Datos
    $fill=false; // variable para alternar relleno
    foreach($data as $row)
 {
  $columna = explode(";",$row); //separar los datos en posiciones de arreglo
  //celda(ancho,alto,salto de linea,border,alineacion,relleno)
        $this->Cell($w1[0],8,$columna[0],'LR',0,'C',$fill); //celda(ancho,alto,salto de linea,border,alineacion,relleno)
        $this->Cell($w1[1],8,$columna[1],'LR',0,'L',$fill);
        $this->Cell($w1[2],8,$columna[2],'LR',0,'C',$fill);
        $this->Cell($w1[3],8,$columna[3],'LR',0,'C',$fill);
        $this->Cell($w1[4],8,$columna[4],'LR',0,'C',$fill);
        $this->Cell($w1[5],8,$columna[5],'LR',0,'C',$fill);

        $this->Ln();
        $fill=!$fill; //se alterna el valor del boolean $fill para cambiar relleno
    }
    $this->Cell(array_sum($w1),0,'','T');

    }

function Header()
    {
        $this->Image('img/pdvsa.png',20,15,70,20);
        $this->Ln(30);
        $this->SetFont('Arial','B','10');
       // $this->Cell(180,10,'REPORTES DEL PERSONAL INTERNO REGISTRADO',0,1,'L'); //0 para misma linea, 1 para salto de linea
        //$this->Ln(1);
       // $this->Cell(180,10,'Cumana, '.$GLOBALS["fecha"].'.',0,1,'L');
    }   
function Footer() {     //Go to 1.5 cm from bottom     $this->SetY(-15);   
     $this->SetFont('Arial','I',8);      
     $this->Image('img/Imagen1.jpg',20,250,180,20);

     
     }
}
$pdf = new PDF("P","mm","letter");

$pdf->AliasNbPages(); //funcion que calcula el numero de paginas
$head = array("Cedula","Nombre y Apellido","Sexo","Nacimiento","Edad","Grupo Sanguineo"); // cabecera
$i=0;
while ($fila=pg_fetch_array($act)){  //llenar variable dat con los campos de una fila unidos por ;
    $dat[$i]=$fila[0].";".($fila[1]).";".$fila[2].";".$fila[3].";".$fila[4].";".$fila[5]; //concatenar para luego ser separado por explode()
    $i++;

}


$pdf->AddPage(); //crear documento
//$pdf->Image('logo.jpg',180,10,15,15); //añadir imagen
$pdf->Ln(0);
$pdf->Cell(40);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,1,'REPORTES DEL PERSONAL INTERNO REGISTRADO',0,1,'L');//0 para misma linea, 1 para salto de linea
$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(180,1,"Cumana: ".date('d-m-Y'),0,0,'R');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
        
        $pdf->Ln(5);
        $pdf->Cell(180,10,'INFORME DE DATOS PERSONALES',0,1,'C');
        $pdf->SetFont('Arial','B','10');
        $pdf->Image('img/images.png',150,60,35,35);//derecha, arriba, ancho, largo

        
$pdf->Ln(12);
$pdf->SetFont('Arial','B','10');
$pdf->Cell(40,8,'LISTADO GENERAL: ',0,1,'J');
$pdf->tabla($head,$dat);
$pdf->Ln(7); 
$pdf->Output(null,null,true); //el resto es historia

?>