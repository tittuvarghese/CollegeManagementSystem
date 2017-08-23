<?php
if(isset($_SESSION['UserAuthData']))
{
	$UserAuthData=$_SESSION['UserAuthData'];
	$UserAuthData = unserialize($UserAuthData);
}
else
 header('Location: logout.php');
?>
<div class="container-fluid">
  <div class="row-fluid" id="InnerPage">
    <div class="col-lg-2">
      <ul class="nav nav-pills nav-stacked">
        <li><a href="dashboard.php" id="home">Home</a></li>
        <li><a href="dashboard.php?action=course-management" id="course-management">Course Management</a></li>
        <li><a href="dashboard.php?action=academic-management">Acadamic</a></li>
        <li><a href="dashboard.php?action=subject-management">Subject Management</a></li>
        <li><a href="dashboard.php?action=subject-allotment">Subject Allotment</a></li>
        <li><a href="dashboard.php?action=staff-list">Staffs</a></li>
        <li><a href="dashboard.php?action=user-management">Users</a></li>
        <li><a href="dashboard.php?action=staff-advisors">Staff Advisors</a></li>
        <li><a href="dashboard.php?action=hod">HODs</a></li>
      </ul>
    </div>
    <div class="col-lg-8">
<?php
if(!isset($_GET['action']))
{
	//Site Overview
?>
      <h2>Overview</h2>
      <table class="table table-bordered tabcenter">
        <tr>
          <td colspan="2" class="text-center"><strong>Users #</strong></td>
        </tr>
        <tr>
          <td>HODs</td>
          <td>5</td>
        </tr>
        <tr>
          <td>Staffs</td>
          <td>12</td>
        </tr>
        <tr>
          <td>Students</td>
          <td>3520</td>
        </tr>
        </table>
        <table class="table table-bordered tabcenter">
        <tr>
          <td colspan="4" class="text-center"><strong>Recent Logins</strong></td>
        </tr>
        <?php include_once('recent_logins.php'); ?>
      </table>
<?php } 
else
{
	$action = $_GET['action'];
	if($action=='course-management')
		include_once('course_management.php');
	else if($action=='academic-management')
		include_once('academic_management.php');
	else if($action=='subject-management')
		include_once('subject_management.php');
	else if($action=='subject-allotment')
		include_once('subject_allotment.php');
	else if($action=='staff-list')
		include_once('staff_management.php');
	else if($action=='user-management')
		include_once('user_management.php');
	else if($action=='staff-advisors')
		include_once('staff_advisors.php');
	else if($action=='hod')
		include_once('hod.php');
	else if($action=='student-list')
		include_once('student_list.php');
	else if($action=='feed-back')
		include_once('feed_back.php');
}?>
    </div>
    <div class="col-lg-2">
      <ul class="nav nav-pills nav-stacked text-right">
        <li><a href="dashboard.php?action=student-list">Students List</a></li>
        <li><a href="#">Mark Attendence</a></li>
        <li><a href="#">Attendence Register</a></li>
        <li><a href="#">Enter Marklist</a></li>
        <li><a href="#">Class Internal Marklist</a></li>
        <li><a href="#">Generate Internal</a></li>
        <li><a href="#">Elective</a></li>
        <li><a href="#">Register Elective</a></li>
        <li><a href="dashboard.php?action=feed-back">Feedback</a></li>
      </ul>
    </div>
  </div>
</div>