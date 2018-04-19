<?php
require_once('api_auth.php');

if ($response['auth_status']==1) { 

	$verb = $_SERVER['REQUEST_METHOD'];

//HANDLE POST REQUEST START
//-----------------------
/*
status values 
0->incorrect password
1->login success
2->email/phone empty
3->password empty
4->no such user
5->login success, cannot write fcm
*/
	function validate_user(){
		global $mysqli;
		if(!isset($_POST['login_id'])||empty($_POST['login_id'])){
			$message="Registered Email/Phone is mandatory";
			$status=2;
		}
		else{
			if(isset($_POST['login_id'])){
				$param=$_POST['login_id'];
			}
			if(!isset($_POST['student_password'])||empty($_POST['student_password'])){
				$message="Password cannot be empty";
				$status=3;
			}
			else{
				$sql="SELECT * FROM admissions_mas WHERE student_phone='{$param}' OR student_email='{$param}'";
				$res=$mysqli->query($sql);
				if($res->num_rows<1){
					$message="No such user found";
					$status=4;
				}
				else
				{
					$row=$res->fetch_assoc();
					$student_password=$row['student_password'];
					if (sha1($_POST['student_password'])===$student_password) {
						$message="Login success";
						$status=1;
						$sql="SELECT * FROM fcm_tokens WHERE admission_id={$row['admission_id']} AND fcm_token='{$_POST['fcm_token']}'";
						$res=$mysqli->query($sql);
						if($res->num_rows<1){
							$sql="INSERT INTO fcm_tokens (fcm_token, admission_id) VALUES ('{$_POST['fcm_token']}',{$row['admission_id']})";
							$res=$mysqli->query($sql);
							if(!$res){
								$message="Login Success, cannot write FCM token value";
								$status=5;
							}
						}
					}
					else
					{
						$message="Incorrect password";
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
		validate_user();
		break;

		default:
		http_response_code(405);
		break;
	}

}
?>