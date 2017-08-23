<?php
include_once('../../config.php');
$action =$_POST['action'];
if($action=='allot-hod')
{
	$hod = $_POST['hod'];
	$department = $_POST['department'];
	
	mysql_query("UPDATE `login_staff` SET role='staff' WHERE role='hod' AND department='$department'");
	$HODInsert = mysql_query("UPDATE `login_staff` SET role='hod' WHERE userid='$hod' AND department='$department'");
	if($HODInsert)
	 {
		 $response['response']="success";
	 }
	else
	 {
		 $response['response']="error";
	 }
	 $response = json_encode($response); 
	 echo $response;
}
?>