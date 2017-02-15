<?php
include ("interfaces.php");
error_reporting(0);
$conexion = "port=5432 host=localhost  dbname=postgres user= postgres password=12345";
 $cnx = pg_connect($conexion) or die ("<h1>Error de conexion.</h1> ". pg_last_error());
	header("Content-type: application/json");
if(isset($_POST["username"]) && isset($_POST["password"]))
{
 $usuario = pg_escape_string($_POST["username"]);
 $password = $_POST["password"];
 $result = pg_query('SELECT cedula,nombre_apellido as name,username,contrasena as key, tel, correo,to_char(fecha_nacimiento, \'dd-mm-YYYY\') as date, admin,tipo as type FROM usuario  WHERE USERNAME=\''.$usuario.'\'');
 if($row = pg_fetch_assoc($result)){
  if($row["key"] == md5($password)){
    $usersoap=invocarSoap(preg_replace("/^[E|V].-/", '', $row["cedula"]));
    if($usersoap){
      $row["sex"]=$usersoap["sex_str"];
      $row["status"]=$usersoap["status_str"];
      $row["mention"]=$usersoap["additional"];
      $row["image"]=$usersoap["profile_image_url"];
    }
  	echo json_encode($row);
  }else{
  	header("HTTP/1.0 406 Error de validación");
   echo json_encode(Array("error"=>45,"descripcion"=>"Contraseña erronea"));
  }
 }else{
  header("HTTP/1.0 406 Error de validación");
   echo json_encode(Array("error"=>46,"descripcion"=>"Lo sentimos el usuario no existe"));
 }
 pg_free_result($result);
}else{
 header("HTTP/1.0 406 Error de validación");
   echo json_encode(Array("error"=>45,"descripcion"=>"Ingrese su nombre de usuario y contraseña"));
}
pg_close();
?>
