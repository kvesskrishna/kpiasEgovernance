<?php
require 'checkLogin.php';
$ch = curl_init();  
curl_setopt($ch,CURLOPT_URL, API_PATH.'facilities?api_key=160e64f13691a2f59d34492dc238f98e&facility_id='.$_GET['facility_id']);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$response=curl_exec($ch);
curl_close($ch);
$result = json_decode($response);
foreach ($result[0]->fees as $courses) {
	if ($courses->course_id==$_GET['course_id']) {
		echo $courses->fee_amount;
	}
}
?>