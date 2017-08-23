<?php
session_start();
$UserAuthData = $_SESSION['UserAuthData'];
$UserAuthData = unserialize($UserAuthData);
include_once('../../config.php');
$action = $_POST['action'];
if($action=='fetch_student')
{
	$department = $_POST['department'];
	$program = $_POST['program'];
	$course_code = $_POST['course_code'];
	$batch = $_POST['batch'];
	$yoa = $_POST['yoa'];
	$table = 'stud_'.$yoa.'_main';
	if($batch=='all')
	{
		$sql = mysql_query("SELECT * FROM `$table` WHERE department = '$department' AND program='$program' AND branch='$course_code' AND yearOfAddmission = '$yoa' ORDER BY name ASC");
	}
	else
	{
		$sql = mysql_query("SELECT * FROM `$table` WHERE department = '$department' AND program='$program' AND branch='$course_code' AND yearOfAddmission = '$yoa' AND batch='$batch' ORDER BY name ASC");
	}
 $Count=0;
 echo "<tr>
 <td><strong>#</strong></td>
 <td><strong>Program</strong></td>
 <td><strong>Department</strong></td>
 <td><strong>Branch</strong></td>
 <td><strong>Admission Number</strong></td>
 <td><strong>Name</strong></td>
 <td><strong>Sex</strong></td>
 <td><strong>Roll Number</strong></td>
 <td><strong>Register Number</strong></td>";
 if($UserAuthData['role']=='admin' || ($UserAuthData['role']=='hod'&&$UserAuthData['department']==$department_code))
	{
 echo "<td><strong>Operation</strong></td>";
	}
 echo "</tr>";
 while ($row = mysql_fetch_array($sql))
 {
	 $Count++;
	 echo "<tr>";
	 echo "<td>".$Count."</td>";
	 echo "<td>".$row['program']."</td>";
	 echo "<td>".$row['department']."</td>";
	 echo "<td>".$row['branch']."</td>";
	 echo "<td>".$row['admno']."</td>";
	 echo "<td>".$row['name']."</td>";
	 echo "<td>".$row['sex']."</td>";
	 echo "<td>".$row['rollNo']."</td>";
	 echo "<td>".$row['regno']."</td>";
	 if($UserAuthData['role']=='admin' || ($UserAuthData['role']=='hod'&&$UserAuthData['department']==$department_code))
	{
	 echo "<td><a href='delete.php?p=student&id=".$row['id']."'><button type='button' class='btn btn-danger'>Delete</button></a></td>";
	}
	 echo "</tr>";
 }
}
?>
