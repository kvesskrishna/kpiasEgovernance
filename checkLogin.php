<?php 
session_start();
	define('API_PATH','http://www.kpias.com/egov/production/webservices/');

if(!isset($_SESSION['user'])){

	header('Location:login.php');
}
?>