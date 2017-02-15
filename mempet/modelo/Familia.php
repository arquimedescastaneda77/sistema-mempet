<?php
   include_once $_SERVER['DOCUMENT_ROOT'] . "/mempet/control/Constants.php";
   include_once ROOT . '/conexion/conexion.php';

    class Familia {

        const TABLA = 'tbl_familiar';
        private $conexion;
        private $cedula;
        private $parentesco;
        private $edad_f;
        private $nacimiento_f;
        private $nombref;
        private $condicion;
        private $usuario;


        public function __construct($cedula, $parentesco, $edad_f, $condicion, $nacimiento_f, $nombref, $ced_trabajador, $usuario=null, $id=null) {
            $this->cedula = $cedula;
            $this->parentesco = $parentesco;
            $this->edad_f = $edad_f;
            $this->nacimiento_f = $nacimiento_f;
            $this->nombref = $nombref;
            $this ->ced_trabajador = $ced_trabajador;
            $this->condicion = $condicion;
            $this->usuario = $usuario;
            $this->conexion = new Conexion();
        }

        public function getId() {
            return $this->id;
        }

        public function getCedula() {
            return $this->cedula;
        }

        public function getParentesco() {
            return $this->parentesco;
        }

        public function getEdad_f() {
            return $this->edad_f;
        }

         public function getNacimiento_f() {
            return $this->nacimiento_f;
        }

         public function getNombref() {
            return $this->nombref;
        }

        public function getCed_trabajador() {
            return $this->ced_trabajador;
        }

        public function getCondicion() {
            return $this->condicion;
        }

        public function getUsuario() {
            return $this->usuario;
        }

        public function setId($id) {
            $this->id = $id;
        }
        
        public function setCedula($cedula) {
            $this->cedula = $cedula;
        }

        public function setParentesco($parentesco) {
            $this->parentesco = $parentesco;
        }

         public function setEdad_f($edad_f) {
            $this->edad_f = $edad_f;
        }

         public function setNacimiento_f() {
            $this->nacimiento_f = $nacimiento_f;
        }

         public function setNombref() {
            $this->nombref = $nombref;
        }

        public function setCed_trabajador() {
            $this->ced_trabajador = $ced_trabajador;
        }

         public function setCondicion($condicion) {
            $this->condicion = $condicion;
        }

        public function setUsuario($usuario) {
            $this->usuario = $usuario;
        }

        //------- registro
        public final function guardar($columnas) {
            $campos = "'$this->cedula', '$this->parentesco', '$this->edad_f', '$this->condicion', '$this->nacimiento_f', '$this->nombref', '$this->ced_trabajador'";
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
            $campos = " parentesco='$this->parentesco', edad_c='$this->edad_f', condicion='$this->condicion', nacimiento_familiar='$this->nacimiento_f', nombref='$this->nombref'";
            $rt = null;
            try {
                $query = $this->conexion->getConexion()->prepare("UPDATE " .self::TABLA. " SET " . $campos . " where ced_trabajador = " . $this->ced_trabajador. "AND cedula = ".$this->cedula);
                $rt = $query->execute();
                $this->conexion->cerrarConexion();
                return $query;
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

        public static function searchersCid1($cedula) {
            $conexion = new Conexion();
            try {
                $query = $conexion->getConexion()->prepare("SELECT * FROM ".self::TABLA." WHERE ced_trabajador=".$cedula);
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

        public static function searchersCid3($cedula_t, $cedula_f) {
            $conexion = new Conexion();
            try {
                $query = $conexion->getConexion()->prepare("SELECT * FROM ".self::TABLA." WHERE cedula=".$cedula_f." AND ced_trabajador= ".$cedula_t );
                $query->execute();
                $rt = $query->fetchAll(PDO::FETCH_OBJ);
                $conexion->cerrarConexion();
                return $rt;
            }
            catch(PDOException $e) {
                return 0;
            }
        }

        public static function listafam($cedula) {
            $conexion = new Conexion();
            try {
                $query = $conexion->getConexion()->prepare("SELECT DISTINCT cedula, nombref FROM ".self::TABLA." WHERE ced_trabajador=".$cedula." ORDER BY cedula");
                $query->execute();
                $rt = $query->fetchAll(PDO::FETCH_OBJ);
                $conexion->cerrarConexion();

                $html = '';     
                $html .= '<option> Elija el familiar </option>';

                for ($i=0; $i < count($rt); $i++){                                        
                        $html .= '<option value="'.$rt[$i]->cedula.'">'  .$rt[$i]->nombref. '</option>';
                }
                //echo $html;
                if( count($rt) > 0 ){
                    $obj=array();
                    $obj['lista_fam']   = $html;
                    $obj["success"]  = true;
                    $obj["length"]   = count($rt);
                   return $obj;
                   // echo json_encode($obj);

                }else{
                    $error=array();
                    $error['success']   = false;
                    $error['message']   = "Informacion no Encontrada";
                    //$error['message']   = $query;
                    //echo json_encode($error);
                    return $error;

                }

                //return $rt;
            }
            catch(PDOException $e) {
                return 0;
            }
        }

    }
?>