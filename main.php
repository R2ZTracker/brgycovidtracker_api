<?php 
	require_once("./config/Database.php");
	require_once("./models/Get.php");
	require_once("./models/Global.php");
	require_once("./models/Barangay.php");

	// $auth = new Auth($pdo);
	$get = new Get($pdo);
 

	// $error="";
	if(isset($_REQUEST['request'])){
		$req = explode('/', rtrim($_REQUEST['request'],'/'));
	} else {
		$req = array("errorcatcher"=>$error);
	}

	// $authHeader = "";
	// $authUser = "";
	// $headers = apache_request_headers();
	//     foreach($headers as $header => $value){
	//     	 // echo "$header: $value";
	//     if($header == "Authorization") {
	//         $authHeader = $value;
	//         // echo $authHeader;
	//     }

	//     if($header == "X-Auth-User") {
	//         $authUser = $value;
	//         // echo $authUser;
	//     }

	//     }

	$barangay = new Barangay_covid_tracker($pdo);
	// $post = new Post($pdo);
	

	switch($_SERVER['REQUEST_METHOD']) {
		case 'POST':
			switch ($req[0]) {

				
				case 'login':
					$d=json_decode(file_get_contents("php://input"));
					echo json_encode($auth->login_user($d));
				break;

				case 'brgy_cases1':
					echo json_encode($barangay->barangay_cases());
				break;	

				case 'brgy_cases':
					echo json_encode($barangay->barangay());
				break;

				case 'brgy_tbl':
					echo json_encode($barangay->brgy_tbl());
				break;

				case 'barangayname':
					$d=json_decode(file_get_contents("php://input"));
					echo json_encode($barangay->barangayname($d));
				break;

				case 'barangay_total':
					$d=json_decode(file_get_contents("php://input"));
					echo json_encode($barangay->barangay_total($d));
				break;

				case 'showpatient':
					echo json_encode($barangay->showpatient());
				break;	

				case 'recover_death':
					echo json_encode($barangay->recover_death());
				break;	

				case 'city_cases':
					echo json_encode($barangay->city_cases());
				break;	

				case 'count_totalcases':
					echo json_encode($barangay->count_totalcases());
				break;

				case 'count_recoveredcases':
					echo json_encode($barangay->count_recoveredcases());
				break;

				case 'count_deathcases':
					echo json_encode($barangay->count_deathcases());
				break;	

				case 'addpatient':
					$d=json_decode(file_get_contents("php://input"));
					echo json_encode($barangay->addpatient($d));
				break;

				case 'updatepatient':
					$d=json_decode(file_get_contents("php://input"));
					echo json_encode($barangay->updatepatients($d));
				break;

				case 'totalcases':
					$d=json_decode(file_get_contents("php://input"));
					echo json_encode($barangay->addbrgytotalcases($d));
				break;

				case 'recoveredcases':
					$d=json_decode(file_get_contents("php://input"));
					echo json_encode($barangay->addbrgyrecoveredcases($d));
				break;

				case 'deathcases':
					$d=json_decode(file_get_contents("php://input"));
					echo json_encode($barangay->addbrgydeathcases($d));
				break;

				case 'searchpatient':
					$d=json_decode(file_get_contents("php://input"));
					echo json_encode($barangay->searchpatient($d));
				break;
				
				case 'counttotalcase':
					echo json_encode($barangay->count_total_cases());
				break;
				
				default:
					http_response_code(400);
					echo json_encode(
						array(
							"status"=>"failed",
							"message"=>"Bad Request. Kindly contact the developer for the list of endpoints"
						)
					);
				break;

			}
		break;

		case 'GET':
		switch ($req[0]) {

			//-----------------------------Martin---------------------------//
			case 'brgy':
					echo json_encode($barangay->barangay_cases());
		    break;

			case 'generatePID':
					echo json_encode($barangay->generatepatientid());
			break;

			case 'getbrgynames':
					echo json_encode($barangay->brgynames());
			break;
			case 'city_cases':
					echo json_encode($barangay->city_cases());
			break;
			case 'city_chart':
					echo json_encode($barangay->city_chart());
			break;
			case 'brgy_pchart':
					echo json_encode($barangay->brgy_pie_chart());
			break;
			case 'gender_covid_percent':
					echo json_encode($barangay->gender_covid_percent());
			break;

			default:
			http_response_code(400);
			echo json_encode(
				array(
					"status"=>"failed",
					"message"=>"Bad Request. Kindly contact the developer for the list of endpoints"
				)
			);
			break;
		}
		break;

		default:
			http_response_code(401);
			echo json_encode(
				array(
					"status"=>"failed",
					"message"=>"Unauthorized User"
				)
			);
	}	


?>