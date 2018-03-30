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
	function get_courses($course_id=0){
		global $mysqli;

		$query="SELECT * FROM courses_mas";
		if($course_id != 0)
		{
			$query.=" WHERE course_id=".$course_id." LIMIT 1";
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
		if(!empty($_GET["course_id"]))
			{
				$course_id=intval($_GET["course_id"]);
				get_courses($course_id);
			}
			else
			{
				get_courses();
			}
		break;
	default:
		http_response_code(405);
		break;
}

}
?>