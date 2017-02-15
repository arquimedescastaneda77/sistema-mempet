<?php

 include_once $_SERVER['DOCUMENT_ROOT'] . "/mempet/consultas/control/Constants.php";
 include_once ROOT . '/conexion/conexion.php';

    class Permiso {

        const TABLA = 'tbl_permisos';
        private $conexion;
        private $cedula;
        private $tipo;
        private $motivo;
        private $fecha_ini;
        private $fecha_cul;
        private $usuario;


        public function __construct($cedula, $tipo, $motivo, $fecha_ini, $fecha_cul, $usuario=null, $id_permiso=null) {
            $this->cedula = $cedula;
            $this->tipo = $tipo;
            $this->motivo = $motivo;
            $this->fecha_ini = $fecha_ini;
            $this->fecha_cul = $fecha_cul;
            $this->usuario = $usuario;
            $this->conexion = new Conexion();
        }


        public function getCedula() {
            return $this->cedula;
        }

        public function getTipo() {
            return $this->tipo;
        }

        public function getMotivo() {
            return $this->motivo;
        }

        public function getFecha_ini() {
            return $this->fecha_ini;
        }

        public function getFecha_cul() {
            return $this->fecha_cul;
        }

        public function getUsuario() {
            return $this->usuario;
        }


        public function setCedula($cedula) {
            $this->cedula = $cedula;
        }

        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }

         public function setMotivo($motivo) {
            $this->motivo = $motivo;
        }

         public function setFecha_ini($fecha_ini) {
            $this->fecha_ini = $fecha_ini;
        }

         public function setFecha_cul($fecha_cul) {
            $this->fecha_cul = $fecha_cul;
        }

         public function setUsuario($usuario) {
            $this->usuario = $usuario;
        }

        //------- registro
        public final function guardar($columnas) {
            $campos = "'$this->cedula', '$this->tipo', '$this->motivo', '$this->fecha_ini', '$this->fecha_cul'";
            $rt = null;
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

         public function editar(){
            $campos = "cedula='$this->cedula', tipo='$this->tipo', motivo='$this->motivo', fecha_ini='$this->fecha_ini', fecha_cul='$this->fecha_cul'";
            $rt = null;
            try {
                $query = $this->conexion->getConexion()->prepare("UPDATE " .self::TABLA. " SET " . $campos . " where id = " . $this->id);
                $rt = $query->execute();
                $this->conexion->cerrarConexion();
            }
            catch(PDOException $e) {
                error_log($e->getMessage());
                return null;
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

    }
?>