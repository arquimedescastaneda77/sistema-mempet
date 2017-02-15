<?php

//error_reporting(0);
// NOMBRE DE LA BASE DE DATOS
$conexion = "port=5432 host=localhost  dbname=rrhh user= postgres password=1234";
$cnx = pg_connect($conexion) or die ("<h1>Error de conexion.</h1> ". pg_last_error());

pg_set_client_encoding($cnx,"unicode");

$SQL="SELECT tbl_persona.cedula,tbl_persona.nombrec,tipo, motivo, fecha_ini, fecha_cul from tbl_permisos INNER JOIN tbl_persona ON tbl_persona.cedula=tbl_permisos.cedula";
if(isset($_REQUEST["fecha_ini"])){
        $date1=pg_escape_string($_REQUEST["fecha_ini"]);
        $SQL.=" WHERE (DATE(fecha_ini)>=DATE('{$date1}')";
        if(isset($_REQUEST["fecha_cul"])){
            if(!empty(trim($_REQUEST["fecha_cul"]))){
                $date2=pg_escape_string($_REQUEST["fecha_cul"]);
                $SQL.=" AND DATE(fecha_cul)<=DATE('{$date2}')";               
            }
        }
        $SQL.=")";
}
$act = pg_query($SQL);
//var_dump($SQL);
//$act = pg_query("SELECT  id_permiso,  from tbl_permisos ORDER BY cedula");

require_once('../fpdf.php'); //incluimos la libreria.

class PDF extends FPDF {

    function tabla($header,$data)
    {

    $this->SetFillColor(173, 205, 243); //color de fondo de las celdas
    $this->SetTextColor(0);
    $this->SetDrawColor(1, 1, 1); // color de linea
    $this->SetLineWidth(.2);    // ancho de linea
    $this->SetFont('','B');     // negrita
    $w1=array(35,45,40,40,45,50);   // en este arreglo definiremos el ancho de cada columna

    $i=0;
    $dat=[];
  
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
            $columna = explode(";",$row);  //separar los datos en posiciones de arreglo
  //celda(ancho,alto,salto de linea,border,alineacion,relleno)
        $this->Cell($w1[0],8,$columna[0],'LR',0,'C',$fill); //celda(ancho,alto,salto de linea,border,alineacion,relleno)
        $this->Cell($w1[1],8,$columna[1],'LR',0,'C',$fill);
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
        $this->Image('../img/logo.png',20,15,180,15);
        $this->Ln(30);
        $this->SetFont('Arial','B','8');
    }   
function Footer() {     //Go to 1.5 cm from bottom     $this->SetY(-15);   
     $this->SetFont('Arial','I',8);      
     $this->Image('../img/imagen.jpg',20,250,180,10);//Izquierda a derecha, posicion, Ancho, Alto;

     
     }
}

$pdf = new PDF("L","mm","letter");

$pdf->AliasNbPages(); //funcion que calcula el numero de paginas
$head = array(utf8_decode("Cédula"),"Nombre","Tipo de Permiso","Motivo del Permiso","F. de Inicio",utf8_decode("F. de Culminación")); // cabecera

$dat=[];

while ($fila=pg_fetch_array($act)){  //llenar variable dat con los campos de una fila unidos por ;
 $dat[]=$fila[0].";".($fila[1]).";".($fila[2].";".$fila[3].";".$fila[4].";".$fila[5]); //concatenar para luego ser separado por explode()
}

$pdf->AddPage(); //crear documento
//$pdf->Image('logo.jpg',180,10,15,15); //añadir imagen
$pdf->Ln(0);
$pdf->Cell(40);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,1,'REPORTES DE SOLICITUDES DE PERMISOS',0,1,'L');//0 para misma linea, 1 para salto de linea
$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(200,1,utf8_decode("Cumaná, ").date('d \d\e M \d\e\l Y'),0,1,'R');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
        
        $pdf->Ln(5);
        $pdf->Cell(180,10,'INFORME DE PERMISOS SOLICITADOS',0,1,'C');
        $pdf->SetFont('Arial','B','10');
      //  $pdf->Image('img/carpeta.png',150,60,35,35);//derecha, arriba, ancho, largo

        
$pdf->Ln(12);//salto de linea
if(count($dat)>0){
$pdf->SetFont('Arial','B','10');
$pdf->Cell(40,8,'LISTADO GENERAL DE PERMISOS: ',0,1,'J');
$pdf->tabla($head,$dat);
}
  else {
        
$pdf->SetFont('Arial','B','14');
$pdf->Cell(200,8,'NO HAN REALIZADO PERMISOS EN ESE LAPSO DE TIEMPO',0,1,'C');
    }

$pdf->Ln(7); 
//$pdf->tabla1($head1,$dat1); 
$pdf->Output(null,null,true); //el resto es historia

?>


if(se_hizo){
 ejecutar_FPDF();
}else{
?>
<script type="text/javascript">
alert('falló!');
</script>
<?php
}