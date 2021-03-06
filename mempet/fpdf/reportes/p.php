<?php

error_reporting(0);
// NOMBRE DE LA BASE DE DATOS
$conexion = "port=5432 host=localhost  dbname=rrhh user= postgres password=1234";
$cnx = pg_connect($conexion) or die ("<h1>Error de conexion.</h1> ". pg_last_error());

//pg_set_client_encoding($cnx,"unicode");
//$act = pg_query("SELECT nombre, fecha_programacion, cod FROM actividades");
//$act1= pg_query("SELECT alumno_ci,nombre_apellido,nota FROM notas,usuario");

$departamento=pg_escape_string('informatica');
$SQL="SELECT  tbl_persona.cedula,tbl_persona.nombrec,tbl_departamento.departamento,tbl_departamento.encargado from tbl_persona 
 INNER JOIN tbl_trabajador ON tbl_trabajador.cedula=tbl_persona.cedula INNER JOIN tbl_departamento on tbl_departamento.departamento=tbl_trabajador.departamento";
 //WHERE tbl_trabajador.departamento='{$departamento}'
$act = pg_query($SQL);
$_USER= pg_fetch_assoc($act);
$act1 = pg_query("SELECT  id, departamento, division, encargado from tbl_departamento ORDER BY id");

require_once('fpdf.php'); //incluimos la libreria.

class PDF extends FPDF {

    function tabla($header,$data)
    {

    $this->SetFillColor(173, 205, 243); //color de fondo de las celdas
    $this->SetTextColor(0);
    $this->SetDrawColor(1, 1, 1); // color de linea
    $this->SetLineWidth(.2);    // ancho de linea
    $this->SetFont('','B');     // negrita
    $w1=array(10,30,35,40);   // en este arreglo definiremos el ancho de cada columna

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
        $this->Ln();
        $fill=!$fill; //se alterna el valor del boolean $fill para cambiar relleno
    }
    $this->Cell(array_sum($w1),0,'','T');

    }

function tabla1($header,$data)
    {

    $this->SetFillColor(173, 205, 243); //color de fondo de las celdas
    $this->SetTextColor(0);
    $this->SetDrawColor(1, 1, 1); // color de linea
    $this->SetLineWidth(.2);    // ancho de linea
    $this->SetFont('','B');     // negrita
    $w=array(25,40,40,40);   // en este arreglo definiremos el ancho de cada columna

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
  //celda(ancho,alto,salto de linea,border,alineacion,relleno)
        $this->Cell($w[0],8,$columna[0],'LR',0,'C',$fill); //celda(ancho,alto,salto de linea,border,alineacion,relleno)
        $this->Cell($w[1],8,$columna[1],'LR',0,'C',$fill);
        $this->Cell($w[2],8,$columna[2],'LR',0,'C',$fill);
        $this->Cell($w[3],8,$columna[3],'LR',0,'C',$fill);
        $this->Ln();
        $fill=!$fill; //se alterna el valor del boolean $fill para cambiar relleno
    }
    $this->Cell(array_sum($w),0,'','T');

    }

function Header()
    {
        $this->Image('img/logo.jpg',20,15,180,15);
        $this->Ln(30);
        $this->SetFont('Arial','B','10');

    }   
function Footer() {     //Go to 1.5 cm from bottom     $this->SetY(-15);   
     $this->SetFont('Arial','I',8);      
     $this->Image('img/Imagen.jpg',20,250,180,10);//Izquierda a derecha, posicion, Ancho, Alto; 

     
     }
}
$pdf = new PDF("P","mm","letter");
 
$pdf->AliasNbPages(); //funcion que calcula el numero de paginas
$head = array("ID", "Departamento","Division","Encargado"); // cabecera
$i=0;
while ($fila=pg_fetch_array($act1)){  //llenar variable dat con los campos de una fila unidos por ;
    $dat[$i]=$fila[0].";".($fila[1]).";".$fila[2].";".$fila[3]; //concatenar para luego ser separado por explode()
    $i++;


$head1 = [
   utf8_decode("Cédula"),
    "Nombre y Apellido",
   utf8_decode("Departamento"),
    utf8_decode("Encargado")
];

$dat1=[
    implode(';',[
        $_USER['cedula'],
        $_USER['nombrec'],
        $_USER['departamento'],
        $_USER['encargado']
    ])
];
}

$pdf->AddPage(); //crear documento
//$pdf->Image('logo.jpg',180,10,15,15); //añadir imagen
$pdf->Ln(0);
$pdf->Cell(40);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,1,utf8_decode('REPORTES DE DEPARTAMENTOS ASIGNADOS A LA DIVISIÓN'),0,1,'C');//0 para misma linea, 1 para salto de linea
$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(180,1,"Cumana, ".date('d \d\e M \d\e\l Y'),0,1,'R');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
        
        $pdf->Ln(5);
        $pdf->Cell(180,10,utf8_decode('HISTORIAL DE DEPARTAMENTOS ASIGNADOS A LA DIVISIÓN'),0,1,'C');
        $pdf->SetFont('Arial','B','10');
      //  $pdf->Image('img/dep.jpg',120,70,70,20);//derecha, arriba, ancho, largo
        
$pdf->Ln(12);//salto de linea
$pdf->SetFont('Arial','B','10');
$pdf->Cell(40,8,utf8_decode('DEPARTAMENTOS REGISTRDOS EN LA INSTITUCIÓN: ',0,1,'J'));
$pdf->Ln(12);//salto de linea
$pdf->SetFont('Arial','B','10');
$pdf->Cell(40,8,'LISTADO GENERAL DE DEPARTAMENTOS: ',0,1,'J');
//$pdf->Ln(12); 
$pdf->tabla($head,$dat);
$pdf->Ln(7);
$pdf->SetFont('Arial','B','10');
$pdf->Cell(40,8,utf8_decode('División: '),0,1,'J');
$pdf->tabla1($head1,$dat1);
$pdf->Ln(7); 
$pdf->Output(null,null,true); //el resto es historia

?>