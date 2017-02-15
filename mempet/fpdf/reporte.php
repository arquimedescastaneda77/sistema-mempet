<?php

error_reporting(0);
// NOMBRE DE LA BASE DE DATOS
$conexion = "port=5432 host=localhost  dbname=postgres user= postgres password=12345";
$cnx = pg_connect($conexion) or die ("<h1>Error de conexion.</h1> ". pg_last_error());

pg_set_client_encoding($cnx,"unicode");
//$act = pg_query("SELECT nombre, fecha_programacion, cod FROM actividades");
//$act1= pg_query("SELECT alumno_ci,nombre_apellido,nota FROM notas,usuario");
$cod='';
if(isset($_REQUEST["name_act"])){
    $cod=pg_escape_string($_REQUEST["name_act"]);
}
$act = pg_query("SELECT nombre, fecha_programacion FROM actividades WHERE cod= '".$cod."'");

$act1= pg_query("SELECT alumno_ci,nombre_apellido,nota FROM notas,usuario,actividades WHERE actividades.cod='".$cod."' AND actividad_cod=actividades.cod AND alumno_ci=cedula ");

/*
//actividades
cod |       nombre       |       descripcion        | fecha_programacion  | profesor_ci

//notas
cod | nota |                            video                            |     fecha_publicacion      | actividad_cod |  alumno_ci

//usuario
 cedula    | nombre_apellido | username |            contrasena            |     tel     |         correo          | fecha_nacimiento | admin |   tipo
*/


//var formRep = new FormData(); //creo un objeto formData


//formRep.append("name_act", document.querySelector("aquiLaBusqueda").innerHTML;);
//var request = new XMLHttpRequest(); //creo un nuevo XMLHttpRequet

//request.open("POST", "reporte.php"); //Abro una solicitud por POST al archivo php

//request.send(formRep);


//$sql= pg_query('SELECT alumno_ci,nombre_apellido,nota FROM  usuarion, nota WHERE nombre_actividad=".$variable" and cod=actividad_cod');


require_once('fpdf.php'); //incluimos la libreria.

class PDF extends FPDF {

    function tabla($header,$data)
    {
        $this->SetFillColor(255);
    $this->SetTextColor(0);
    $this->SetDrawColor(250);     // color de linea
    $this->SetLineWidth(.2);    // ancho de linea
    $this->SetFont('','B');     // negrita
    $w1=array(60,60);   // en este arreglo definiremos el ancho de cada columna
    for($i=0;$i<count($header);$i++)
    $this->Cell($w1[$i],6,$header[$i],1,0,'L',1); //por cada encabezado existente, crea una celda
    $this->Ln();
    //Colores, ancho de línea y fuente en negrita de CONTENIDO
    $this->SetFillColor(255); //
    $this->SetTextColor(0);
    $this->SetFont('');
    //Datos
    $fill=false; // variable para alternar relleno
    foreach($data as $row)
 {
  $columna = explode(";",$row); //separar los datos en posiciones de arreglo
        $this->Cell($w1[0],7,$columna[0],'LR',0,'L',$fill); //celda(ancho,alto,salto de linea,border,alineacion,relleno)
        $this->Cell($w1[1],6,$columna[1],'LR',0,'L',$fill);
  
        $this->Ln();
        $fill=!$fill; //se alterna el valor del boolean $fill para cambiar relleno
    }
    $this->Cell(array_sum($w1),0,'','T');

    }

    
function tabla1($header,$data)
{
    //Colores, ancho de línea y fuente en negrita de CABECERA
    $this->SetFillColor(255);   // fondo de celda
    $this->SetTextColor(0);     // color del texto
    $this->SetDrawColor(255);     // color de linea
    $this->SetLineWidth(.3);    // ancho de linea
    $this->SetFont('','B');     // negrita
    $w=array(50,100,30);   // en este arreglo definiremos el ancho de cada columna
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],6,$header[$i],1,0,'C',1); //por cada encabezado existente, crea una celda
    $this->Ln();
    //Colores, ancho de línea y fuente en negrita de CONTENIDO
    $this->SetFillColor(255); //
    $this->SetTextColor(0);
    $this->SetFont('');
    //Datos
    $fill=false; // variable para alternar relleno
    foreach($data as $row)
    {
  $columna = explode(";",$row); //separar los datos en posiciones de arreglo
        $this->Cell($w[0],7,$columna[0],'LR',0,'C',$fill); //celda(ancho,alto,salto de linea,border,alineacion,relleno)
        $this->Cell($w[1],6,$columna[1],'LR',0,'C',$fill);
        $this->Cell($w[2],6,$columna[2],'LR',0,'C',$fill);
        $this->Ln();
        $fill=!$fill; //se alterna el valor del boolean $fill para cambiar relleno
    }
    $this->Cell(array_sum($w),0,'','T');
}

function Footer()
{
    //Pie de página
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $this->SetTextColor(128);
    $this->Cell(0,10,'Universidad Politecnica Territorial del Oeste de Sucre "Clodosbaldo Russián", Km.4 Carretera Cumana '.$this->PageNo().' de {nb}',0,0,'C'); // el parametro {nb} es generado por una funcion llamada AliasNbPages
}
}
$pdf = new PDF(); 
$pdf->AliasNbPages(); //funcion que calcula el numero de paginas
$head = array("Nombre","Fecha y Hora Realizada"); // cabecera
$i=0;
while ($fila=pg_fetch_array($act)){  //llenar variable dat con los campos de una fila unidos por ;
    $dat[$i]=$fila[0].";".($fila[1]); //concatenar para luego ser separado por explode()
    $i++;

}

$head1 = array("Cedula","Nombre y Apellido","Nota"); // cabecera
$i=0;
while ($fila=pg_fetch_array($act1)){  //llenar variable dat con los campos de una fila unidos por ;
    $dat1[$i]=$fila[0].";".($fila[1]).";".$fila[2]; //concatenar para luego ser separado por explode()
    $i++;
}
$pdf->AddPage(); //crear documento
$pdf->Image('logo.jpg',180,10,15,15); //añadir imagen
$pdf->Cell(40);
$pdf->SetFont('Arial','',24);
$pdf->Cell(100,25,"Reporte de Actividad",0,0,'C');
$pdf->Ln(35);
$pdf->SetFont('Arial','',12);
$pdf->Cell(50,1,"Fecha: ".date("j-m-y"),0,0,'L');
$pdf->Ln(10);
$pdf->tabla($head,$dat);
$pdf->Ln(7); 
$pdf->tabla1($head1,$dat1); 
$pdf->Output(null,null,true); //el resto es historia

?>