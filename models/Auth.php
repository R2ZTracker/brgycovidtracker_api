<?php 
	class Auth {
		// protected $cn;
		protected $errormsg;
		protected $code;
		protected $globalMethods;

		public function __construct(\PDO $pdo) {
			$this->globalMethods = new GlobalMethods($pdo);
		}
		

		public function generateToken() {
			$header = $this->generateHeader();
			$payload = $this->generatePayload("10001","me@test.com", "1", "Ako Ito");

			//signature
			$signature = hash_hmac('sha256', "$header.$payload", base64_encode("secret"));
			$signature = str_replace(['+','/','='], ['-','_', ''],base64_encode(json_encode($signature)));

			$token="$header.$payload.$signature";
			return $token;
		}

		protected function generateHeader(){
			$h= [
				"type"=>"jwt",
				"alg"=>"HS256",
				"app"=>"sample",
				"dev"=>"Martin B. Ditalo"
			];
			return str_replace(['+','/','='], ['-','_', ''],base64_encode(json_encode($h)));
		}

		protected function generatePayload($ucode, $uemail, $urole, $uname) {
			$p= [
				"ucode"=>$ucode,
				"uemail"=>$uemail,
				"urole"=>$urole,
				"ito"=>$uname,
				"iby"=>"JDCruz",
				"ie"=>"jdcruz@gmail.com",
				"idate"=>date_create()
			];
			return str_replace(['+','/','='], ['-','_', ''],base64_encode(json_encode($p)));
		}

		public function login_user($indata) {
			$un = $indata->username;
			$pw = $indata->password;

			$sql="SELECT accounts_tbl.*, employee_tbl.* FROM accounts_tbl INNER JOIN employee_tbl ON accounts_tbl.aempno= employee_tbl.empno WHERE ausername='$un' AND apassword='$pw'";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");

			$token = $this->generateToken($dt[0]['empno'], $dt[0]['empmname'].' '.$dt[0]['emplname'], $dt[0]['arole']);
			$tk = explode(".", $token);
			$signature = $tk[2];

			//Save token of accounts table 
			$sql = "UPDATE accounts_tbl SET atoken='$signature', atokenissued='".date(DATE_ATOM, mktime())."' WHERE aempno=".$dt[0]['empno'];
			$this->globalMethods->execute_query($sql, "Unauthorized User");

			$remarks = "Success!";
			$message = "OK";
			$payload = array(
				'empno'=>$dt[0]['empno'],
				'emplname'=>$dt[0]['emplname'],
				'arole'=>$dt[0]['arole'],
				'empfname'=>$dt[0]['empfname'],
				'token'=>$signature
			);

			return $this->globalMethods->api_result($payload, $remarks, $message);
		}

		public function validate_token($token, $user) {
			//return TRUE if Token is equal to the stored header assigned to the user.

			$sql = "SELECT * FROM accounts_tbl ";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");	
			


			 echo json_encode(array($user));

			if($token == $dt[0]['atoken'] && $user == $dt[0]['aempno']){
				return true;
			} 
				return false;
			


		}


	}

?>