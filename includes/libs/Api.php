<?php
class Api extends ApiQuery {

	public function __construct() {

	}

	//PRINT FORMAT FUNCTION
	public function printResults($print = "json", $array_final) {
		if ($print == 'json') {
			echo json_encode($array_final, JSON_UNESCAPED_UNICODE);
		} else {
			//MODO "ARRAY"
			echo $array_final;
		}
	}



	public function boards($print = "json", $parameter = "from", $id) {
		$id = escape_value($id);
		$parameter = escape_value($parameter);

		//is RELATIONSHIPS table always going to be accessed by user id?
		$findRelationship = ApiQuery::getRelationships("users", $id);
		if (empty($findRelationship)) {
			
			$response["tag"] = "boards";
			$response["empty"] = 1;
			$response["response"] = "No boards";
			$response["template"] = "";

			Api::printResults($print, $response);

		} else {
			$i = 0;
			foreach ($findRelationship as $relationship) {
				//$decodeBoards = json_decode($relationship['relationships'], TRUE);
				$array_final["tag"] = "boards";
				$array_final["empty"] = 0;
				$array_final["template"] = "";

				$boards = Api::getBoards("relationship", $relationship['id']);
				$array_final["boards"][$i] = $boards[0];
				$i++;
			}
			//$boards = ApiQuery::getBoards();
			//Return Function
			Api::printResults($print, $array_final);
		}

	}

	public function posts($print = "json", $parameter = "from", $id, $term = "", $for_date="", $to_date="") {
		
		$id = escape_value($id);

		if($for_date == "") { $for_date = date("Y-m-d");	}
		if($to_date == "") 	{ $to_date 	= date("Y-m-d", strtotime("-60 days"));	}

		if ($parameter = "board") { $parameter = "parent";}

		$array_posts = ApiQuery::getPosts($parameter,$id);	
		//print_r($array_posts); exit;	

		//No Practices
		if (empty($array_posts)) {
			$response["tag"] = "posts";
			$response["empty"] = 1;
			$response["response"] = NO_PRACTICES_AVAILABLE;

			Api::printResults($print, $response);

		} else {
			
			$postFields = DB::columnList('posts');
			$i = 0;
			$array_final["empty"] = 0;
			
			foreach ($array_posts as $post) {
				foreach ($postFields as $field) {
					$array_final['posts'][$i][$field] = $post[$field];
				}
				$array_final['posts'][$i]['data'] = json_decode($post['data']);
				
			
				/*$array_schedules = ApiQuery::getDoctorPracticesSchedule($post["id"]);
				$s = 0;
				foreach ($array_schedules as $schedule) {

					$array_final['post'][$i]['schedule'][$s] = $schedule;
					$schedule['day'] = substr($schedule['day'], 0, -2);
					$array_final['post'][$i]['schedule'][$s]['day'] = $schedule['day'];
					$ini_schedule = substr($schedule['ini_schedule'], 0, 2);

					if ($ini_schedule > 01 && $ini_schedule < 13) {
						$icon = '<i class="fa fa-sun-o"></i> ';
					} else {
						$icon = '<i class="fa fa-moon-o"></i> ';
					}

					$schedule['ini_schedule'] = $icon . $schedule['ini_schedule'];
					$array_final['post'][$i]['schedule'][$s]['ini_schedule'] = $schedule['ini_schedule'];

					$s++;
				}*/
				$i++;
			
			}
			
			
			Api::printResults($print, $array_final);
		}

	}

