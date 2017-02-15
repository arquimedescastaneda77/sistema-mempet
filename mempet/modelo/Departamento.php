<?php
 include_once $_SERVER['DOCUMENT_ROOT'] . "/mempet/consultas/control/Constants.php";
 include_once ROOT . '/conexion/conexion.php';

    class Departamento {

        const TABLA = 'tbl_departamento';
        private $conexion;
        private $departamento;
        private $division;
        private $encargado;
        private $usuario;


        public function __construct($departamento, $division, $encargado, $usuario=null, $id=null) {
            $this->departamento = $departamento;
            $this->division = $division;
            $this->encargado = $encargado;
            $this->usuario = $usuario;
            $this->conexion = new Conexion();
        }
/*id serial NOT NULL,
  departamento integer NOT NULL DEFAULT nextval('tbl_departamento_id_departamento_seq'::regclass),
  division character varying(20) NOT NULL,
  encargado character varying(20) NOT NULL,
  usuario character varying(30),
*/


        public function getDepartamento() {
            return $this->departamento;
        }

        public function getDivision() {
            return $this->division;
        }

        public function getEncargado() {
            return $this->encargado;
        }

        public function getUsuario() {
            return $this->usuario;
        }


        public function setDepartamento($departamento) {
            $this->departamento = $departamento;
        }

        public function setDivision($division) {
            $this->division = $division;
        }

         public function setEncargado($encargado) {
            $this->encargado = $encargado;
        }

         public function setUsuario($usuario) {
            $this->usuario = $usuario;
        }

        //------- registro
        public final function guardar($columnas) {
            $campos = "'$this->departamento', '$this->division', '$this->encargado'";
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
             $campos = "departamento='$this->departamento', division='$this->division', encargado='$this->encargado'";
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