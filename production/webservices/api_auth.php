<?php
require_once('dbconfig.php');
$response=array();

define('API_KEY', '160e64f13691a2f59d34492dc238f98e');


if(isset($_GET['api_key'])&&!empty($_GET['api_key']))
{
	$apikey = $_GET['api_key'];
	if ($apikey==API_KEY) {
		# code...
		$response['auth_status']=1;
	}
	else
	{
		$response['auth_status']=0;
		http_response_code(401);
	}
}
else
{
	$response['auth_status']=0;
	http_response_code(401);
}
?>