	//Appointments/arreglo/doctor/22/post/11/2014-02-09
	public function appointments($print = "json", $by = "doctor", $id, $second_parameter = "", $post_id = "", $for_date = "", $to_date = "") {
		$id = escape_value($id);

		if (!empty($second_parameter)) {
			$second_parameter = escape_value($second_parameter);
			$post_id = escape_value($post_id);
			$for_date = escape_value($for_date);
			$to_date = escape_value($to_date);

			//$this->loadModel('appointments');
			$array_appointments = ApiQuery::getAppointmentsByDate($id, $for_date, $post_id);
			//$this->loadModel('doctor');
			$array_posts = ApiQuery::getDoctorPractice($id, $post_id);
			$postFields = DB::columnList('clinic');
			// $this->loadModel('patient');
			$array_final["empty"] = 0;
			$array_final['dates'][0]['date_string'] = $for_date;

			foreach ($postFields as $postfield) {
				$array_final['dates'][0]['post'][0][$postfield] = $array_posts[0][$postfield];
			}
			$a = 0;
			foreach ($array_appointments as $appointment) {
				$array_patient_data = ApiQuery::getPatientBy("id", $appointment['id_patient']);
				$appointment['patient_data'] = $array_patient_data;
				$array_final['dates'][0]['post'][0]['appointments'][$a] = $appointment;
				$a++;
			}

			if ($print == 'json') {
				echo json_encode($array_final, JSON_UNESCAPED_UNICODE);
			} else {//modo "array"
				return $array_final;
			}

		} else {

			$array_posts = ApiQuery::getDoctorPractices($id);
			
			if (empty($array_posts)) {
				//Doctor has NO posts
				$response["tag"] = "posts";
				$response["empty"] = 1;
				$response["response"] = NO_PRACTICES_AVAILABLE;
	
				if ($print == 'json') {
					echo json_encode($response, JSON_UNESCAPED_UNICODE);
				} else {//modo "array"
					return $response;
				}
				
			} else {
				$postFields = DB::columnList('clinic');

				$array_dates = ApiQuery::getAppointmentsDate("id_doctor", $id, "ASC");
				
				//Later use inside
				//$this->loadModel('patient');
					
				if (empty($array_dates)) {
	
					$response["tag"] = "appointments";
					$response["empty"] = 1;
					$response["response"] = NO_APPOINTMENTS_DATE;
	
					//echo json_encode($response);
	
					if ($print == 'json') {
						echo json_encode($response, JSON_UNESCAPED_UNICODE);
					} else {//modo "array"
						return $response;
					}
	
					} else {
		
						$i = 0;
						$array_final["empty"] = 0;
						foreach ($array_dates as $date) {
							$date_array['date_string'] = $date["date"];
							//$array_final['appointments'][$i]['date'] = $date_array;
							$array_final['dates'][$i] = $date_array;
		
							$p = 0;
							foreach ($array_posts as $post) {
								$array_appointments = ApiQuery::getAppointmentsByDate($id, $date["date"], $post["id"]);
	
								foreach ($postFields as $postfield) {
									$array_final['dates'][$i]['post'][$p][$postfield] = $post[$postfield];
									//$array_final['appointments'][$i]['date']['post'][$p][$postfield] = $post[$postfield];
								}
	
								//	$array_final['appointments'][$i]['date']['post'][$p]['post_id'] = $post['id'];
								//$array_final['appointments'][$i]['date'][$date["date"]]['post'][$post['id']] = $date["date"];
								$a = 0;
								foreach ($array_appointments as $appointment) {
									$array_patient_data = ApiQuery::getPatientBy("id", $appointment['id_patient']);
									$appointment['patient_data'] = $array_patient_data;
		
									$array_final['dates'][$i]['post'][$p]['appointments'][$a] = $appointment;
		
									$a++;
								}
								$p++;
							}
							$i++;
						}
	
					if ($print == 'json') {
						echo json_encode($array_final, JSON_UNESCAPED_UNICODE);
					} else {//modo "array"
						return $array_final;
					}
				}
			} //end if doctor HAS posts
		} //end if emtpy second parameter

	}

	// AUTOCOMPLETE: This function is invoked when user is writing fields related to : Doctor's name, Clinics, Addresses and Doctor's Speciality
	public function autocomplete($print = "json", $what="all", $string) {

		//	$string = trim($_GET['term']);
		/*switch ($what) {
			case 'posts':
				$query = ApiQuery::autocomplete($what, $string);
				break;
			
			case "all":
				$query = ApiQuery::autocomplete($string);
				break;
		}*/
		$query = ApiQuery::autocomplete($what, $string);
		
		if ($print == 'json') {
			echo json_encode($query, JSON_UNESCAPED_UNICODE);
		} else {//modo "array"
			return $array_final;
		}

	}

