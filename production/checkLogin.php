<?php 
session_start();
	define('API_PATH','http://localhost/kpias-egovernance/workspace/production/webservices/');

if(!isset($_SESSION['user'])){

	header('Location:login.php');
}
?>