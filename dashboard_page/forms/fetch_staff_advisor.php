<?php
session_start();
$UserAuthData = $_SESSION['UserAuthData'];
$UserAuthData = unserialize($UserAuthData);
include_once('../../config.php');
$action = $_POST['action'];
if($action=='fetch_staffadvisor_data')
{
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
	$department_code = $_POST['department_code'];
	$Staff_Advisor = mysql_query("SELECT sa.program_name,sa.batch,sa.year_of_admission,dt.department_name,ct.course_code,ct.course_name,ct.course_batch,ls.name,ad.current_semester FROM staff_advisors sa JOIN department dt on sa.department_code=dt.department_code JOIN courses ct on sa.course_code=ct.course_code JOIN login_staff ls on sa.staff_id=ls.userid JOIN academic_data ad on ad.course=sa.program_name AND ad.admission_year=sa.year_of_admission WHERE sa.department_code='$department_code' ORDER BY sa.program_name ASC");
	$DataSet = array(); $DataSets = array();$PushedData = array(); array_push($PushedData,'tbicea'); $unique=''; $DepartmentName = 0; $count=0; $batch=0;
	
	echo '<tr><td><strong>#</strong></td><td><strong>Program</strong></td><td><strong>Course</strong></td><td><strong>Year of Admission</strong></td><td><strong>Batch</strong></td><td><strong>Current Semester</strong></td><td><strong>Staff Advisor</strong></td>';
	if($UserAuthData['role']=='admin' || $UserAuthData['role']=='hod')
		echo '<td><strong>Operation</strong></td>';
	echo '</tr>';
	while($row=mysql_fetch_array($Staff_Advisor,MYSQL_ASSOC))
	{
		if(!empty($PushedData))
	   		$unique = array_search($row['program_name'].$row['course_name'].$row['year_of_admission'].$row['batch'],$PushedData);
		if($unique=='')
		{
			$DataSet['program_name']=$row['program_name'];
			$DataSet['course_name']=$row['course_name'];
			$DataSet['course_code']=$row['course_code'];
			$DepartmentName = $row['course_name'];
			$DataSet['year_of_admission']=$row['year_of_admission'];
			$DataSet['batch']=$row['batch'];
			$DataSet['current_semester']=$row['current_semester'];
			$DataSet['name']=$row['name'];
			$DataSet['course_batches']=$row['course_batch'];
			array_push($DataSets,$DataSet);
			array_push($PushedData,$row['program_name'].$row['course_name'].$row['year_of_admission'].$row['batch']);
		}
	}
	$Courses=mysql_query("SELECT * FROM `courses` WHERE department_code='$department_code' ORDER BY program_name ASC");
	while($row1 = mysql_fetch_array($Courses))
	{
		$program = $row1['program_name'];
		$Academic_Data = mysql_query("SELECT * FROM `academic_data` WHERE course='$program' AND current_semester!='0'");
		while($row2=mysql_fetch_array($Academic_Data))
		{
				$DataSet['program_name']=$program;
				$DataSet['course_name']=$row1['course_name'];
				$DataSet['course_code']=$row1['course_code'];
				$DataSet['year_of_admission']=$row2['admission_year'];
				$DataSet['current_semester']=$row2['current_semester'];
				$DataSet['name']='';
				$DataSet['course_batches']=$row1['course_batch'];
                if($row1['course_batch']>0)
                {
                    for($i=1;$i<=$row1['course_batch'];$i++)
                    {
                        $DataSet['batch']=$i;
				        if(!empty($PushedData))
	   			         $unique = array_search($program.$row1['course_name'].$row2['admission_year'].$DataSet['batch'],$PushedData);
                        if($unique=='')
                        {
                        array_push($DataSets,$DataSet);
				        array_push($PushedData,$program.$row1['course_name'].$row2['admission_year'].$DataSet['batch']);
                        }
                    }
                }
		}
	}
	$DataSets = array_orderby($DataSets, 'program_name', SORT_ASC, 'course_name', SORT_ASC);
	//print_r($DataSets);
	foreach ($DataSets as $Data)
	{
		$count++;
		echo '<tr>
    	<td>'.$count.'</td>';
    	echo '<td>'.$Data['program_name'].'</td>
    	<td>'.$Data['course_name'].'</td>
		<td>'.$Data['year_of_admission'].'</td>
    	<td>'.$Data['batch'].'</td>
    	<td>'.$Data['current_semester'].'</td>
		<td>'.$Data['name'].'</td>';
		if($UserAuthData['role']=='admin' || ($UserAuthData['role']=='hod'&&$UserAuthData['department']==$department_code))
		{
		$Function_Parameter = "'".$Data['program_name']."',"."'".$department_code."',"."'".$Data['course_code']."',"."'".$Data['batch']."',"."'".$Data['year_of_admission']."'";
		echo '<td colspan="8"><a href="#">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AllotStaffAdvisor" onclick="pushFormData('.$Function_Parameter.');">Allot Staff Advisor</button>
      </a></td>';
		}
		else if($UserAuthData['role']=='hod'&&$UserAuthData['department']!=$department_code)
		 echo "<td>No Permission</td>";
  		echo '</tr>';
		}
}
?>
