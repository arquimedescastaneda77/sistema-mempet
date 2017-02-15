<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/mempet/control/Constants.php";
    include_once ROOT . '/conexion/conexion.php';

    class Usuario {

        const TABLA = 'sesiones';
        const TABLA2 = 'tbl_trabajador';
        private $conexion;
        private $id;
        private $usuario;
        private $password;
        private $email;
        private $tipousuario;

        public function __construct($usuario, $password,  $email, $tipousuario, $ced_trabajador, $id=null ) {
            $this->usuario = $usuario;
            $this->id = $id;
            $this->email = $email;
            $this->tipousuario = $tipousuario;
            $this->password = $password;
            $this->ced_trabajador = $ced_trabajador;
            $this->conexion = new Conexion();
        }

         public function getId() {
            return $this->id;
        }

        public function getUsuario() {
            return $this->usuario;
        }

        public function getPassword() {
            return $this->password;
        }

         public function getCedula() {
            return $this->ced_trabajador;
        }

        public function getEmail() {
            return $this->email;
        }

         public function gettipousuario() {
            return $this->tipousuario;
        }

        public function settipousuario($tipousuario) {
            $this->tipousuario = $tipousuario;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setCedula($ced_trabajador) {
            $this->ced_trabajador = $ced_trabajador;
        }

        public function setUsuario($usuario) {
            $this->usuario = $usuario;
        }

        public function setPassword($password) {
            $this->password = $password;
        }

         public function setEmail($email) {
            $this->email = $email;
        }

        //------- registro
        public final function guardar($columnas) {
                $query_nom = $this->conexion->getConexion()->prepare("SELECT nombret nombre FROM TABLA2 WHERE cedula = ".$this->ced_trabajador." " );
                $rt_nom  = $query_nom->execute();
                $nombret = $query_nom->fetchColumn();

            $campos = "'$this->usuario', '$this->password', '$this->tipousuario', '$this->email', '$this->ced_trabajador' ";
            $rt = null;
            try {
                $query = $this->conexion->getConexion()->prepare("INSERT INTO ".self::TABLA." (".$columnas.", nombre_c) VALUES (".$campos.", '".$nombret."')" );
                $rt = $query->execute();
                $this->conexion->cerrarConexion();
                return $rt;
            }
            catch(PDOException $e) {
                error_log($e->getMessage());
                return null;
            }
            
        }

         public function editar(){
             $campos = "usuario='$this->usuario', email='$this->email', password='$this->password', tipousuario='$this->tipousuario'";
            $rt = null;
            try {
                $query = $this->conexion->getConexion()->prepare("UPDATE " .self::TABLA. " SET " . $campos . " where ced_trabajador = " . $this->ced_trabajador);
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

       public static function searchersCid($ced_trabajador) {
            $conexion = new Conexion();
            try {
                $query = $conexion->getConexion()->prepare("SELECT * FROM sesiones, tbl_trabajador WHERE ced_trabajador=".$ced_trabajador);
                $query->execute();
                $rt = $query->fetchAll(PDO::FETCH_OBJ);
                //$cont = $query->rowCount();               
                $conexion->cerrarConexion();
                return $rt;
                
            }
            catch(PDOException $e) {
                return 0;
            }
        }

       public static function searchersCid2($ced_trabajador) {
            $conexion = new Conexion();
            try {
                $query = $conexion->getConexion()->prepare("SELECT * FROM ".self::TABLA2." WHERE cedula=".$ced_trabajador);
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