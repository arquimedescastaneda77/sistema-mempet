<?php
 
include_once('fpdf/fpdf.php');
class PDF extends FPDF
{
 
// Una tabla más completa
function ImprovedTable($header, $data)
{
    // Anchuras de las columnas
    $w = array(50,40,45,52);
    // Cabeceras
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Datos
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR');
        $this->Cell($w[1],6,$row[1],'LR');
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
        $this->Ln();
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
}
}
 
 
$pdf = new PDF();
$pdf->Open();
$pdf->AddPage();
 
$pdf->Image('logo.jpg',5,5,200);
 
 
$pdf->ln(15);
$pdf->SetFont('Arial','',15);
$pdf->Cell(45,15,'Fecha:'.' '.date("d/m/Y"),0,1,'C');
$pdf->Cell(36,0,'Hora:'.' '.date("H:i:s"),0,1,'C');
 
$pdf->ln(5);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(190,15,'Reporte de Solicitudes de Permisos',0,1,'C');
 
 
$pdf->SetFont('Arial','',14);
$header = array('Cedula', 'Nombre', 'Sexo', 'Usuario');
$pdf->ImprovedTable($header, $datas);
$pdf->ln();
 
$pdf->SetFont('Arial','B',14);
 
$cadconex="dbname=rrhh host=localhost port=5432 user=postgres password=1234";
$conexion = pg_connect($cadconex);
 
$sql="select nombrec, cedula, sexo, usuario from persona";
 
$r=pg_query($conexion,$sql);
 
for ($i=1;$i<=51;$i++){
 
 while ($datos = pg_fetch_array($r)) {
      $datas= array($datos[""],$datos["nombrec"]." ".$datos["cedula"], $datos["sexo"],$datos["usuario"]); 
        
    }
    
}
 
$pdf->ImprovedTable($datas);
 
 
$pdf->Image('img/pie_pag1.png',30,260,150,30);
$pdf->Output();
?>
 
