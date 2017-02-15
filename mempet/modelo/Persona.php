<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . "/mempet/control/Constants.php";

    include_once ROOT . '/conexion/conexion.php';

    class Persona {

        const TABLA = 'tbl_persona';

        private $conexion;
        private $id;
        private $nombrec;
        private $cedula;
        private $sexo;
        private $nacimiento;
        private $edad;
        private $est_cvl;
        private $direccion;
        private $nacionalidad;
        private $grupo_sanguineo;
        private $usuario;

        public function __construct($nombrec=null, $cedula=null, $sexo=null, $nacimiento=null, $edad=null, $est_cvl=null, $direccion=null, $nacionalidad=null, $grupo_sanguineo =null, $usuario=null, $id=null) {
            $this->id = $id;
            $this->nombrec = $nombrec;
            $this->cedula = $cedula;
            $this->sexo = $sexo;
            $this->nacimiento = $nacimiento;
            $this->edad = $edad;
            $this->est_cvl = $est_cvl;
            $this->direccion = $direccion;
            $this->nacionalidad = $nacionalidad;
            $this->grupo_sanguineo = $grupo_sanguineo;
            $this->conexion = new Conexion();
        }

        public function getId() {
            return $this->id;
        }

        public function getNombrec() {
            return $this->nombrec;
        }

        public function getCedula() {
            return $this->cedula;
        }

        public function getSexo() {
            return $this->sexo;
        }

        public function getNacimiento() {
            return $this->nacimiento;
        }

        public function getEdad() {
            return $this->edad;
        }

        public function getEst_cvl() {
            return $this->est_cvl;
        }

        public function getDireccion() {
            return $this->direccion;
        }

        public function getNacionalidad() {
            return $this->nacionalidad;
        }

        public function getGrupo_sanguineo() {
            return $this->grupo_sanguineo;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setNombrec($nombrec) {
            $this->nombrec = $nombrec;
        }

        public function setCedula($cedula) {
            $this->cedula = $cedula;
        }

        public function setNacimiento($nacimiento) {
            $this->nacimiento = $nacimiento;
        }

        public function setEdad($edad) {
            $this->edad = $edad;
        }

        public function setSexo($sexo) {
            $this->sexo = $sexo;
        }

        public function setEst_cvl($est_cvl) {
            $this->est_cvl = $est_cvl;
        }

        public function setDireccion($direccion) {
            $this->direccion = $direccion;
        }

        public function setNacionalidad($nacionalidad) {
            $this->nacionalidad = $nacionalidad;
        }

        public function setGrupo_sanguineo($grupo_sanguineo) {
            $this->grupo_sanguineo = $grupo_sanguineo;
        }

        //------- registro
        public final function guardar($columnas) {
            $campos = "'$this->nombrec', '$this->cedula', '$this->sexo', '$this->nacimiento','$this->edad', '$this->est_cvl', '$this->direccion', '$this->nacionalidad', '$this->grupo_sanguineo'";
            $rt = 0;
            try {
                $query = $this->conexion->getConexion()->prepare("INSERT INTO ".self::TABLA." (".$columnas.") VALUES (".$campos.")" );
                $rt = $query->execute();
                $this->conexion->cerrarConexion();
            }
            catch(PDOException $e) {
                error_log($e->getMessage());
                return 0;
            }
            return $rt;
        }

        public function editar(){
            $campos = " nombrec='$this->nombrec', sexo='$this->sexo', nacimiento='$this->nacimiento', edad='$this->edad', est_cvl='$this->est_cvl', direccion='$this->direccion', nacionalidad='$this->nacionalidad', grupo_sanguineo='$this->grupo_sanguineo'";
            $rt = 0;
            try {
                //'nombrec, cedula, sexo, nacimiento, edad, est_cvl, direccion, nacionalidad, grupo_sanguineo'
                $query = $this->conexion->getConexion()->prepare("UPDATE " .self::TABLA. " SET " . $campos . " where cedula = " . $this->cedula);
                $rt = $query->execute();
                $this->conexion->cerrarConexion();
            }
            catch(PDOException $e) {
                error_log($e->getMessage());
                return 0;
            }
            return $rt;
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

        public static function buscar($nombrec) {
            $conexion = new Conexion();
            try {
                $query = $conexion->getConexion()->prepare("SELECT * FROM ".self::TABLA." WHERE nombrec ilike '%$nombrec%'");
                $query->execute();
                $rt = $query->fetchAll(PDO::FETCH_OBJ);
                $conexion->cerrarConexion();
                return $rt;
            }
            catch(PDOException $e) {
                return 0;
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

        public static function searchersId($id) {
            $conexion = new Conexion();
            try {
                $query = $conexion->getConexion()->prepare("SELECT * FROM ".self::TABLA." WHERE id_persona=".$id);
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