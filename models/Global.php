<?php
	class GlobalMethods {
		protected $cn;

		public function __construct(\PDO $pdo) {
			$this->cn = $pdo;
		}
		public function execute_query($sql, $err) {
			$data=array();
			try {
				if($result = $this->cn->query($sql)->fetchAll()) {
					foreach ($result as $record) {
						array_push($data, $record);
					}
					$result = null;
					$this->code = 200;
				} else {
					$this->errmsg = $err;
					$this->code = 401;
				}
			} catch (\PDOException $e) {
				$this->errmsg = $e->getMessage();
				$this->code = 403;
			}
			return $data;
		}
		public function api_result($payload, $remarks, $message) {
			$status = array(
				"remarks" => $remarks,
				"message" => $message
			);

				return array(
					"status"=> $status, 
					"payload"=>$payload, 
					"Prepared by"=> "Team 1SA",
					"timestamp" => date_create()
					 );
		}
	}
?>