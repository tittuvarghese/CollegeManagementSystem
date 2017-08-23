<?php
session_start();
$UserAuthData = $_SESSION['UserAuthData'];
$UserAuthData = unserialize($UserAuthData);
include_once('../config.php');
$action = $_POST['action'];
if($action=='fetch-program')
{
	$sql = mysql_query("SELECT * FROM `programs` ORDER BY id DESC");
	echo "<tr>
    <td><strong>Name</strong></td>";
	if($UserAuthData['role']=='admin')
	{
    echo "<td><strong>Operation</strong></td>";
	}
 echo "</tr>";
  	while($row=mysql_fetch_array($sql))
   	{
	   echo '<tr>';
	   echo '<td>'.$row['program_name'].'</td>';
	   if($UserAuthData['role']=='admin')
	{
	   echo "<td><a href='delete.php?p=delete-program&id=".$row['id']."'><button type='button' class='btn btn-danger'>Delete</button></a></td>";
	}
	   echo '</tr>';
   }
   if($UserAuthData['role']=='admin')
	{
   echo '<tr>
    <td colspan="2"><a href="#">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#RegisterNewProgram">Register New Program</button>
      </a></td>
  </tr>';
	}
}
else if($action=='fetch-department')
{
	$sql = mysql_query("SELECT * FROM `department` ORDER BY id DESC");
	echo "<tr>
    <td><strong>Department Name</strong></td>
    <td><strong>Department Code</strong></td>";
	if($UserAuthData['role']=='admin')
	{
    echo "<td><strong>Operation</strong></td>";
	}
  echo "</tr>";
  while($row=mysql_fetch_array($sql))
   {
	   echo '<tr>';
	   echo '<td>'.$row['department_name'].'</td>';
	   echo '<td>'.$row['department_code'].'</td>';
	   if($UserAuthData['role']=='admin')
	{
	   echo "<td><a href='delete.php?p=delete-department&id=".$row['id']."'><button type='button' class='btn btn-danger'>Delete</button></a></td>";
	}
	   echo '</tr>';
   }
  if($UserAuthData['role']=='admin')
	{
  echo '<tr>
    <td colspan="3"><a href="#">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#RegisterNewDepartment">Register New Department</button>
      </a></td>
  </tr>';
	}
}
else if($action=='fetch-course')
{
	echo "<tr>
    <td><strong>Program</strong></td>
    <td><strong>Course Name</strong></td>
    <td><strong>Batches</strong></td>
    <td><strong>Department</strong></td>
    <td><strong>No. of Semesters</strong></td>
    <td><strong>No. of Students</strong></td>";
	if($UserAuthData['role']=='admin' || $UserAuthData['role']=='hod')
	{
    echo "<td><strong>Operation</strong></td>";
	}
  echo "</tr>";
	  $sql = mysql_query("SELECT * FROM `courses` ORDER BY id DESC");
  while($row=mysql_fetch_array($sql))
   {
	   echo '<tr>';
	   echo '<td>'.$row['program_name'].'</td>';
	   echo '<td>'.$row['course_name'].' ('.$row['course_code'].')</td>';
	   echo '<td>'.$row['course_batch'].'</td>';
	   echo '<td>'.$row['department_code'].'</td>';
	   echo '<td>'.$row['course_semester'].'</td>';
	   echo '<td>'.$row['course_seats'].'</td>';
	   if($UserAuthData['role']=='admin')
	{
	   echo "<td><a href='delete.php?p=delete-course&id=".$row['id']."'><button type='button' class='btn btn-danger'>Delete</button></a></td>";
	}
	else if($UserAuthData['role']=='hod' && $UserAuthData['department']==$row['department_code'])
	{
	echo "<td><a href='delete.php?p=delete-course&id=".$row['id']."'><button type='button' class='btn btn-danger'>Delete</button></a></td>";	
	}
	else if($UserAuthData['role']=='hod' && $UserAuthData['department']!=$row['department_code'])
	{
		echo "<td>No Permission</td>";
	}
	   echo '</tr>';
   }
   if($UserAuthData['role']=='admin' || $UserAuthData['role']=='hod')
   {
  echo '<tr>
    <td colspan="7"><a href="#">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#RegisterNewCourse">Register New Course</button>
      </a></td>
  </tr>';
   }
}
else if($action=='fetch-academic-data')
{
	echo "<tr>
    <td><strong>Course</strong></td>
    <td><strong>Admission</strong></td>
    <td><strong>Scheme</strong></td>
    <td><strong>Current Semester</strong></td>
    <td><strong>Start Date</strong></td>
    <td><strong>End Date</strong></td>";
    if($UserAuthData['role']=='admin')
	{
	echo "<td><strong>Operation</strong></td>";
	}
	echo "</tr>";
	$AcadamicManagement = mysql_query("SELECT * FROM `academic_data` ORDER BY admission_year DESC");
  while ($row = mysql_fetch_array($AcadamicManagement))
  {
	$current_semester = $row['current_semester'];
	if($current_semester=='0')
	 $current_semester="Passout";
	  echo '<tr>
    <td>'.$row['course'].'</td>
    <td>'.$row['admission_year'].'</td>
    <td>'.$row['university_scheme'].'</td>
    <td>'.$current_semester.'</td>
    <td>'.$row['semester_starting_date'].'</td>
    <td>'.$row['semester_ending_date'].'</td>';
    if($UserAuthData['role']=='admin')
	{
		echo "<td><a onclick=".'"SetSemester('."'".$row['id']."','".$row['course']."','".$row['admission_year']."','".$row['current_semester']."','".$row['semester_starting_date']."','".$row['semester_ending_date']."');".'"'."><button type='button' class='btn btn-info'>Edit</button></a> <a href='delete.php?p=delete-acadamic_year&id=".$row['id']."'><button type='button' class='btn btn-danger'>Delete</button></a></td>";
	}
  echo '</tr>';
  }
  if($UserAuthData['role']=='admin')
	{
  echo '<tr>
    <td colspan="7"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#RegisterNewBatch">Register New Batch</button></td>
  </tr>';
	}
}
else if($action=='fetch-subject-management')
{
	$program=$_POST['program'];
	$course_code = $_POST['course_code'];
	$scheme = $_POST['scheme'];
	$semester = $_POST['semester'];
	$department = $_POST['department'];
	$Count=0;
echo '<tr>
    <td><strong>#</strong></td>
    <td><strong>Subject Code</strong></td>
    <td><strong>Subject Name</strong></td>
    <td><strong>Type</strong></td>
    <td><strong>Internal</strong></td>
    <td><strong>External</strong></td>
    <td><strong>Hours</strong></td>';
	if($UserAuthData['role']=='admin' || ($UserAuthData['role']=='hod'&&$UserAuthData['department']==$department))
    	echo '<td><strong>Operation</strong></td>';
    echo '</tr>';
$SubjectData = mysql_query("SELECT * FROM `semester_subject` WHERE program='$program' AND course='$course_code' AND scheme='$scheme' AND semester='$semester' AND department='$department' ORDER BY subj_code ASC,subj_code_sub ASC");
while($row=mysql_fetch_array($SubjectData))
{
	$Count++;
	echo '<tr>';
	echo '<td>'.$Count.'</td>';
	echo '<td>'.$row['subj_code'].' '.$row['subj_code_sub'].'</td>';
	echo '<td>'.$row['subj_name'].'</td>';
	echo '<td>'.$row['type'].'</td>';
	echo '<td>'.$row['in_mark'].'</td>';
	echo '<td>'.$row['ex_mark'].'</td>';
	echo '<td>'.$row['hours'].'</td>';
	if($UserAuthData['role']=='admin')
		echo "<td><a href='delete.php?p=delete-subject&id=".$row['id']."'><button type='button' class='btn btn-danger'>Delete</button></a></td>";
	else if($UserAuthData['role']=='hod')
	{
		if($UserAuthData['department']==$department)
			echo "<td><a href='delete.php?p=delete-subject&id=".$row['id']."'><button type='button' class='btn btn-danger'>Delete</button></a></td>";
		else
		 echo "No Permission";
	}
	echo '</tr>';
}
 if($UserAuthData['role']=='admin' || ($UserAuthData['role']=='hod'&&$UserAuthData['department']==$department))
 {
  echo '<tr>
    <td colspan="8" class="text-center"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#AddNewSubject">Add New Subject</button></td>
  </tr>';
 }
}
else if($action=='fetch-subject-allotment')
{
	echo "<tr>
    <td><strong>#</strong></td>
    <td><strong>Subject Code</strong></td>
    <td><strong>Subject Name</strong></td>
    <td><strong>Teacher</strong></td>";
    if($UserAuthData['role']=='admin' || ($UserAuthData['role']=='hod'&&$UserAuthData['department']==$department))
    	echo '<td><strong>Operation</strong></td>';
    echo '</tr>';
function array_orderby()
{
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
            $args[$n] = $tmp;
            }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}

	$program=$_POST['program'];
	$course_code = $_POST['course_code'];
	$scheme = $_POST['scheme'];
	$batch = $_POST['batch'];
	$semester = $_POST['semester'];
	$department = $_POST['department'];
	
	$Count=0;
