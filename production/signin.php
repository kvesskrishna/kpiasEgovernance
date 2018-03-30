<?php
session_start();
if (isset($_POST['login'])) {
	require 'webservices/dbconfig.php';
	$sql="SELECT * FROM admins WHERE username='{$_POST['username']}'";
	$res=$mysqli->query($sql);
	if($res->num_rows>0)
	{
		$row=$res->fetch_assoc();
		if(sha1($_POST['password'])==$row['password'])
		{
			$_SESSION['login_status']=1;
			$_SESSION['login_message']="Login Success";
			$_SESSION['user']=$row;
		}
		else
		{
			$_SESSION['login_status']=0;
			$_SESSION['login_message']="Incorrect Password";
		}

	}
	else
	{
		$_SESSION['login_status']=0;
		$_SESSION['login_message']="No such user";
	}
	header('Location:login.php');
}
?>