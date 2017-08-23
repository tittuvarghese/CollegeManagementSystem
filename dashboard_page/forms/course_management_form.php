<?php
include_once('../../config.php');
$action = $_POST['action'];
if($action=='register-new-program')
{
	$program_name = mysql_real_escape_string($_POST['program_name']);
	$sql = mysql_query("INSERT into `programs` (program_name) values ('$program_name')");
	if($sql)
	 $response['response']="success";
	else
	 $response['response']="error";
	
	$response = json_encode($response); 
	echo $response;
}
else if($action=='register-new-department')
{
	$department_name = mysql_real_escape_string($_POST['department_name']);
	$department_code = mysql_real_escape_string($_POST['department_code']);
	$department_code = strtoupper($department_code);
	$sql = mysql_query("INSERT into `department` (department_name,department_code) values ('$department_name','$department_code')");
	if($sql)
	 $response['response']="success";
	else
	 $response['response']="error";
	
	$response = json_encode($response); 
	echo $response;
}
else if($action=='register-new-course')
{
	$course_program = mysql_real_escape_string($_POST['course_program']);
	$course_name = mysql_real_escape_string($_POST['course_name']);
	$course_code = mysql_real_escape_string($_POST['course_code']);
	$course_code = strtoupper($course_code);
	$course_department = mysql_real_escape_string($_POST['course_department']);
	$course_batches = mysql_real_escape_string($_POST['course_batches']);
	$course_semester = mysql_real_escape_string($_POST['course_semester']);
	$course_students = mysql_real_escape_string($_POST['course_students']);
	$sql = mysql_query("INSERT into `courses` (program_name,course_name,course_code,department_code,course_semester, 	course_seats,course_batch) values ('$course_program','$course_name','$course_code','$course_department','$course_semester','$course_students','$course_batches')");
	if($sql)
	 $response['response']="success";
	else
	 $response['response']="error";
	
	$response = json_encode($response); 
	echo $response;
}
?>