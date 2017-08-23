<?php
session_start();
$UserAuthData = $_SESSION['UserAuthData'];
$UserAuthData = unserialize($UserAuthData);
include_once('../../config.php');
$action = $_POST['action'];
if($action=='fetch_hod_data')
{
	$PushedData = array (); $DataSet = array(); $DataSets = array(); array_push($PushedData,'tbicea'); $unique='';
	$HOD = mysql_query("SELECT dt.department_name,dt.department_code,ls.name FROM department dt JOIN login_staff ls on ls.department=dt.department_code WHERE ls.role='hod' ORDER BY dt.department_name ASC");
	while ($row = mysql_fetch_array($HOD))
	{
		if(!empty($PushedData))
	   		$unique = array_search($row['department_code'],$PushedData);
		if($unique=='')
		{
		$DataSet['department_code'] = $row['department_code'];
		$DataSet['department_name'] = $row['department_name'];
		$DataSet['name'] = $row['name'];
		array_push($DataSets,$DataSet);
		array_push($PushedData,$row['department_code']);
		}
	}
	$HOD = mysql_query("SELECT * FROM `department` ORDER BY department_name ASC");
	while ($row = mysql_fetch_array($HOD))
	{
		if(!empty($PushedData))
	   		$unique = array_search($row['department_code'],$PushedData);
		if($unique=='')
		{
		$DataSet['department_code'] = $row['department_code'];
		$DataSet['department_name'] = $row['department_name'];
		$DataSet['name'] = '';
		array_push($DataSets,$DataSet);
		array_push($PushedData,$row['department_code']);
		}
	}
	$count=0;
	echo "<tr><td><strong>#</strong></td><td><strong>Department</strong></td><td><strong>Name</strong></td>";
	if($UserAuthData['role']=='admin')
		echo "<td><strong>Operation</strong></td></tr>";
	foreach ($DataSets as $Data)
	{
		$count++;
		echo '<tr>
    	<td>'.$count.'</td>';
    	echo '<td>'.$Data['department_name'].' ('.$Data['department_code'].')</td>
    	<td>'.$Data['name'].'</td>';
		if($UserAuthData['role']=='admin')
		{
			echo '<td colspan="8"><a href="#">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AllotHOD" onclick="pushFormData('."'".$Data['department_code']."'".');">Allot HOD</button>
      </a></td>';
		}
  		echo '</tr>';
		}
}
?>