	public function search($type = "other", $terms, $location = "VE") {

		$type = escape_value($type);
		$terms = escape_value($terms);
		$location = escape_value($location);

		switch ($type) {

			default :
				// No Type is sent, no autocomplete match found

				//This is "TYPE NOT DEFINED" search
				$searchTerms = explode(',', $terms);
				$t = 0;

				foreach ($searchTerms as $term) {
					$term = trim($term);
					$array_final['filters'][$t]['term'] = $term;
					if ($t == 0) {
						$termsQuery = "WHERE term LIKE '%$term%'";
					} else if (!empty($term)) {
						$termsQuery .= " OR term LIKE '%$term%'";
						//$termsQuery[] = "OR term LIKE '%$term%'";
						//$string = "LIKE '%$string%'"
					}
					$t++;

				}

				$found_matches = $found_matches = ApiQuery::search($termsQuery);

				//Build Results json gatherin from all tables
				foreach ($found_matches as $match) {

					switch ($match['in_table']) {
						case 'doctor' :
							$queryString_Doctor[] .= $match['id'];
							break;
						case 'specialty' :
							//search DOCTORS with SPECIALTY ID (in doctor)
							$queryString_Specialty[] .= $match['id'];
							break;
						case 'clinic' :
							//search DOCTORS with CLINIC ID (in doctor_post)
							$queryString_Clinic[] .= $match['id'];
							break;
					}

				}
				// 1- DOCTOR matches
				if (!empty($queryString_Doctor)) {
					$i = 0;
					$param = "doctor.id";
					foreach ($queryString_Doctor as $byDoctor) {
						if ($i != 0) { $queryStringDoctor .= " OR " . $param . " = ";
						} $queryStringDoctor .= $byDoctor;
						$i++;
					}
					$array_doctors_byDoctor = ApiQuery::getDoctorsBy($param, $queryStringDoctor);
				} else if (empty($queryString_Doctor)) {
					$array_doctors_byDoctor = array();
				}

				// 2- CLINIC PRACTICE matches
				if (!empty($queryString_Clinic)) {
					$i = 0;
					foreach ($queryString_Clinic as $byClinic) {
						if ($i != 0) { $queryStringClinic .= " OR id_clinic = ";
						} $queryStringClinic .= $byClinic;
						$i++;
					}
					//Get Doctors ID
					$array_doctors_byPractice = ApiQuery::getDoctorsByPractice($queryStringClinic);
					$d = 0;
					$param = "doctor.id";
					foreach ($array_doctors_byPractice as $doctor) {
						if ($d != 0) { $queryStringDoctor2 .= " OR " . $param . " = ";
						} $queryStringDoctor2 .= $doctor['id_doctor'];
						$d++;
					}
					$array_doctors_byClinic = ApiQuery::getDoctorsBy($param, $queryStringDoctor2);

				} else if (empty($queryString_Clinic)) {
					$array_doctors_byClinic = array();
				}
				// 3- CLINIC PRACTICE matches
				if (!empty($queryString_Specialty)) {
					$i = 0;
					$param = "doctor.specialty";
					foreach ($queryString_Specialty as $bySpecialty) {
						if ($i != 0) { $queryStringSpecialty .= " OR " . $param . " = ";
						} $queryStringSpecialty .= $bySpecialty;
						$i++;
					}
					$array_doctors_bySpecialty = ApiQuery::getDoctorsBy($param, $queryStringSpecialty);
				} else if (empty($queryString_Specialty)) {
					$array_doctors_bySpecialty = array();
				}

				//Merge all Doctors

				$array_doctors = array_unique(array_merge($array_doctors_byDoctor, $array_doctors_byClinic, $array_doctors_bySpecialty), SORT_REGULAR);

				break;
		}

		//Explode Search terms and add Query for every word
		//TODO  exclude words like the, de, and, y, con etc, and evaluate complete term

		//get all columns from Table
		$profileFields = DB::columnList('doctor');
		$postFields = DB::columnList('clinic');

		$i = 0;
		foreach ($array_doctors as $doctor) {

			foreach ($profileFields as $field) {
				$array_final['doctors'][$i][$field] = $doctor[$field];
			}

			$array_posts = ApiQuery::getDoctorPractices($doctor["id"]);

			$p = 0;
			foreach ($array_posts as $post) {

				foreach ($postFields as $postfield) {
					$array_final['doctors'][$i]['post'][$p][$postfield] = $post[$postfield];
				}
				$array_schedules = ApiQuery::getDoctorPracticesSchedule($post["id"]);
				//$array_final['doctors'][$i]['post'][$p]	= $post;
				$s = 0;
				foreach ($array_schedules as $schedule) {

					$array_final['doctors'][$i]['post'][$p]['schedule'][$s] = $schedule;
					$schedule['day'] = substr($schedule['day'], 0, -2);
					$array_final['doctors'][$i]['post'][$p]['schedule'][$s]['day'] = $schedule['day'];
					$ini_schedule = substr($schedule['ini_schedule'], 0, 2);

					if ($ini_schedule > 01 && $ini_schedule < 13) {
						$icon = '<i class="fa fa-sun-o"></i> ';
					} else {
						$icon = '<i class="fa fa-moon-o"></i> ';
					}

					$schedule['ini_schedule'] = $icon . $schedule['ini_schedule'];
					$array_final['doctors'][$i]['post'][$p]['schedule'][$s]['ini_schedule'] = $schedule['ini_schedule'];

					$s++;
				}
				$p++;
			}
			$i++;
		}

		echo json_encode($array_final, JSON_UNESCAPED_UNICODE);

	}

	
	
	//
	public function patient($print = "json", $id) {

		$id = escape_value($id);

		$array_patients = ApiQuery::getPatientBy('id', $id);
		//$array_patients = $this->getPatientBy('id', $id);
		//get all columns from Table
		$profileFields = DB::columnList('patient');
		$i = 0;
		foreach ($array_patients as $patient) {
			foreach ($profileFields as $field) {
				$array_final['patient'][$i][$field] = $patient[$field];
			}
		}
		if ($print == 'json') {
			echo json_encode($array_final, JSON_UNESCAPED_UNICODE);
		} else {//modo "array"
			return $array_final;
		}

	}
	
	//get Doctor's Matrix of available slots  and current unavailable
	public function availability($print = "json", $id_post) {
		
		
		$array_schedules = ApiQuery::getDoctorPracticesSchedule($id_post);
		$array_schedules_exceptions = ApiQuery::getDoctorPracticesScheduleExceptions($id_post);
		$array_post =	ApiQuery::getPractice($id_post);
		
		
		$array_final["empty"] = 0;
		$array_final["max_days_ahead"] = $array_post[0]['max_days_ahead'];
		$array_final["manage_time_slots"] = $array_post[0]['manage_time_slots'];
		$array_final["days_in"] = $array_schedules;
		$array_final["days_out"] = $array_schedules_exceptions;
		
		if ($print == 'json') {
			echo json_encode($array_final, JSON_UNESCAPED_UNICODE);
		} else {//modo "array"
			return $array_final;
		}
	}
	

}

?>