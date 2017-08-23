<?php
include_once('../../config.php');
$action = $_POST['action'];
if($action=='feed_back_add_question')
{
	 $department_code = $_POST['department_code'];
	 $question = $_POST['question'];
	 $sql = mysql_query("INSERT into `feedback_questions` (department_code,question) values ('$department_code','$question')");
	 if($sql)
	  $result['response']='success';
	 else
	  $result['response']='error';
	 
	 $result = json_encode($result);
	 echo $result;
}
?>