<?php
session_start();
$UserAuthData = $_SESSION['UserAuthData'];
$UserAuthData = unserialize($UserAuthData);
include_once('../../config.php');
$action = $_POST['action'];
if($action=='fetch_staff_data')
{
	$Count=0;
	$department_code = $_POST['department_code'];
	if($department_code!='all')
	{
	$Staffs = mysql_query("SELECT * FROM `login_staff` WHERE department='$department_code' ORDER BY type DESC");
	}
	else
	{
	$Staffs = mysql_query("SELECT * FROM `login_staff` ORDER BY department ASC");	
	}
	echo '<tr>
	<td><strong>#</strong></td>
	<td><strong>Name</strong></td>
	<td><strong>Designation</strong></td>
	<td><strong>Type</strong></td>
	<td><strong>E-Mail</strong></td>
	<td><strong>Phone</strong></td>
	<td><strong>Join Date</strong></td>';
	if(($UserAuthData['role']=='admin' || $UserAuthData['role']=='hod') && $department_code!='all')
		echo '<td><strong>Operation</strong></td>';
	echo '</tr>';
	while($row=mysql_fetch_array($Staffs))
	{
		if($row['role']=='hod')
		 $designation = "Head of the Department";
		else
		 $designation = $row['designation'];
		$Count++;
		echo '<tr>
    	<td>'.$Count.'</td>';
		if($department_code!='all')
    	 echo '<td>'.$row['name'].'</td>';
		else
		 echo '<td>'.$row['name'].' ('.$row['department'].')</td>';
    	echo '<td>'.$designation.'</td>
    	<td>'.ucfirst($row['type']).'</td>
		<td>'.$row['email'].'</td>
    	<td>'.$row['phone'].'</td>
    	<td>'.$row['joining_date'].'</td>';
		if(($UserAuthData['role']=='admin' || ($UserAuthData['role']=='hod'&&$UserAuthData['department']==$department_code)) && $department_code!='all')
		{
		echo "<td><a href='delete.php?p=delete-staff&id=".$row['id']."'><button type='button' class='btn btn-danger'>Delete</button></a></td>";
		}
		if($UserAuthData['role']=='hod'&&$UserAuthData['department']!=$department_code)
		 echo "<td>No Permission</td>";
  		echo '</tr>';
	}
	if($department_code!='all' && ($UserAuthData['role']=='admin' || ($UserAuthData['role']=='hod'&&$UserAuthData['department']==$department_code)))
	{
	echo '<tr>
    <td colspan="8"><a href="#">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AddNewStaff">Add New Staff</button>
      </a></td>
  </tr>';
	}
}
?>
