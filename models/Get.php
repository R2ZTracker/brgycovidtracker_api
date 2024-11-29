<?php 
	class Get {
		protected $cn;
		protected $errormsg;
		protected $code;

		public $recno;
		public $empno;
		public $emplname;
		public $empfname;
		public $empmname;

		protected $globalMethods;

		public function __construct(\PDO $pdo) {
			$this->globalMethods = new GlobalMethods($pdo);
		}
		

		public function employees() {
			$posts_arr['data'] = array();

			$sql = "SELECT * FROM employee_tbl";
							// prepared statement

			return $this->globalMethods->execute_query($sql, "Unauthorized User");
		}

		public function pid($indata){
			$p_id = $indata->p_id;
			
			$sql = "SELECT p_id FROM patient_info_tbl WHERE p_id='$p_id'";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");

			$remarks = "Success!";
			$message = "OK";

			$payload = $dt;			

			return $this->globalMethods->api_result($payload, $remarks, $message);
		}
	}

?>