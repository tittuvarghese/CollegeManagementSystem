<?php
include_once('../../config.php');
$action = $_POST['action'];
if($action=='register-new-batch')
{
	$program_name = mysql_real_escape_string($_POST['program_name']);
	$year_of_admission = mysql_real_escape_string($_POST['year_of_admission']);
	$acadamic_scheme = mysql_real_escape_string($_POST['acadamic_scheme']);
	$current_semester = '1';
	$sql = mysql_query("INSERT into `academic_data` (course,admission_year,university_scheme,current_semester) values ('$program_name','$year_of_admission','$acadamic_scheme','$current_semester')");
	//Generating Tables For Academic Year
	//Table 1
	$table_1 = mysql_query("CREATE TABLE IF NOT EXISTS `stud_".$year_of_admission.'_main'."` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `program` varchar(50) NOT NULL,
  `batch` varchar(50) NOT NULL,
  `admno` varchar(50) NOT NULL,
  `rollNo` int(10) NOT NULL,
  `regno` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `address` varchar(500) NOT NULL,
  `religion` varchar(20) NOT NULL,
  `cast` varchar(20) NOT NULL,
  `rsvgroup` varchar(20) NOT NULL,
  `fathername` varchar(50) NOT NULL,
  `fatheroccupation` varchar(50) NOT NULL,
  `yearOfAddmission` varchar(20) NOT NULL,
  `dateOfBirth` varchar(20) NOT NULL,
  `f_mob` varchar(15) NOT NULL,
  `lg_mob` varchar(15) NOT NULL,
  `currentsem` varchar(20) NOT NULL,
  `blood_group` varchar(20) NOT NULL,
  `income` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `p_email` varchar(100) NOT NULL,
  `name_localG` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
	
	//Table 2
	$table_2 = mysql_query("CREATE TABLE IF NOT EXISTS `stud_".$year_of_admission.'_attendance'."` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `batch` varchar(10) NOT NULL DEFAULT '1',
  `date` date NOT NULL,
  `period` varchar(20) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'TH',
  `duration` int(10) NOT NULL DEFAULT '1',
  `teacher` varchar(10) NOT NULL,
  `from` varchar(10) NOT NULL,
  `to` varchar(10) NOT NULL,
  `absents` varchar(500) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

	//Table 3
	$table_3 = mysql_query("CREATE TABLE IF NOT EXISTS `stud_".$year_of_admission.'_data'."` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `add_no` varchar(20) NOT NULL,
  `subject_code` varchar(20) NOT NULL,
  `catogory` varchar(20) NOT NULL,
  `value` varchar(20) NOT NULL,
  `remark` varchar(20) NOT NULL,
  `batch` varchar(10) NOT NULL DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");
	if($sql && $table_1 && $table_2 && $table_3)
	 $response['response']="success";
	else
	 $response['response']="error";
	
	$response = json_encode($response); 
	echo $response;
}
else if($action=='update_semester')
{
	$update_id = mysql_real_escape_string($_POST['update_id']);
	$update_semester = mysql_real_escape_string($_POST['update_semester']);
	$update_start_date = mysql_real_escape_string($_POST['update_start_date']);
	$update_end_date = mysql_real_escape_string($_POST['update_end_date']);
	$sql = mysql_query("UPDATE `academic_data` SET current_semester='$update_semester', semester_starting_date='$update_start_date', semester_ending_date='$update_end_date' WHERE id='$update_id'");

	if($sql)
	 $response['response']="success";
	else
	 $response['response']="error";
	
	$response = json_encode($response); 
	echo $response;

}
?>