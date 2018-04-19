<?php
require_once('api_auth.php');

if ($response['auth_status']==1) { 

$verb = $_SERVER['REQUEST_METHOD'];

//HANDLE POST REQUEST START
//-----------------------
//-----------------------
//HANDLE POST REQUEST END


//HANDLE GET REQUEST START
//-----------------------
	function get_admissions($admission_id=0){
		global $mysqli;

		$query="SELECT admissions.*,courses.course_name,facilities.facility_name FROM admissions_mas admissions, courses_mas courses, facilities_mas facilities WHERE admissions.facility_id=facilities.facility_id AND admissions.course_id=courses.course_id";
		if($admission_id != 0)
		{
			$query.=" AND admission_id=".$course_id." LIMIT 1";
		}
		$result=$mysqli->query($query);
		while($row=$result->fetch_assoc())
		{
			$response[]=$row;
		}
		header('Content-Type: application/json');
		echo json_encode($response, JSON_UNESCAPED_SLASHES);
	}
//-----------------------
//HANDLE GET REQUEST END

//HANDLE PUT REQUEST START
//-----------------------

//-----------------------
//HANDLE PUT REQUEST END


//HANDLE DELETE REQUEST START
//-----------------------

//-----------------------
//HANDLE DELETE REQUEST END

switch ($verb) {
	case 'GET':
		if(!empty($_GET["admission_id"]))
			{
				$admission_id=intval($_GET["admission_id"]);
				get_admissions($admission_id);
			}
			else
			{
				get_admissions();
			}
		break;
	default:
		http_response_code(405);
		break;
}

}
?>