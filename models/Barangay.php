<?php

	class Barangay_covid_tracker {

		protected $globalMethods;



		public function __construct(\PDO $pdo) {

			$this->globalMethods = new GlobalMethods($pdo);

		}	

			//----------------------------------GET---------------------------//
		public function city_chart(){
				$sql = "SELECT cactive_cases as value from city_cases_tbl UNION ALL
						SELECT csuspect_cases as value from city_cases_tbl UNION ALL
						SELECT cnegative_result as value from city_cases_tbl
						";
				$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");
				
				$remarks = "Success!";
				$message = "OK";

				$payload = $dt;			

				return $this->globalMethods->api_result($payload, $remarks, $message);
		}
		public function gender_covid_percent(){
				$sql = "SELECT count(p_gender) AS value from patient_info_tbl WHERE p_gender = 'male'
						UNION ALL SELECT count(p_gender) from patient_info_tbl WHERE p_gender = 'Female'
						";
				$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");
				
				$remarks = "Success!";
				$message = "OK";

				$payload = $dt;			

				return $this->globalMethods->api_result($payload, $remarks, $message);
		}

		public function brgy_pie_chart(){
			$sql = "SELECT brgy_name as name, brgy_totalcases as value from brgy_tbl";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");
			$remarks = "Success!";
			$message = "OK";

			$payload = $dt;			

			return $this->globalMethods->api_result($payload, $remarks, $message);
		}

		public function barangay_cases(){
			$sql = "SELECT * FROM brgy_tbl";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");
			$remarks = "Success!";
			$message = "OK";

			$payload = $dt;			

			return $this->globalMethods->api_result($payload, $remarks, $message);
		}


		public function generatepatientid(){
				$sql = "SELECT COUNT(p_id)+1 AS generatedID from patient_info_tbl";
				$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");
				$remarks = "Success!";
				$message = "OK";

				$payload = $dt;			

				return $this->globalMethods->api_result($payload, $remarks, $message);
		}

		public function barangayname($indata){
			$sql = "SELECT brgy_name, brgy_totalcases FROM brgy_tbl";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");

			// $sql1 = "SELECT brgy_totalcases, brgy_name  FROM brgy_tbl WHERE brgy_name='$indata->brgy_name'";
			// $dt1 = $this->globalMethods->execute_query($sql1, "Unauthorized User");

			$remarks = "Success!";
			$message = "OK";

			$payload = $dt;	
			// $payload = $dt1;			

			return $this->globalMethods->api_result($payload, $remarks, $message);
		}
		
		public function barangay_total($indata){
			$sql = "SELECT brgy_name, brgy_totalcases FROM brgy_tbl WHERE brgy_name='$indata->brgy_name'";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");


			$remarks = "Success!";
			$message = "OK";

			$payload = $dt;	
			// $payload = $dt1;			

			return $this->globalMethods->api_result($payload, $remarks, $message);
		}

		public function brgy_tbl(){
			$sql = "SELECT brgy_name, brgy_totalcases FROM brgy_tbl";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");


			$remarks = "Success!";
			$message = "OK";

			$payload = $dt;	
			// $payload = $dt1;			

			return $this->globalMethods->api_result($payload, $remarks, $message);
		}


		public function recover_death(){
				$sql = "SELECT crecovered_cases, cdeath_cases FROM city_cases_tbl";
				$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");
				$remarks = "Success!";
				$message = "OK";

				$payload = $dt;			

				return $this->globalMethods->api_result($payload, $remarks, $message);
		}

		

		public function barangay(){
			$sql = "SELECT brgy_name, p_status FROM brgy_tbl, patient_info_tbl";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");
			$remarks = "Success!";
			$message = "OK";

			$payload = $dt;			

			return $this->globalMethods->api_result($payload, $remarks, $message);
		}


		public function showpatient(){

			$sql=" SELECT * from patient_info_tbl";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");

			$remarks = "Success";
			$message = "OK";

			return $this->globalMethods->api_result($dt, $remarks ,$message);

		} 

		public function searchpatient($indata){
			$p_id = $indata->p_id;

			$sql=" SELECT * from patient_info_tbl WHERE p_id='$p_id'";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");

			$remarks = "Success";
			$message = "OK";

			return $this->globalMethods->api_result($dt, $remarks ,$message);


		}
		public function brgynames(){

			$sql=" SELECT brgy_name from brgy_tbl ";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");

			$remarks = "Success";
			$message = "OK";

			return $this->globalMethods->api_result($dt, $remarks ,$message);


		} 
		//----------BERT-----------//


		public function count_totalcases(){
			$sql = "SELECT COUNT(p_date) AS count1
					FROM city_cases_tbl as c1, patient_info_tbl as p1 
					WHERE p1.p_date=CURRENT_DATE";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");
			
			$remarks = "Success!";
			$message = "OK";

			$payload = $dt;			

			return $this->globalMethods->api_result($payload, $remarks, $message);
		}


		public function city_cases(){
				$sql = "SELECT * FROM city_cases_tbl";
				$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");
				
				$remarks = "Success!";
				$message = "OK";

				$payload = $dt;			

				return $this->globalMethods->api_result($payload, $remarks, $message);
		}
		public function count_recoveredcases(){
			$sql = "SELECT COUNT(p_date_status) AS count 
					FROM city_cases_tbl as c1, patient_info_tbl as p1 
					WHERE p1.p_date=CURRENT_DATE AND c_status='Recovered'";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");
			
			$remarks = "Success!";
			$message = "OK";

			$payload = $dt;			

			return $this->globalMethods->api_result($payload, $remarks, $message);
		}

		public function count_deathcases(){
			$sql = "SELECT COUNT(p_date_status) AS counts
					FROM city_cases_tbl as c1, patient_info_tbl as p1 
					WHERE p1.p_date=CURRENT_DATE AND c_status='Death'";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");
			
			$remarks = "Success!";
			$message = "OK";

			$payload = $dt;			

			return $this->globalMethods->api_result($payload, $remarks, $message);
		}


		//-----------------------------------POST--------------------------------//

		public function addpatient ($indata){

			//$brgy_name = $indata->brgy_name;
			$p_id = $indata->p_id;
			$p_age = $indata->p_age;
			$p_nationality = $indata->p_nationality;
			$p_gender = $indata->p_gender;
			$p_barangay = $indata->p_barangay;
			$p_work = $indata->p_work;
			$p_date = $indata->p_date;
			$p_status = $indata->p_status;
			$p_test_result = $indata->p_test_result;
			$p_relation_of_patients = $indata->p_relation_of_patients;
			$p_travel_history = $indata->p_travel_history;
			$p_hospital = $indata->p_hospital;
			$p_symptoms = $indata->p_symptoms;
			$p_diagnosed = $indata->p_diagnosed;

			$sql="INSERT INTO patient_info_tbl(p_id, p_age, p_nationality, p_gender, p_barangay, p_work, p_date, p_status, 		c_status, p_test_result, p_relation_of_patients, p_travel_history, p_hospital, p_symptoms, p_diagnosed) 
			VALUES('$p_id','$p_age', '$p_nationality', '$p_gender','$p_barangay','$p_work','$p_date','$p_status','Positive', '$p_test_result', '$p_relation_of_patients', '$p_travel_history', '$p_hospital', '$p_symptoms', '$p_diagnosed')";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");

			// $sql1="SELECT brgy_totalcases, brgy_activecases FROM brgy_tbl where brgy_name='$brgy_name'";
			// $dt1 = $this->globalMethods->execute_query($sql1, "Unauthorized User");


			$remarks = "Success";
			$message = "Ok";

			return $this->globalMethods->api_result($dt, $remarks ,$message);

		}


		public function addbrgytotalcases($indata){
			$brgy_name = $indata->brgy_name;

// 			UPDATE city_cases_tbl c1 JOIN brgy_tbl b1 
// SET b1.brgy_totalcases = b1.brgy_totalcases+1, c1.ctotal_cases = c1.ctotal_cases+1 
// WHERE b1.brgy_name='Sta Rita' AND c1.crecno='1'

			$sql = "UPDATE city_cases_tbl c1 JOIN brgy_tbl b1 
					SET b1.brgy_totalcases = b1.brgy_totalcases+1, 
					c1.ctotal_cases = c1.ctotal_cases+1, 
					b1.brgy_activecases = b1.brgy_activecases+1,
					c1.cactive_cases = c1.cactive_cases+1
					WHERE b1.brgy_name='$brgy_name' AND c1.crecno='1'";

			// $sql = "UPDATE brgy_tbl SET brgy_totalcases = brgy_totalcases+1
			// 		WHERE brgy_name = '$brgy_name'";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");


			$remarks = "Success!";
			$message = "OK";

			$payload = $dt;	
			// $payload = $dt1;			

			return $this->globalMethods->api_result($payload, $remarks, $message);
		}

		public function addbrgyrecoveredcases($indata){
			$brgy_name = $indata->brgy_name;

			$sql = "UPDATE city_cases_tbl c1 JOIN brgy_tbl b1 
					SET b1.brgy_recoveredcases = b1.brgy_recoveredcases+1, 
					b1.brgy_activecases = b1.brgy_activecases-1,
					c1.crecovered_cases = c1.crecovered_cases+1, 
					c1.cactive_cases = c1.cactive_cases-1 
					WHERE b1.brgy_name='$brgy_name' AND c1.crecno='1'";

			// $sql = "UPDATE brgy_tbl SET brgy_recoveredcases = brgy_recoveredcases+1
			// 		WHERE brgy_name = '$brgy_name'";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");


			$remarks = "Success!";
			$message = "OK";

			$payload = $dt;	
			// $payload = $dt1;			

			return $this->globalMethods->api_result($payload, $remarks, $message);
		}

		public function addbrgydeathcases($indata){
			$brgy_name = $indata->brgy_name;

			$sql = "UPDATE city_cases_tbl c1 JOIN brgy_tbl b1 
					SET b1.brgy_deathcases = b1.brgy_deathcases+1, 
					b1.brgy_activecases = b1.brgy_activecases-1,
					c1.cdeath_cases = c1.cdeath_cases+1,
					c1.cactive_cases = c1.cactive_cases-1  
					WHERE b1.brgy_name='$brgy_name' AND c1.crecno='1'";

			// $sql = "UPDATE brgy_tbl SET brgy_deathcases = brgy_deathcases+1
			// 		WHERE brgy_name = '$brgy_name'";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");


			$remarks = "Success!";
			$message = "OK";

			$payload = $dt;	
			// $payload = $dt1;			

			return $this->globalMethods->api_result($payload, $remarks, $message);
		}

		public function updatepatients($indata){
			$c_status = $indata->c_status;
			$p_barangay = $indata->p_barangay;
			$p_id = $indata->p_id;

			$sql = "UPDATE patient_info_tbl SET c_status='$c_status', p_date_status=CURRENT_DATE() WHERE p_barangay='$p_barangay' and p_id='$p_id'";
			$dt = $this->globalMethods->execute_query($sql, "Unauthorized User");


			$remarks = "Success!";
			$message = "OK";

			$payload = $dt;	
			// $payload = $dt1;			

			return $this->globalMethods->api_result($payload, $remarks, $message);
		}

		
	}

?>