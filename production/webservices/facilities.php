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
	function get_facilities($facility_id=0){
		global $mysqli;
//		$response['fees']=array();

		$query="SELECT * FROM facilities_mas";
		if($facility_id != 0)
		{
			$query.=" WHERE facility_id=".$facility_id." LIMIT 1";
		}
		$result=$mysqli->query($query);
		while($row=$result->fetch_assoc())
		{
			$sql_fees="SELECT course.course_name,fees.* FROM facility_course_fees fees,courses_mas course WHERE fees.facility_id={$row['facility_id']} AND fees.course_id=course.course_id";
			$res_fees=$mysqli->query($sql_fees);
			while ($row_fees=$res_fees->fetch_assoc()) {
//				array_push($response['fees'], $row_fees);
				$row['fees'][]=$row_fees;
			}

			$sql_contacts="SELECT facility.*,contacts.* FROM facility_contacts contacts,facilities_mas facility WHERE facility.facility_id={$row['facility_id']} AND facility.facility_id=contacts.facility_id";
			$res_contacts=$mysqli->query($sql_contacts);
			while ($row_contacts=$res_contacts->fetch_assoc()) {
//        array_push($response['fees'], $row_fees);
				$row['contacts'][]=$row_contacts;
			}
			
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
		if(!empty($_GET["facility_id"]))
		{
			$facility_id=intval($_GET["facility_id"]);
			get_facilities($facility_id);
		}
		else
		{
			get_facilities();
		}
		break;
		default:
		http_response_code(405);
		break;
	}

}
?>