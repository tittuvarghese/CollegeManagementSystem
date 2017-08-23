<?php
include_once('../../config.php');
$action =$_POST['action'];
if($action=='allot-staff-advisor')
{
	$program = $_POST['program'];
	$department = $_POST['department'];
	$course = $_POST['course'];
	$batch = $_POST['batch'];
	$yoa = $_POST['yoa'];
	$staff = $_POST['staff'];
	
	$StaffAdvisor = mysql_query("SELECT * FROM `staff_advisors` WHERE department_code = '$department' AND program_name='$program' AND course_code='$course' AND batch='$batch'");
	$Exist = mysql_num_rows($StaffAdvisor);
	if($Exist>0)
	{
	$StaffAdvisorAllott = mysql_query("UPDATE `staff_advisors` SET staff_id='$staff' WHERE department_code = '$department' AND program_name='$program' AND course_code='$course' AND batch='$batch'");
	}
	else
	{
		$StaffAdvisorAllott = mysql_query("INSERT into `staff_advisors` (department_code,program_name,course_code,batch,staff_id,year_of_admission) VALUES ('$department','$program','$course','$batch','$staff','$yoa')");
	}
	if($StaffAdvisorAllott)
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