<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/mempet/consultas/control/Constants.php";
include_once ROOT . '/conexion/conexion.php';

    class Capacitacion {

        const TABLA = 'tbl_capacitacion';
        private $conexion;
        private $cedula;
        private $modalidad;
        private $titulo;
        private $lugar;
        private $beneficio;
        private $postulacion;
        private $duracion;
        private $usuario;


        public function __construct($cedula, $modalidad, $titulo, $lugar, $beneficio, $postulacion, $duracion, $usuario=null, $id=null) {
            $this->cedula = $cedula;
            $this->modalidad = $modalidad;
            $this->titulo = $titulo;
            $this->lugar = $lugar;
            $this->beneficio = $beneficio;
            $this->postulacion = $postulacion;
            $this->duracion = $duracion;
            $this->usuario = $usuario;
            $this->conexion = new Conexion();
        }


        public function getCedula() {
            return $this->cedula;
        }

        public function getModalidad() {
            return $this->modalidad;
        }

        public function getTitulo() {
            return $this->titulo;
        }

        public function getLugar() {
            return $this->lugar;
        }

        public function getBeneficio() {
            return $this->beneficio;
        }

        public function getPostulacion() {
            return $this->postulacion;
        }

        public function getDuracion() {
            return $this->duracion;
        }

        public function getUsuario() {
            return $this->usuario;
        }


        public function setCedula($cedula) {
            $this->cedula = $cedula;
        }

        public function setModalidad($modalidad) {
            $this->modalidad = $modalidad;
        }

         public function setTitulo($titulo) {
            $this->titulo = $titulo;
        }

         public function setLugar($lugar) {
            $this->lugar = $lugar;
        }

         public function setBeneficio($beneficio) {
            $this->beneficio = $beneficio;
        }

         public function setPostulacion($postulacion) {
            $this->postulacion = $postulacion;
        }
         public function setDuracion($duracion) {
            $this->duracion = $duracion;
        }

         public function setUsuario($usuario) {
            $this->usuario = $usuario;
        }

        //------- registro
        public final function guardar($columnas) {
            $campos = "'$this->cedula', '$this->modalidad', '$this->titulo', '$this->lugar', '$this->beneficio', '$this->postulacion', '$this->duracion'";
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
            $campos = "cedula='$this->cedula', modalidad='$this->modalidad', titulo='$this->titulo', lugar='$this->lugar', beneficio='$this->beneficio', postulacion='$this->postulacion', duracion='$this->duracion'";
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