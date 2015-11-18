<?php
	
	require_once ( LIBS . 'fileupload/class.upload.php');
	
	class Fileuploader {
	
		function __construct() {			
		
		}
		
		static function upload($file) {
			
			//print_r($file);
			$folder = CLIENTS_FOLDER;
			$handle = new Upload($_FILES['files']);
			$handle->allowed = 	array(  'image/jpeg', 
										'image/jpg',
										'image/png',
								);
			 //sanitizar nombre de caracteres, acentos
			if ($handle->uploaded) {
				//upload original file no changes
				
				//$handle->allowed      = array('jpeg','jpg','tiff','msword','cdr','ai','eps','pdf');
				$username = User::get('username');
				$username = create_slug($username);
				$file_new_name = uniqid(date("Ymd-his"),true)."-".$username;
				$handle->file_new_name_body = $file_new_name;
				
				$handle->Process($folder);
				$ext= $handle->file_src_name_ext;
				//check if went ok
				if($handle->processed){
					//crea un thumb del temporal
					//crea un jpg temporal
					if ($ext!="jpg"){
						//$pages=Helper::countPagesPDF($file_new_name) ;
						//exec("/usr/bin/convert -colorspace RGB ".CLIENTS_FOLDER."$file_new_name.$ext   ".CLIENTS_FOLDER."temp/$file_new_name.jpg",$output);
								echo  '{"status":"success", 
										"fileeditedname":"'.$file_new_name.".".$ext.'"}';
							
								/*$filethumb=Helper::listPreviewPDF($file_new_name,$pages);
								
								foreach($filethumb as $thumb ){
									//echo '{"status":"'.$thumb.'"}';
									exec("/usr/bin/convert -colorspace RGB ".CLIENTS_FOLDER."$file_new_name.$ext   ".CLIENTS_FOLDER."temp/$file_new_name.jpg",$output);
									Helper::thumbnailPreview(CLIENTS_FOLDER ."temp/$thumb", CLIENTS_FOLDER .'preview/');
									
								}*/
								
										
						
						
					}else {
						/*exec("/usr/bin/convert -colorspace RGB ".CLIENTS_FOLDER."$file_new_name.$ext   ".CLIENTS_FOLDER."temp/$file_new_name.jpg",$output);
						*/
						
						//Helper::thumbnailPreview(CLIENTS_FOLDER."$file_new_name.jpg ", CLIENTS_FOLDER .'preview/');
						
						//$response["tag"] = "boards";
						$response["status"] = "success";
						$response["fileeditedname"] = $file_new_name.".".$ext;
						return $response;

						//echo  '{"status":"success", 
						//		"fileeditedname":"'.$file_new_name.".".$ext.'",
						//		}';
					}
						//echo  '{"status":"success", "fileeditedname":"'.$file_new_name.".".$ext.'"}';
											
					} else {
						echo '{"status":"error","error":"'.$handle->error.'"}';
						//echo '  Error: ' . $handle->error . '';
					}
				
				$handle->Clean();
				
			} else {
				echo '{"statuss":"error"}'; //echo '  Error: ' . $handle->error . '';
			}
						
		}

	}

?>