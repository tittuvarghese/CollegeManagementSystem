<?php
include_once('config.php');
session_start();
if(isset($_POST['login-submit']))
{
	$LoginEmail = $_POST['login-email'];
	$LoginPassword = $_POST['login-password'];
	$LoginPassword = md5($LoginPassword);
	$LoginRole = $_POST['login-role'];
	if($LoginRole=='admin')
	 $LoginTable = 'login_admin';
	else if($LoginRole=='staff')
	 $LoginTable = 'login_staff';
	else
	 $LoginTable = 'login_student';
	
	$userAuth = mysql_query("SELECT * from `$LoginTable` WHERE email = '$LoginEmail'");
	$count = mysql_num_rows($userAuth);
	if($count > 0)
	 {
		 while($row = mysql_fetch_array($userAuth))
		 {
			 $LoginPasswordCheck = $row['password'];
			 if($LoginPassword==$LoginPasswordCheck)
			 {
				 $LoginStatus = "Success";
				 $UserAuthData = array();
				 $UserAuthData['status']='valid';
				 $UserAuthData['email']=$LoginEmail;
				 $UserAuthData['userid']=$row['userid'];
				 $UserAuthData['name']=$row['name'];
				 $UserAuthData['role']=$row['role'];
				 include_once('write_login_log.php');
				 if($LoginRole=='staff')
				 {
				 	$UserAuthData['type']=$row['type'];
				 }
				 if($LoginRole=='staff' || $LoginRole=='student')
				 	$UserAuthData['department']=$row['department'];
				 if($LoginRole=='student')
				 	$UserAuthData['admission_number']=$row['admission_number'];
					
				//Serializing
				$UserAuthData = serialize($UserAuthData);
				//Session Data Storing
				$_SESSION['UserAuthData']=$UserAuthData;
				header('Location: dashboard.php');
			 }
			 else
			 {
				 $LoginStatus = "Failed Password";
		 		 include_once('write_login_log.php');
				 $error= true;
			 }
		 }
	 }
	else
	 {
		 echo "Invalid Username or Password";
		 $LoginStatus = "Failed";
		 include_once('write_login_log.php');
		 $error= true;
	 }
	 if($error)
	  header('Location: ./?login-error=error');
}
else
{
	header('Location: logout.php');
}
?>