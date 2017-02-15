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
$act = pg_query("SELECT id_curso, cedula,modalidad, titulo, lugar, duracion, postulacion, beneficio from tbl_curso WHERE cedula=9274815 ");

require_once('fpdf.php'); //incluimos la libreria.

class PDF extends FPDF {

    function tabla($header,$data)// tabla curso
{
    //Colores, ancho de línea y fuente en negrita de CABECERA
    $this->SetFillColor(173, 205, 243); //color de fondo de las celdas
    $this->SetTextColor(0);
    $this->SetDrawColor(1, 1, 1); // color de linea
    $this->SetLineWidth(.2);    // ancho de linea
    $this->SetFont('','B');     // negrita
    $w=array(10,20,25,30,30,20,30,30);   // en este arreglo definiremos el ancho de cada columna

$i=0;
while ($fila=pg_fetch_array($act3)){  //llenar variable dat con los campos de una fila unidos por ;
    $dat[$i]=$fila[0].";".($fila[1]).";".($fila[2].";".$fila[3].";".$fila[4].";".$fila[5].";".$fila[6].";".$fila[7]); //concatenar para luego ser separado por explode()
    $i++;
}

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
        $this->Cell($w[7],8,$columna[7],'LR',0,'C',$fill);

        $this->Ln();
        $fill=!$fill; //se alterna el valor del boolean $fill para cambiar relleno
    }
    $this->Cell(array_sum($w),0,'','T');
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

$head = array("ID","Cedula","Modalidad","Titulo","Lugar","Duracion","Postulacion","Beneficios"); // cabecera
$i=0;
while ($fila=pg_fetch_array($act)){  //llenar variable dat con los campos de una fila unidos por ;
    $dat[$i]=$fila[0].";".($fila[1]).";".($fila[2].";".$fila[3].";".$fila[4].";".$fila[5].";".$fila[6].";".$fila[7]); //concatenar para luego ser separado por explode()
    $i++;
}


$pdf->AddPage(); //crear documento
//$pdf->Image('logo.jpg',180,10,15,15); //añadir imagen
$pdf->Ln(0);
$pdf->Cell(40);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,1,'REPORTES DE CURSOS REALIZADO POR PERSONAL INTERNO',0,1,'L');//0 para misma linea, 1 para salto de linea
$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(180,1,"Cumana: ".date('d-m-Y'),0,0,'R');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
        
        $pdf->Ln(5);
        $pdf->Cell(180,10,'DATOS DE CURSOS REALIZADOS',0,1,'C');
        $pdf->SetFont('Arial','B','10');
        $pdf->Image('img/cursos.png',160,60,30,30);//derecha, arriba, ancho, largo

        
$pdf->Ln(13);
$pdf->SetFont('Arial','B','10');
$pdf->Cell(40,8,'LISTADO GENERAL: ',0,1,'J');
$pdf->tabla($head,$dat);
$pdf->Ln(7); 
$pdf->Output(null,null,true); //el resto es historia

?>