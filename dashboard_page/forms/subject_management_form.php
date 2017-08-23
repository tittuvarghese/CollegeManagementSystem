<?php
include_once('../../config.php');
$action =$_POST['action'];
if($action=='add_new_subject')
{
	$department = $_POST['department'];
	$program = $_POST['program'];
	$course = $_POST['course'];
	$scheme = $_POST['scheme'];
	$semester = $_POST['semester'];
	$code = $_POST['code'];
	$code_sub = $_POST['code_sub'];
	$name = $_POST['name'];
	$type = $_POST['type'];
	$hours = $_POST['hours'];
	$internal = $_POST['internal'];
	$external = $_POST['external'];
	
	$sql=mysql_query("INSERT into `semester_subject` (subj_code,subj_name,type,subj_code_sub,department,scheme,semester,course,program,hours,in_mark,ex_mark) values ('$code','$name','$type','$code_sub','$department','$scheme','$semester','$course','$program','$hours','$internal','$external')");
	if($sql)
	 $response['response']="success";
	else
	 $response['response']= mysql_error();;
	
	$response = json_encode($response); 
	echo $response;
}
else if($action=='allot_staff')
{
	$program_name=$_POST['program_name'];
	$course=$_POST['course'];
	$batch=$_POST['batch'];
	$semester=$_POST['semester'];
	$course_code=$_POST['course_code'];
	$course_code_sub=$_POST['course_code_sub'];
	$scheme=$_POST['scheme'];
	$department_from=$_POST['department_from'];
	$alloted_staff=$_POST['alloted_staff'];
	$department = $_POST['department'];

	 $AllotStaff  = mysql_query("SELECT * FROM `subject_allotment` WHERE subject_code='$course_code' AND subject_code_sub='$course_code_sub' AND course='$course' AND department_id='$department' AND program='$program_name' AND batch='$batch' AND semester='$semester' AND scheme='$scheme'");
	$coutRow = mysql_num_rows($AllotStaff);
	if($coutRow>0)
	{
		$AllotUpdate = mysql_query("UPDATE `subject_allotment` SET teacher_id='$alloted_staff' WHERE subject_code='$course_code' AND subject_code_sub='$course_code_sub' AND course='$course' AND department_id='$department' AND program='$program_name' AND batch='$batch' AND semester='$semester' AND scheme='$scheme'");
		if($AllotUpdate)
		 $response['response']="success";
	else
	 $response['response']=mysql_error();
	
	$response = json_encode($response); 
	echo $response;
	}
	else
	{
		$AllotStaffInsert = mysql_query("INSERT into `subject_allotment` (department_id,course,program,batch,semester,subject_code,subject_code_sub,department_from,teacher_id,scheme) values ('$department','$course','$program_name','$batch','$semester','$course_code','$course_code_sub','$department_from','$alloted_staff','$scheme')");
	if($AllotStaffInsert)
		 $response['response']="success";
	else
	 $response['response']="error";
	
	$response = json_encode($response); 
	echo $response;
	}
}
?>