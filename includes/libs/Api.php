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
				$array_final["boards"][$i]['data'] = json_decode($boards[0]['data'], TRUE);

				//Users
				$users = json_decode($relationship['users'], TRUE);
				$e = 0;
				foreach ($users as $user) {
					$userData = Api::getUser($user['id']);
					$array_final["boards"][$i]['users'][$e] = $userData[0];
					$e++;
				}
				//Posts count
				$postCount = Api::getPosts("parent", $boards[0]['id']);
				$count = DB::count();
				$array_final["boards"][$i]['count'] = $count;

				$i++;
			}
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
			$response["response"] = "No hay posts";
			$response["parent"] = $id;

			Api::printResults($print, $response);

		} else {
			
			$postFields = DB::columnList('posts');
			$i = 0;
			$array_final["empty"] = 0;
			
			foreach ($array_posts as $post) {
				foreach ($postFields as $field) {
					$array_final['posts'][$i][$field] = $post[$field];
				}
				$array_final['posts'][$i]['data'] = json_decode($post['data'], TRUE);
				$array_final['posts'][$i]['date'] = dateFormat($post['creationdate']);
				
			
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

	public function post($print = "json", $id) {
		
		$id = escape_value($id);
		$array_posts = ApiQuery::getPost($id);	

		//No Post Found
		if (empty($array_posts)) {
			$response["tag"] = "post";
			$response["empty"] = 1;
			$response["response"] = NO_PRACTICES_AVAILABLE;

			Api::printResults($print, $response);

		} else {
			
			$postFields = DB::columnList('posts');
			$array_final["empty"] = 0;
			
			$post = $array_posts[0];

			foreach ($postFields as $field) {
				$array_final['post'][0][$field] = $post[$field];
			}
			$array_final['post'][0]['data'] = json_decode($post['data']);
			$array_final['post'][0]['date'] = dateFormat($post['creationdate']);
			//Get Post 'COMMENTS' on a parallel object
			$comments = ApiQuery::getComments("post",$post['id']);
			$i=0;
			foreach ($comments as $comment) {
				$array_final['post'][0]['comments'][$i] = $comment;
				$array_final['post'][0]['comments'][$i]['data'] = json_decode($comment['data'], TRUE);
				$user = Api::getUser($comment['user']);
				$array_final['post'][0]['comments'][$i]['user'] = $user[0];
				$i++;
			}
			Api::printResults($print, $array_final);
		}

	}

	public function comments($print = "json", $parameter = "post", $id, $for_date="", $to_date="") {
		
		$id = escape_value($id);

		/*
		if($for_date == "") { $for_date = date("Y-m-d");	}
		if($to_date == "") 	{ $to_date 	= date("Y-m-d", strtotime("-60 days"));	}
		*/
		
		$array_comments = ApiQuery::getComments($parameter,$id);	
		//print_r($array_comments); exit;	

		//No Practices
		if (empty($array_comments)) {
			$response["tag"] = "comments";
			$response["empty"] = 1;
			$response["response"] = "No hay comentarios";

			Api::printResults($print, $response);

		} else {
			
			$commentFields = DB::columnList('comments');
			$i = 0;
			$array_final["empty"] = 0;
			
			foreach ($array_comments as $comment) {
				foreach ($commentFields as $field) {
					$array_final['comments'][$i][$field] = $comment[$field];
				}
				//$array_final['comments'][$i]['data'] = json_decode($comment['data']);
				$user = Api::getUser($comment['user']);
				$array_final['comments'][$i]['user'] = $user[0];

				$i++;
			}
			
			Api::printResults($print, $array_final);
		}

	}
	public function comment($print = "json", $id) {
		
		$id = escape_value($id);
		
		$array_comment = ApiQuery::getComment($id);	
		if (empty($array_comment)) {
			$response["tag"] = "comments";
			$response["empty"] = 1;
			$response["response"] = "El comentario no existe o ha sido eliminado";

			Api::printResults($print, $response);

		} else {
			
			$commentFields = DB::columnList('comments');
			$i = 0;
			$array_final["empty"] = 0;
			
			foreach ($array_comment as $comment) {
				foreach ($commentFields as $field) {
					if ($field == 'data'){
						$array_final['post'][0]['comments'][$i][$field] = json_decode($comment[$field], TRUE);
					} else {
						$array_final['post'][0]['comments'][$i][$field] = $comment[$field];
					}
				}
				$user = Api::getUser($comment['user']);
				$array_final['post'][0]['comments'][$i]['user'] = $user[0];

				$i++;
			}
			
			Api::printResults($print, $array_final);
		}

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