$SubjectData = mysql_query("SELECT ss.subj_code,ss.subj_code_sub,ss.subj_name,sa.teacher_id,ls.name FROM semester_subject ss JOIN subject_allotment sa on sa.subject_code = ss.subj_code AND sa.subject_code_sub=ss.subj_code_sub JOIN login_staff ls on ls.userid=sa.teacher_id WHERE sa.program='$program' AND sa.course='$course_code' AND sa.semester='$semester' AND sa.department_id='$department' AND sa.batch='$batch' AND sa.scheme='$scheme' ORDER BY sa.subject_code ASC,sa.subject_code_sub ASC");
$DataSets = array(); $DataSet = array(); $PushedData = array(); 
array_push($PushedData,'tbicea'); //Array Search Wont work with position 0
while($row=mysql_fetch_array($SubjectData,MYSQL_ASSOC))
{
	if($row['subj_code_sub']!='')
	 {
		 $SubjectCode = "'".$row['subj_code']."','".$row['subj_code_sub']."','".$row['subj_name']."'";
	 }
	 else
	  {
		  $SubjectCode = "'".$row['subj_code']."','"."','".$row['subj_name']."'";
	  }
	if(!empty($PushedData))
	  $unique = array_search($row['subj_code'].$row['subj_code_sub'],$PushedData);
	if($unique=='')
	 {
	$DataSet['subj_code']=$row['subj_code'];
	$DataSet['subj_code_sub']=$row['subj_code_sub'];
	$DataSet['subj_name']=$row['subj_name'];
	$DataSet['subj_name']=$row['subj_name'];
	$DataSet['name']=$row['name'];
	$DataSet['SubjectCode']=$SubjectCode;
	array_push($DataSets,$DataSet);
	array_push($PushedData,$DataSet['subj_code'].$DataSet['subj_code_sub']);
	 }
}
$SubjectData = mysql_query("SELECT * FROM `semester_subject` WHERE program='$program' AND course='$course_code' AND scheme='$scheme' AND semester='$semester' AND department='$department' ORDER BY subj_code ASC,subj_code_sub ASC");
while($row=mysql_fetch_array($SubjectData))
{
	if($row['subj_code_sub']!='')
	 {
		 $SubjectCode = "'".$row['subj_code']."','".$row['subj_code_sub']."','".$row['subj_name']."'";
	 }
	 else
	  {
		  $SubjectCode = "'".$row['subj_code']."','"."','".$row['subj_name']."'";
	  }
	$unique = array_search($row['subj_code'].$row['subj_code_sub'],$PushedData);
	if($unique=='')
	{
	$DataSet['subj_code']=$row['subj_code'];
	$DataSet['subj_code_sub']=$row['subj_code_sub'];
	$DataSet['subj_name']=$row['subj_name'];
	$DataSet['subj_name']=$row['subj_name'];
	$DataSet['name']="No Staff";
	$DataSet['SubjectCode']=$SubjectCode;
	array_push($DataSets,$DataSet);
	array_push($PushedData,$DataSet['subj_code'].$DataSet['subj_code_sub']);
	}
}
$DataSets = array_orderby($DataSets, 'subj_code', SORT_ASC, 'subj_code_sub', SORT_ASC);
foreach ($DataSets as $Data)
 {
	$Count++;
	echo '<tr>';
	echo '<td>'.$Count.'</td>';
	echo '<td>'.$Data['subj_code'].' '.$Data['subj_code_sub'].'</td>';
	echo '<td>'.$Data['subj_name'].'</td>';
	echo '<td>'.$Data['name'].'</td>';
	if($UserAuthData['role']=='admin')
	{
	echo '<td class="text-center"><button onclick="AllotTeacherPopupFill('.$Data['SubjectCode'].');" type="button" class="btn btn-success" data-toggle="modal" data-target="#AllotStaff">Allot Teacher</button>';
	}
	else if($UserAuthData['role']=='hod'&&$UserAuthData['department']==$department)
	 echo '<td class="text-center"><button onclick="AllotTeacherPopupFill('.$Data['SubjectCode'].');" type="button" class="btn btn-success" data-toggle="modal" data-target="#AllotStaff">Allot Teacher</button>';
	else
	 echo "No Permission";
	echo '</tr>';
 }
}
else if($action=='fetch-staff-advisors')
{
	
}
?>