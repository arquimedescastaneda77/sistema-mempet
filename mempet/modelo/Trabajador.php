<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . "/mempet/control/Constants.php";
    include_once ROOT . '/conexion/conexion.php';

    class Trabajador {

        const TABLA = 'tbl_trabajador';
        const TABLA2 = 'tbl_persona';


        private $conexion;
        private $id;
        private $cedula;
        private $nombret;
        private $ficha;
        private $nomina;
        private $departamento;
        private $cargo;
        private $tlf_p;
        private $email;
        private $grado;
        private $carrera;
        private $ingreso;
        private $status;
        private $usuario;

        public function __construct($cedula, $nomina, $cargo, $grado, $status, $ingreso, $nombret, $ficha, $tlf_p, $email, $carrera, $departamento) {
            $this->id = null;
            $this->cedula = $cedula;
            $this->nombret = $nombret;
            $this->ficha = $ficha;
            $this->nomina = $nomina;
            $this->departamento = $departamento;
            $this->cargo = $cargo;
            $this->tlf_p = $tlf_p;
            $this->email= $email;
            $this->grado = $grado;
            $this->carrera = $carrera;
            $this->ingreso = $ingreso;
            $this->status = $status;
            $this->conexion = new Conexion();
        }
//get se encarga de atrapar el dato
        public function getId() {
            return $this->id;
        }

        public function getCedula() {
            return $this->cedula;
        }

         public function getNombret() {
            return $this->nombret;
        }

        public function getFicha() {
            return $this->ficha;
        }

        public function getNomina() {
            return $this->nomina;
        }

        public function getDepartamento() {
            return $this->departamento;
        }

        public function getCargo() {
            return $this->cargo;
        }

        public function getTlf_p() {
            return $this->tlf_p;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getGrado() {
            return $this->grado;
        }

        public function getCarrera() {
            return $this->carrera;
        }

        public function getIngreso() {
            return $this->ingreso;
        }

        public function getStatus() {
            return $this->status;
        }

        //set es para  reiniciar datos
        public function setId($id) {
            $this->id = $id;
        }

        public function setCedula($cedula) {
            $this->cedula = $cedula;
        }
        public function setNombret($nombret) {
            $this->nombret = $nombret;
        }
        public function setFicha($ficha) {
            $this->ficha = $ficha;
        }

        public function setNomina($nomina) {
            $this->nomina = $nomina;
        }

        public function setDepartamento($departamento) {
            $this->departamento = $departamento;
        }

        public function setCargo($cargo) {
            $this->cargo = $cargo;
        }

        public function setTlf_p($tlf_p) {
            $this->tlf_p = $tlf_p;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setGrado($grado) {
            $this->grado = $grado;
        }

        public function setCarrera($carrera) {
            $this->carrera = $carrera;
        }

         public function setIngreso($ingreso) {
            $this->ingreso = $ingreso;
        }

        public function setStatus($status) {
            $this->status = $status;
        }

        //------- registro
        public final function guardar($columnas) {
            $campos = "'$this->cedula','$this->nomina','$this->cargo','$this->grado','$this->status','$this->ingreso','$this->nombret','$this->ficha','$this->tlf_p','$this->email','$this->carrera','$this->departamento'";
            $rt = null;
            
            //$query_nom = $this->conexion->getConexion()->prepare("SELECT nombret nombre FROM ".self::TABLA2." WHERE cedula = ".$this->ced_trabajador." " );

            $sentencia = $this->conexion->getConexion()->prepare("SELECT cedula FROM ".self::TABLA2." WHERE cedula = ".$this->cedula." ");
            $rt_2 = $sentencia->execute();
            $cant = $sentencia->fetchAll(PDO::FETCH_OBJ); 
           
           if(count($cant) > 0) 
            {
                try {
                    $query = $this->conexion->getConexion()->prepare("INSERT INTO ".self::TABLA." (".$columnas.") VALUES (".$campos.")" );
                    $rt = $query->execute();
                    $this->conexion->cerrarConexion();
                }
                catch(PDOException $e) {
                    error_log($e->getMessage());
                    return null;
                }
                return $rt;
            }
            else
            {
                return false;
            }
        }

        public function editar(){
            $campos = "nombret='$this->nombret', ficha='$this->ficha', departamento='$this->departamento', nomina='$this->nomina', cargo='$this->cargo', tlf_p='$this->tlf_p', email='$this->email', grado='$this->grado', especialidad='$this->carrera', ingreso='$this->ingreso', status='$this->status'";
            $rt = null;
            try {
                $query = $this->conexion->getConexion()->prepare("UPDATE " .self::TABLA. " SET " . $campos . " where cedula = " . $this->cedula);
                $rt = $query->execute();
                $this->conexion->cerrarConexion();
                return $rt;
            }
            catch(PDOException $e) {
                error_log($e->getMessage());
                return null;
            }
                        
        }
        public static function listar() {
            $conexion = new Conexion();
            try {
                $query = $conexion->getConexion()->prepare("SELECT * FROM ".self::TABLA);
                $query->execute();
                $rt = $query->fetchAll(PDO::FETCH_OBJ);
                $conexion->cerrarConexion();
                return $rt;
            }
            catch(PDOException $e) {
                return null;
            }
        }

        public static function buscar($id) {
            $conexion = new Conexion();
            try {
                $query = $conexion->getConexion()->prepare("SELECT * FROM ".self::TABLA." WHERE id = $id");
                $query->execute();
                $rt = $query->fetchAll(PDO::FETCH_OBJ);
                $conexion->cerrarConexion();
                return $rt;
            }
            catch(PDOException $e) {
                return null;
            }
        }

        public static function searchersCid($cedula) {
            $conexion = new Conexion();
            try {
                $query = $conexion->getConexion()->prepare("SELECT * FROM ".self::TABLA." WHERE cedula=".$cedula);
                $query->execute();
                $rt = $query->fetchAll(PDO::FETCH_OBJ);
                $conexion->cerrarConexion();
                return $rt;
            }
            catch(PDOException $e) {
                return 0;
            }
        }

         public static function searchersCid2($cedula) {
            $conexion = new Conexion();
            try {
                $query = $conexion->getConexion()->prepare("SELECT * FROM ".self::TABLA2." WHERE cedula=".$cedula);
                $query->execute();
                $rt = $query->fetchAll(PDO::FETCH_OBJ);
                $conexion->cerrarConexion();
                return $rt;
            }
            catch(PDOException $e) {
                return 0;
            }
        }

    }
?>