<?php
require_once('api_auth.php');
require '../PHPMailer/SMTPMailer.php';
if ($response['auth_status']==1) { 

	$verb = $_SERVER['REQUEST_METHOD'];

//HANDLE POST REQUEST START
//-----------------------
/*
status values 
0->registration failed
1->registration success
2->mandatory field empty
3->email already registered
4->phone number already registered
5->FCM token insertion failed
*/
function register_user(){
	global $mysqli;
	if(!isset($_POST['first_name'])||empty($_POST['first_name'])){
		$message="First name is mandatory";
		$status=2;
	}
	if(!isset($_POST['last_name'])||empty($_POST['last_name'])){
		$message="Last name is mandatory";
		$status=2;
	}
	if(!isset($_POST['student_phone'])||empty($_POST['student_phone'])){
		$message="Phone number is mandatory";
		$status=2;
	}
	if(!isset($_POST['student_email'])||empty($_POST['student_email'])){
		$message="Email is mandatory";
		$status=2;
	}
	if(!isset($_POST['student_password'])||empty($_POST['student_password'])){
		$message="Password is mandatory";
		$status=2;
	}
	else{
		$sql="SELECT * FROM admissions_mas WHERE student_phone='{$_POST['student_phone']}'";
		$res=$mysqli->query($sql);
		if($res->num_rows>0){
			$message="Phone number already registered";
			$status=4;
		}
		else{
			$sql="SELECT * FROM admissions_mas WHERE student_email='{$_POST['student_email']}'";
			$res=$mysqli->query($sql);
			if($res->num_rows>0){
				$message="Email already registered";
				$status=3;
			}
			else{
				$password=sha1($_POST['student_password']);
				$sql="INSERT INTO admissions_mas (student_firstname, student_lastname, student_email, student_phone, student_password,admission_notes,initial_registration) VALUES ('{$mysqli->real_escape_string($_POST['first_name'])}','{$mysqli->real_escape_string($_POST['last_name'])}','{$mysqli->real_escape_string($_POST['student_email'])}','{$mysqli->real_escape_string($_POST['student_phone'])}','{$password}','{$mysqli->real_escape_string($_POST['student_phone'])}','{$mysqli->real_escape_string($_POST['interested_course'])}','user')";
				$res=$mysqli->query($sql);
				if($res){
					$message="Registration successful";
					$status=1;
					$emessage="
					Dear {$_POST['first_name']},<br>
					Thank you for your interest KPIAS, following are the credentials to manage your admission at KPIAS Online.
					<br>URL: http://www.kpias.com/login
					<br>Login ID: {$_POST['student_email']}
					<br>Password: {$_POST['student_password']}
					<p>
					Thanks and Regards,<br>
					Communications Team,<br>	
					Krishna Pradeep's IAS.
					</p>
					";
					SMTPMailer($_POST['student_email'], 'KPIAS E-Governance Account Details', $emessage);
					$admission_id=$mysqli->insert_id;
					$sql="INSERT INTO fcm_tokens (fcm_token,admission_id) VALUES ('{$_POST['fcm_token']}',$admission_id)";
					$res=$mysqli->query($sql);
					if(!$res){
						$message='Registration successful, fcm insertion failed';
						$status=5;
					}
				}
				else
				{
					$message="Registration Failed";
					$status=0;
				}

			}	
		}
	}
	$response['message']=$message;
	$response['status']=$status;
	header('Content-Type: application/json');
	echo json_encode($response, JSON_UNESCAPED_SLASHES);
}
//-----------------------
//HANDLE POST REQUEST END
switch ($verb) {
	case 'POST':
	register_user();
	break;

	default:
	http_response_code(405);
	break;
}

}
?>