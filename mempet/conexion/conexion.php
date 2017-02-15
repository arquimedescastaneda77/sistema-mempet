<?php
/**
*
* @Constantes del Manejador para estrablecer conexion a la Base de datos utilizando PDO.
*
* @access private
*
**/

	define("SRV", "localhost");
	define("USR", "postgres");
	define("PAS", "1234");
	define("BDA", "rrhh");
	define("PRT", "5432");

	class Conexion extends PDO {

		public $srv = SRV; // PostgreSQL server host
		public $usr = USR; // PostgreSQL user
		public $pas = PAS; // PostgreSQL password
		public $dba = BDA; // PostgreSQL database
		private $prt = PRT; // PostgreSQL port
		private $numrows= null;
		private $conexion;
		private $manejador;

		public function __construct() {
			$this->conectar();
		}

		/**
		*
		* @todo Establece la conexión a la Base de datos utilizando PDO.
		*
		* @access private
		*
		**/

		private final function conectar() {
			$conex = null;
			try {
				if(is_array(PDO::getAvailableDrivers())) {
					if(in_array("pgsql",PDO::getAvailableDrivers())) {
						$conex = new PDO("pgsql:host = $this->srv;port= $this->prt;dbname= $this->dba;user= $this->usr;password= $this->pas");
						$this->setManejador('pgsql');
					}
					else
						throw new PDOException ("No se puede trabajar sin establecer una conexión adecuada con la base de datos de PostgreSQL");
				}
			}
			catch(PDOException $e){
				echo 'Error al conectarse con la base de datos: ' . $e->getMessage();
				exit;
			}
			$this->setConexion($conex);
		}

		private function setManejador($manejador){
			$this->manejador = $manejador;
		}

		public function setConexion($conex) {
			$this->conexion = $conex;
		}

		public function getConexion() {
			return $this->conexion;
		}

		public function cerrarConexion(){
			$this->setConexion(null);
		}

	}
