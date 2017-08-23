<?php
session_start();
$UserAuthData = $_SESSION['UserAuthData'];
$UserAuthData = unserialize($UserAuthData);
include_once('../../config.php');
$action = $_POST['action'];
if($action=='fetch_user_data')
{
	$type = $_POST['userType'];
	if($type=='administration')
	{
		$table='login_college_admin';
	}
	else if($type=='site-admin')
	{
		$table = 'login_admin';
	}
	if($table)
	{
		$college_admin = mysql_query("SELECT * FROM $table");
		echo '<tr>';
		echo '<td><strong>Name</strong></td><td><strong>E-Mail</strong></td><td><strong>Phone</strong></td><td><strong>Designation</strong></td>';
		if($UserAuthData['role']=='admin')
			echo '<td><strong>Operation</strong></td></tr>';
		while ($row = mysql_fetch_array($college_admin))
		{
			echo '<tr>';
			echo '<td>'.$row['name'].'</td><td>'.$row['email'].'</td><td>'.$row['phone'].'</td><td>'.ucfirst($row['role']).'</td>';
			if($UserAuthData['role']=='admin')
			{
				echo "<td><a href='delete.php?p=delete-".$type."&id=".$row['id']."'><button type='button' class='btn btn-danger'>Delete</button></a></td>";
			}
			echo '</tr>';
		}
		if($UserAuthData['role']=='admin')
		{echo '<tr>
    <td colspan="8"><a href="#">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#AddNewCollegeAdmin">Add New Administrator</button>
      </a></td>
  </tr>';
		}
	}
}
?>