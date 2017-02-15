<?php
require('fpdf.php');

	$mesAct = date("m");
 	$diaAct = date("d");
	$anoAct = date ("Y");

	$fecha=$diaAct."/".$mesAct."/".$anoAct;  

$user = "postgres";
$password = "1234";
$dbname = "rrhh";
$port = "5432";
$host = "localhost";

$cadenaConexion = "host=$host port=$port dbname=$dbname user=$user password=$password";

$conexion = pg_connect($cadenaConexion) or die("Error en la Conexión: ".pg_last_error());
//echo "<h3>Conexion Exitosa</h3><hr><br>";

$query = "select cedula, nombrec, sexo, nacimiento, edad, grupo_sanguineo from tbl_persona";

$resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");

$numReg = pg_num_rows($resultado);

class PDF extends FPDF
{
	function Header()
	{
	    $this->Image('img/pdvsa.png',20,15,70,20);
		$this->Ln(15);
		$this->SetFont('Arial','B','10');
		$this->Cell(180,10,'REPORTES DEL PERSONAL INTERNO REGISTRADO',0,1,'L'); //0 para misma linea, 1 para salto de linea
		//$this->Ln(1);
		$this->Cell(180,10,'Cumana, '.$GLOBALS["fecha"].'.',0,1,'L');
	}	

	
	function Footer() {     //Go to 1.5 cm from bottom     $this->SetY(-15);   
     $this->SetFont('Arial','I',8);      
	 $this->Image('img/Imagen1.jpg',20,250,180,20);

	 
	 }
}

$pdf=new PDF("P","mm","letter");

$pdf->SetFont('Arial');
$pdf->SetAutoPageBreak(true,15);
$pdf->SetDrawColor(0,0,0);
$pdf->SetFillColor(999,999,999);
$pdf->SetTextColor(0,0,0);
$pdf->SetMargins(20,20,20);
// $pdf->SetLeftMargin(20);
// $pdf->SetTopMargin(20);
$pdf->SetLineWidth(0.2);


////////////
$pdf->AddPage();
$pdf->SetFont('Arial','B','14');
		
		$pdf->Ln(15);
		$pdf->Cell(180,10,'INFORME DE DATOS PERSONALES',0,1,'C');
		$pdf->SetFont('Arial','B','10');

		
$pdf->Ln(8);
$pdf->SetFont('Arial','B','10');
$pdf->Cell(40,8,'LISTADO GENERAL: ',0,1,'J');
$pdf->Cell(30,8,'CEDULA',1,0,'C');
$pdf->Cell(45,8,'NOMBRE Y APELLIDO',1,0,'C');
$pdf->Cell(20,8,'EDAD',1,0,'C');
$pdf->Cell(25,8,'SEXO',1,0,'C');
$pdf->Cell(50,8,'FECHA DE NACIMIENTO',1,1,'C');

/*
while($row = $numReg)
{
		$pdf->SetFont('Arial','','10');
		$pdf->Cell(40,8,$row['cedula'],1,0,'C');
		$pdf->Cell(50,8,$row['nombrec'],1,0,'C');
		$pdf->Cell(50,8,$row['sexo'],1,0,'C');
		$pdf->Cell(50,8,$row['nacimiento'],1,0,'C');
		$pdf->Cell(50,8,$row['edad'],1,0,'C');
		$pdf->Cell(50,8,$row['grupo_sanguineo'],1,0,'C');	
}*/
	
$pdf->AliasNbPages();
$pdf->Output();


/*if($numReg > 0)

{
    $cedula=pg_result($resultado, $numReg,'cedula');
    $nombrec=pg_result($resultado, $numReg,'nombrec');
    $sexo=pg_result($resultado, $numReg,'sexo');
    $nacimiento=pg_result($resultado, $numReg,'nacimiento');
    $edad=pg_result($resultado, $numReg,'edad');
    $grupo_sanguineo=pg_result($resultado, $numReg,'grupo_sanguineo');

}
else{
                echo "No hay Registros";
}


for($i=0; $i<$numReg;$i++)
*/