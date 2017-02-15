<?php 
session_start(); 
require('fpdf.php'); 
include("../conexion/conexion.php");  
     
class PDF extends FPDF 
{ 
  //Cabecera de página 
    function Header() 
    { 
        
       $this->Rect(1,1,213,31); 
       $this->Rect(1,31,213,1,'DF'); 
        //Logo 
        $this->Image('logo.jpg',13,2,25,27); 
        //Arial bold 15 
        $this->SetFont('Arial','B',14); 
        //Movernos a la derecha 
        $this->Cell(30); 
        //Título 
        $this->Cell(170,4,'Reporte del Personal',0,0,'C'); 
        $this->Ln(9); 
        $this->SetFont('Arial','B',10); 
        $this->Cell(36); 
        $this->MultiCell(170,5,'Algun mensaje:'); 
        //$this->SetFont('Arial','',6); 
     
        $this->SetFont('Arial','',8); 
        $this->Line(1,32,214,32); 
         
        $this->Text(15,36,'Cedula'); 
        $this->Text(30,36,'Nombre'); 
        $this->Text(55,36,'Sexo'); 
        $this->Text(100,36,'Nacionalidad'); 
        $this->Text(180,36,'Usuario'); 
         
        $this->Line(1,38,214,38); 
        $this->Line(1,39,214,39); 
        //Salto de línea 
        $this->Ln(10); 
        $this->SetY(45); 
    } 

    //Pie de página 
    function Footer() 
    { 
       
      //Posición: a 1,5 cm del final 
        $this->SetY(-15); 
        //Arial italic 8 
        $this->SetFont('Arial','I',8); 
        //Número de página 
        $this->Cell(0,10,'Ministerio del Poder Popular de Petroleo y Mineria División Regional Cumaná '.$this->PageNo().'/{nb}',0,0,'C'); 
      $fecha= date("Y-m-d"); 
       $hora=date("H:i:s"); 
      $this->Line(1,266,214,266); 
      $this->Line(1,273,214,273); 
      $fecha= date("Y-m-d"); 
       $hora=date("H:i:s"); 
       $this->Text(10,270.5,$fecha); 
        $this->Text(30,270.5,$hora); 
        $this->Text(148,270.5,$this->f_ini); 
        $this->Text(180,270.5,$this->f_fin); 
    } 

    function __construct() 
    {        
        //Llama al constructor de su clase Padre. 
        //Modificar aka segun la forma del papel del reporte 
        parent::__construct('P','mm','Letter'); 
    } 
} 

    //Creación del objeto de la clase heredada 
    $pdf=new PDF(); 
    $pdf->SetTopMargin(5.4); 
    $pdf->SetLeftMargin(4.5);     
    $pdf->AliasNbPages(); 
    $pdf->SetFont('Times','',9); 
 /*   $fecha_ini =$_POST['fecha_ini'] ." ". $_POST['hora_ini']; 
    $pdf->f_ini= $fecha_ini; 
    $fecha_fin =$_POST['fecha_fin'] ." ". $_POST['hora_fin']; 
    $pdf->f_fin=$fecha_fin; */

      
    //Creación del objeto de la clase heredada 
    $pdf=new PDF(); 
    $pdf->SetTopMargin(5.4); 
    $pdf->SetLeftMargin(4.5);     
    $pdf->AliasNbPages(); 
    $pdf->SetFont('Times','',7); 


$cadconex="dbname=rrhh host=localhost port=5432 user=postgres password=1234"; 
$conexion = pg_connect($cadconex); 
  
        $cadbusca = "select nombrec, cedula, sexo, nacionalidad, usuario from persona"; 
        $result=pg_query($cadbusca) or die('La consulta fallo: ' . pg_last_error()); 

        $j=1; 
    $pdf->AddPage();     
         
         while($row = pg_fetch_array($result)) 
        { 
          $name = $row["nombrec"];             
          $cedula = $row["cedula"]; 
          $sexo = $row["sexo"]; 
          $nacionalidad = $row["nacionalidad"]; 
          $usuario = $row["usuario"]; 

          $pdf->Text(12,$pdf->GetY(),($j)); 
          $pdf->Text(22,$pdf->GetY(),$name); 
          $pdf->Text(40,$pdf->GetY(),$cedula); 
          $pdf->Text(80,$pdf->GetY(),$sexo); 
          $pdf->Text(120,$pdf->GetY(),$nacionalidad);
          $pdf->Text(120,$pdf->GetY(),$usuario); 
 
          $pdf->cell(0,5.5,'',0,1); 
        $j=$j+1; 
        } 
           $pdf->cell(0,8,'',0,1); 
                 $pdf->Text(30,$pdf->GetY(),'Nombre'); 
           $pdf->Text(115,$pdf->GetY(),'Fecha'); 
           $pdf->Text(160,$pdf->GetY(),'Firma'); 
           $pdf->cell(0,5,'',0,1); 
           $pdf->Text(15,$pdf->GetY(),'_________________________________________'); 
           $pdf->Text(100,$pdf->GetY(),'________________________'); 
           $pdf->Text(145,$pdf->GetY(),'________________________'); 
    $pdf->Output();     
?>