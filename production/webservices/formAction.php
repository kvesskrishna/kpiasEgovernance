<?php

require '../checkLogin.php';
require 'dbconfig.php';
require '../PHPMailer/SMTPMailer.php';
function addCourse(){
	global $mysqli;
	$sql="INSERT INTO courses_mas (course_name, course_description, course_duration) VALUES ('{$mysqli->real_escape_string($_POST['course_name'])}','{$mysqli->real_escape_string($_POST['course_description'])}','{$mysqli->real_escape_string($_POST['course_duration'])}')";
	$res=$mysqli->query($sql);
	if ($res) {
		$_SESSION['action_message']="Record inserted successfully";
		header('Location:../manageCourses');
	}
	else{
		die($mysqli->error);
	}
}
function editCourse(){
	global $mysqli;
	$course_status=0;
	if(isset($_POST['course_status'])){
		$course_status=1;
	}
	$sql="UPDATE courses_mas SET course_name='{$mysqli->real_escape_string($_POST['course_name'])}', course_description='{$mysqli->real_escape_string($_POST['course_description'])}', course_duration= '{$mysqli->real_escape_string($_POST['course_duration'])}',course_status=$course_status, course_modified=now() WHERE course_id={$_POST['course_id']}";
	$res=$mysqli->query($sql);
	if ($res) {
		$_SESSION['action_message']="Record updated successfully";
		header('Location:../manageCourses');
	}
	else{
		die($mysqli->error);
	}
}
function deleteCourse($course_id){
	global $mysqli;
	$sql="DELETE FROM courses_mas WHERE course_id={$course_id}";
	$res=$mysqli->query($sql);
	if ($res) {
		$_SESSION['action_message']="Record deleted successfully";
		header('Location:../manageCourses');
	}
	else{
		die($mysqli->error);
	}
}
function addBatch(){
	global $mysqli;
	$sql="INSERT INTO batches (batch_name, batch_description, batch_start, course_id) VALUES ('{$mysqli->real_escape_string($_POST['batch_name'])}','{$mysqli->real_escape_string($_POST['batch_description'])}','{$_POST['batch_start']}',{$_POST['course_id']})";
	$res=$mysqli->query($sql);
	if ($res) {
		$_SESSION['action_message']="Record inserted successfully";
		header('Location:../manageBatches');
	}
	else{
		die($mysqli->error);
	}
}
function editBatch(){
	global $mysqli;
	$batch_status=0;
	if(isset($_POST['batch_status'])){
		$batch_status=1;
	}
	$sql="UPDATE batches SET batch_name='{$mysqli->real_escape_string($_POST['batch_name'])}', batch_description='{$mysqli->real_escape_string($_POST['batch_description'])}', course_id='{$_POST['course_id']}',batch_status=$batch_status, batch_start='{$_POST['batch_start']}', batch_modified=now() WHERE batch_id={$_POST['batch_id']}";
	$res=$mysqli->query($sql);
	if ($res) {
		$_SESSION['action_message']="Record updated successfully";
		header('Location:../manageBatches');
	}
	else{
		die($mysqli->error);
	}
}
function deleteBatch($batch_id){
	global $mysqli;
	$sql="DELETE FROM batches WHERE batch_id={$batch_id}";
	$res=$mysqli->query($sql);
	if ($res) {
		$_SESSION['action_message']="Record deleted successfully";
		header('Location:../manageBatches');
	}
	else{
		die($mysqli->error);
	}
}
function addFacility(){
	global $mysqli;
	$hostel_avail=0;
	if(isset($_POST['facility_hostel_available'])){
		$hostel_avail=1;
	}
	$sql="INSERT INTO facilities_mas (facility_code,facility_name, facility_hostel_available,facility_address1,facility_address2,facility_locality,facility_city,facility_state) VALUES ('{$mysqli->real_escape_string($_POST['facility_code'])}','{$mysqli->real_escape_string($_POST['facility_name'])}','{$mysqli->real_escape_string($hostel_avail)}','{$_POST['facility_address1']}','{$_POST['facility_address2']}','{$mysqli->real_escape_string($_POST['facility_locality'])}','{$mysqli->real_escape_string($_POST['facility_city'])}','{$mysqli->real_escape_string($_POST['facility_state'])}')";

	$res=$mysqli->query($sql);
	if ($res) {
		$_SESSION['action_message']="Record inserted successfully";
		header('Location:../editFacility?id='.$mysqli->insert_id);
	}
	else{
		die($mysqli->error);
	}
}
function editFacility(){
	global $mysqli;
	$hostel_avail=0;
	if(isset($_POST['facility_hostel_available'])){
		$hostel_avail=1;
	}
	$status=0;
	if(isset($_POST['facility_status'])){
		$status=1;
	}
	$sql="UPDATE facilities_mas SET facility_code='{$mysqli->real_escape_string($_POST['facility_code'])}',facility_name='{$mysqli->real_escape_string($_POST['facility_name'])}',facility_hostel_available='{$mysqli->real_escape_string($hostel_avail)}',facility_address1='{$_POST['facility_address1']}',facility_address2='{$_POST['facility_address2']}',facility_locality='{$mysqli->real_escape_string($_POST['facility_locality'])}',facility_city='{$mysqli->real_escape_string($_POST['facility_city'])}',facility_state='{$mysqli->real_escape_string($_POST['facility_state'])}',facility_status=$status WHERE facility_id={$_POST['facility_id']}";

	$res=$mysqli->query($sql);
	if ($res) {
		$_SESSION['action_message']="Record udpated successfully";
		header('Location:'.$_SERVER['HTTP_REFERER']);
	}
	else{
		die($mysqli->error);
	}
}
function editFacilityFee(){
	global $mysqli;
	$sql="DELETE FROM facility_course_fees WHERE facility_id=".$_POST['facility_id'];
	$res=$mysqli->query($sql);

	for ($i=0; $i < count($_POST['course_id']); $i++) { 
		# code...
		if(!empty($_POST['course_id'][$i])){
			$sqli="INSERT INTO facility_course_fees (facility_id,course_id,fee_amount,hostel_fee) VALUES ({$_POST['facility_id']},{$_POST['course_id'][$i]},{$_POST['fee_amount'][$i]},{$_POST['hostel_fee'][$i]})";
			$resi=$mysqli->query($sqli);
		}
	}
	if ($resi) {
		$_SESSION['action_message']="Record inserted successfully";
		header('Location:'.$_SERVER['HTTP_REFERER']);
	}
	else{
		die($mysqli->error);
	}
}
function editFacilityContacts(){
	global $mysqli;
	$sql="DELETE FROM facility_contacts WHERE facility_id=".$_POST['facility_id'];
	$res=$mysqli->query($sql);

	for ($i=0; $i < count($_POST['contact_name']); $i++) { 
		# code...
		if(!empty($_POST['contact_name'][$i])){
			$sqli="INSERT INTO facility_contacts (facility_id,contact_name,contact_email,contact_phone) VALUES ({$_POST['facility_id']},'{$mysqli->real_escape_string($_POST['contact_name'][$i])}','{$mysqli->real_escape_string($_POST['contact_email'][$i])}','{$mysqli->real_escape_string($_POST['contact_phone'][$i])}')";
			$resi=$mysqli->query($sqli);
		}
	}
	if ($resi) {
		$_SESSION['action_message']="Record inserted successfully";
		header('Location:'.$_SERVER['HTTP_REFERER']);
	}
	else{
		die($mysqli->error);
	}
}
function addAdmission(){
	global $mysqli;
	$hostelfee=0;
if (isset($_POST['hostel'])) {
	if($_POST['hostel']==1){
		$sql_hostel="SELECT hostel_fee FROM facility_course_fees WHERE facility_id={$_POST['facility_id']} AND course_id={$_POST['course_id']}";
		$res_hostel=$mysqli->query($sql_hostel);
		$row_hostel=$res_hostel->fetch_assoc();
		$hostelfee=$row_hostel['hostel_fee'];
	}
}
$facility_id=$_POST['facility_id'];
$sql_check="SELECT facility_code FROM facilities_mas WHERE facility_id={$facility_id}";
$res_check=$mysqli->query($sql_check);
$row_check=$res_check->fetch_assoc();
$year=date('Y');
$facility_code=$row_check['facility_code'];
$sql_check="SELECT COUNT(*) AS count FROM admission_codes WHERE facility_code='{$facility_code}' AND adm_year={$year}";
$res_check=$mysqli->query($sql_check);
$row_check=$res_check->fetch_assoc();
$count=$row_check['count']+1;
$admission_code=$facility_code.'-'.$year.'-'.str_pad($count,4,"0",STR_PAD_LEFT);
$password=strtoupper(substr(sha1($_POST['student_email'].time()), 0,8));
$encpassword=sha1($password);
$message="
Dear {$_POST['student_firstname']},<br>
Thank you for your admission with KPIAS, following are the credentials to manage your admission at KPIAS Online.
<br>URL: http://www.kpias.com/login
<br>Login ID: {$_POST['student_email']}
<br>Password: {$password}
<br><b>Note: Please change your password after your first Login.</b>
<p>
Thanks and Regards,<br>
Admissions Team,<br>	
Krishna Pradeep's IAS.
</p>
";
	$sql="INSERT INTO `admissions_mas` (`admission_id`, `admission_code`, `facility_id`, `course_id`, `course_fee_concession`, `actual_course_fee`, `total_course_fee`,`total_hostel_fee`, `fee_paid`, `student_firstname`, `student_middlename`, `student_lastname`, `student_dob`, `student_address1`, `student_address2`, `student_locality`, `student_city`, `student_state`, `student_email`, `student_phone`, `student_password`, `student_gender`, `admission_date`, `student_father`, `student_mother`, `admission_notes`, `admission_status`, `admission_created`, `admission_modified`) VALUES (NULL, '{$admission_code}', '{$_POST['facility_id']}', '{$_POST['course_id']}', '{$_POST['course_fee_concession']}', '{$_POST['actual_course_fee']}', '{$_POST['total_course_fee']}','{$hostelfee}', '0', '{$mysqli->real_escape_string($_POST['student_firstname'])}', '{$mysqli->real_escape_string($_POST['student_middlename'])}', '{$mysqli->real_escape_string($_POST['student_lastname'])}', '{$_POST['student_dob']}', '{$mysqli->real_escape_string($_POST['student_address1'])}', '{$mysqli->real_escape_string($_POST['student_address2'])}', '{$mysqli->real_escape_string($_POST['student_locality'])}', '{$mysqli->real_escape_string($_POST['student_city'])}', '{$mysqli->real_escape_string($_POST['student_state'])}', '{$mysqli->real_escape_string($_POST['student_email'])}', '{$mysqli->real_escape_string($_POST['student_phone'])}', '{$encpassword}', '{$mysqli->real_escape_string($_POST['student_gender'])}', '{$_POST['admission_date']}', '{$mysqli->real_escape_string($_POST['student_father'])}', '{$mysqli->real_escape_string($_POST['student_mother'])}','{$mysqli->real_escape_string($_POST['admission_notes'])}', '1', CURRENT_TIMESTAMP, NULL)";
	//echo $sql;
	$res=$mysqli->query($sql);
	if ($res) {
		$admission_id=$mysqli->insert_id;
		$sql="INSERT INTO admission_codes (admission_id,admission_code,facility_code,adm_year) VALUES ($admission_id,'{$admission_code}','$facility_code','$year')";
		$res=$mysqli->query($sql);
		SMTPMailer($_POST['student_email'], 'KPIAS E-Governance Account Details', $message);
		if(!$res){
			die($mysqli->error);
		}
		$_SESSION['action_message']="Record inserted successfully";
		header('Location:../manageAdmissions');
	}
	else{
		die($mysqli->error);
	}
}



switch ($_SERVER['REQUEST_METHOD']) {
	case 'POST':
	$action=$_POST['action'];
	switch ($action) 
	{
		case 'addCourse':
		addCourse();
		break;
		case 'editCourse':
		editCourse();
		break;
		case 'addBatch':
		addBatch();
		break;
		case 'editBatch':
		editBatch();
		break;
		case 'addFacility':
		addFacility();
		break;
		case 'editFacility':
		editFacility();
		break;
		case 'editFacilityFee':
		editFacilityFee();
		break;		
		case 'editFacilityContacts':
		editFacilityContacts();
		break;		
		case 'addAdmission':
		addAdmission();
		break;		
		default:
		die('Action not specified');	
		break;
	}
	break;

	case 'GET':
	$action=$_GET['action'];
	switch ($action) 
	{
		case 'deleteCourse':
		deleteCourse($_GET['course_id']);
		break;
		case 'deleteBatch':
		deleteBatch($_GET['batch_id']);
		break;
		default:
		die('Action not specified');	
		break;
	}
	break;
	
	default:	
	die('Method Not Implemented');
	break;
}
?>