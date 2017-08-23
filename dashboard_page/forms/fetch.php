<?php
include_once('../../config.php');
$action = $_POST['action'];
if($action=='fetch_staff_data')
{
	$department_code = $_POST['department_code'];
	$staffs = array(); $staff = array();
	$sql_staff = mysql_query("SELECT * FROM login_staff WHERE department = '$department_code' ORDER BY type DESC, joining_date ASC");
	while($row_staff=mysql_fetch_array($sql_staff))
	{
		$staff['code'] = $row_staff['userid'];
		$staff['name'] = $row_staff['name'];
		array_push($staffs,$staff);	
	}
	$staff_data = json_encode($staffs);
	echo $staff_data;
}
else if($action=='fetch_department_data')
{
	$department_code = $_POST['department_code'];
	$programs=array();
	$sql = mysql_query("SELECT * FROM `courses` WHERE department_code='$department_code' ORDER BY id DESC");
	while($row=mysql_fetch_array($sql))
	{
  		array_push($programs,$row['program_name']);	
	}
$programs = array_unique($programs);
$programs = json_encode($programs);
echo $programs;
}
else if($action=='fetch_course_data')
{
	$department_code = $_POST['department_code'];
	$department_program = $_POST['department_program'];
	$courses = array(); $course = array(); $scheme= array(); $Course_Data = array(); $semester = array(); $yoa=array();
	//Courses
	$sql = mysql_query("SELECT * FROM `courses` WHERE department_code='$department_code' AND program_name='$department_program' ORDER BY id DESC");
	while($row=mysql_fetch_array($sql))
	{
		$course['name'] = $row['course_name'];
		$course['code'] = $row['course_code'];
		array_push($courses,$course);
	}
	$Course_Data['courses']= $courses;
	//Acadamic Scheme
	$sql_scheme = mysql_query("SELECT DISTINCT university_scheme FROM `academic_data` WHERE current_semester!='0' AND course='$department_program' ORDER BY id DESC");
	while($row_scheme=mysql_fetch_array($sql_scheme))
	{
		array_push($scheme,$row_scheme['university_scheme']);
	}
	sort($scheme);
	$Course_Data['scheme']= $scheme;
	//Year of Admission
	$sql_yoa = mysql_query("SELECT DISTINCT admission_year FROM `academic_data` WHERE course='$department_program' ORDER BY id DESC");
	while($row_yoa=mysql_fetch_array($sql_yoa))
	{
		array_push($yoa,$row_yoa['admission_year']);
	}
	sort($yoa);
	$Course_Data['yoa']= $yoa;
	//Semester
	$sql_semester = mysql_query("SELECT * FROM `courses` WHERE department_code='$department_code' AND program_name='$department_program' ORDER BY id DESC LIMIT 1");
	while($row_semester=mysql_fetch_array($sql_semester))
	{
		array_push($semester,$row_semester['course_semester']);
	}
	$Course_Data['semester']= $semester;
	
	$Course_Data = json_encode($Course_Data);
	echo $Course_Data;
}
else if($action=='fetch_batch_data')
{
	$course_code = $_POST['course_code'];
	$course_department = $_POST['course_department'];
	$course_program = $_POST['course_program'];
	$batch = mysql_query("SELECT * FROM `courses` WHERE course_code='$course_code' AND department_code='$course_department' AND program_name='$course_program'");
	while($row_batch = mysql_fetch_array($batch))
	{
		$result['batch'] = $row_batch['course_batch'];
	}
	if($result['batch'])
	 {
		 $result = json_encode($result);
		 echo $result;
	 }

}
else if($action=='fetch_subject_data')
{
	$program = $_POST['program'];
	$course_code = $_POST['course_code'];
	$course = $_POST['course'];
	$scheme = $_POST['scheme'];
	$semester = $_POST['semester'];
	$department = $_POST['department'];
	$department_name = $_POST['department_name'];
?>

<table class="table table-bordered">
  <tr>
    <td><strong>Department</strong></td>
    <td><?php echo $department_name.' ('.$department.')'; ?></td>
  </tr>
  <tr>
    <td><strong>Program</strong></td>
    <td><?php echo $program; ?></td>
  </tr>
  <tr>
    <td><strong>Course</strong></td>
    <td><?php echo $course_code.' - '.$course; ?></td>
  </tr>
  <tr>
    <td><strong>Scheme</strong></td>
    <td><?php echo $scheme; ?></td>
  </tr>
  <tr>
    <td><strong>Semester</strong></td>
    <td><?php echo $semester; ?></td>
  </tr>
</table>
<table class="table table-bordered" id="SubjectManagement-Fetch">
</table>
<!--Pop Up Box-->
<div class="container-fluid">
  <div class="row-fluid">
    <div class="col-lg-12">
      <div class="modal fade" id="AddNewSubject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Add New Subject</h4>
            </div>
            <div class="modal-body">
              <?php $x=1; include('../../spinner.php'); ?>
              <form id="AddNewSubject-Form" class="form-horizontal">
                <input type="hidden" name="add-new-subject-department" id="add-new-subject-department" class="form-control" placeholder="Course" required="required" readonly="readonly" value="<?php echo $department; ?>">
                <input type="hidden" name="add-new-subject-program" id="add-new-subject-program" class="form-control" placeholder="Course" required="required" readonly="readonly" value="<?php echo $program; ?>">
                <input type="hidden" name="add-new-subject-course" id="add-new-subject-course" class="form-control" placeholder="Course" required="required" readonly="readonly" value="<?php echo $course_code; ?>">
                <input type="hidden" name="add-new-subject-scheme" id="add-new-subject-scheme" class="form-control" placeholder="Course" required="required" readonly="readonly" value="<?php echo $scheme; ?>">
                <input type="hidden" name="add-new-subject-semester" id="add-new-subject-semester" class="form-control" placeholder="Course" required="required" readonly="readonly" value="<?php echo $semester; ?>">
                <div class="form-group">
                  <label for="Subject-Code" class="col-sm-3 control-label">Subject Code</label>
                  <div class="col-sm-9">
                    <input type="text" name="add-new-subject-code" id="add-new-subject-code" class="form-control" placeholder="Enter Subject Code" required="required" value="<?php echo $course_code.' ';?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Subject-Code-Sub" class="col-sm-3 control-label">Subject Code (Sub)</label>
                  <div class="col-sm-9">
                    <select name="add-new-subject-code-sub" id="add-new-subject-code-sub" class="form-control">
                      <option value="" selected="selected"></option>
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="C">C</option>
                      <option value="D">D</option>
                      <option value="E">E</option>
                      <option value="F">F</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="Subject-Name" class="col-sm-3 control-label">Subject Name</label>
                  <div class="col-sm-9">
                    <input type="text" name="add-new-subject-name" id="add-new-subject-name" class="form-control" placeholder="Enter Subject Name" required="required">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Subject-Type" class="col-sm-3 control-label">Subject Type</label>
                  <div class="col-sm-9">
                    <select name="add-new-subject-type" id="add-new-subject-type" class="form-control">
                      <option value="TH" selected="selected">Theory</option>
                      <option value="LA">Lab</option>
                      <option value="EL">Elective</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="Subject-Duration" class="col-sm-3 control-label">No. of Hours</label>
                  <div class="col-sm-9">
                    <input type="text" name="add-new-subject-hours" id="add-new-subject-hours" class="form-control" placeholder="Enter number of hours for the Subject" required="required">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Subject-Internal-Mark" class="col-sm-3 control-label">Internal Mark</label>
                  <div class="col-sm-9">
                    <input type="text" name="add-new-subject-internal" id="add-new-subject-internal" class="form-control" placeholder="Enter Internal Mark of the Subject" required="required" value="50">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Subject-External-Mark" class="col-sm-3 control-label">External Mark</label>
                  <div class="col-sm-9">
                    <input type="text" name="add-new-subject-external" id="add-new-subject-external" class="form-control" placeholder="Enter External Mark of the Subject" required="required" value="100">
                  </div>
                </div>
              </form>
              <div class="alert alert-warning hidden" id="AddNewSubject-warning"> Please enter a valid <span id="AddNewSubject-Error-Part"></span>.</div>
              <div class="alert alert-success hidden" id="AddNewSubject-success"> You have successfully added new program.</div>
              <div class="alert alert-danger hidden" id="AddNewSubject-error"><strong>Oops.!</strong> Something went wrong. Please contact us via support section.</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" onclick="CloseAddNewSubjectPopUp();">Close</button>
              <button type="submit" class="btn btn-primary" id="AddNewSubject-FormButton" onclick="AddNewSubject();">Register</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Pop Up Box--> 
<!--Ajax Submission Script--> 
<script>
function CloseAddNewSubjectPopUp() {
$("#AddNewSubject-warning").addClass('hidden');
$("#AddNewSubject-success").addClass('hidden');
$("#AddNewSubject-error").addClass('hidden');
$("#AddNewSubject-FormButton").removeClass('hidden');
$("#AddNewSubject-Form").removeClass('hidden');
$("#add-new-subject-code").val('<?php echo $course_code.' ';?>');
$("#add-new-subject-name").val('');
$("#add-new-subject-hours").val('');
}
function AddNewSubject() {
	var department = $("#add-new-subject-department").val();
	var program = $("#add-new-subject-program").val();
	var course = $("#add-new-subject-course").val();
	var scheme = $("#add-new-subject-scheme").val();
	var semester = $("#add-new-subject-semester").val();
	var code = $("#add-new-subject-code").val();
	var code_sub = $("#add-new-subject-code-sub").val();
	var name = $("#add-new-subject-name").val();
	var type = $("#add-new-subject-type").val();
	var hours = $("#add-new-subject-hours").val();
	var internal = $("#add-new-subject-internal").val();
	var external = $("#add-new-subject-external").val();
	
	if(code.length<=3)
	 {
		 $("#AddNewSubject-warning").removeClass('hidden');
		 $("#AddNewSubject-Error-Part").html("Subject Code");
	 }
	else if(name=='' || name.length<2)
	{
		$("#AddNewSubject-warning").removeClass('hidden');
		$("#AddNewSubject-Error-Part").html("Subject Name");
	}
	else if(hours=='' || name.length<1)
	{
		$("#AddNewSubject-warning").removeClass('hidden');
		$("#AddNewSubject-Error-Part").html("Number of Hours");
	}
	else
	{
		$.ajax({
		type: "POST",
		url: "/online/dashboard_page/forms/subject_management_form.php",
		beforeSend: function() {$('#Spinner1').removeClass('hidden'); $("#AddNewSubject-Form").addClass('hidden');},
		data: {
			"department":department,
			"program":program,
			"course":course,
			"scheme":scheme,
			"semester":semester,
			"code":code,
			"code_sub":code_sub,
			"name":name,
			"type":type,
			"hours":hours,
			"internal":internal,
			"external":external,
			"action": "add_new_subject"
		},
		dataType: "json",
		success: function (data) {
			if(data.response=='success')
			{
				$('#Spinner1').addClass('hidden');
				$('#AddNewSubject-success').removeClass('hidden');
				$("#AddNewSubject-FormButton").addClass('hidden');
				<?php echo "RealTimeDataSubject('".$program."','".$course_code."','".$scheme."','".$semester."','".$department."');"; ?>
			}
			else
			{
				$('#Spinner1').addClass('hidden');
				$("#AddNewSubject-Form").removeClass('hidden');
				$('#AddNewSubject-error').removeClass('hidden');
			}
		}
		});
	}
}
</script>
<!--Loading Real Time Data-->
<script>
function RealTimeDataSubject (program,course_code,scheme,semester,department) {
$.ajax({
		type: "POST",
		url: "/online/dashboard_page/realtime_data.php",
		data: {
		"program": program,
		"course_code": course_code,
		"scheme": scheme,
		"semester": semester,
		"department": department,
		"action": "fetch-subject-management"
		},
		dataType: "html",
		success: function (data) {
			 $("#SubjectManagement-Fetch").html(data);
		}
		});
}
<?php echo "RealTimeDataSubject('".$program."','".$course_code."','".$scheme."','".$semester."','".$department."');"; ?>
</script>
<?php }
else if($action=='fetch_subject_staff_data')
{
	$program = $_POST['program'];
	$course_code = $_POST['course_code'];
	$course = $_POST['course'];
	$scheme= $_POST['scheme'];
	$batch = $_POST['batch'];
	$semester = $_POST['semester'];
	$department = $_POST['department'];
	$department_name = $_POST['department_name'];
?>
<table class="table table-bordered">
  <tr>
    <td><strong>Department</strong></td>
    <td><?php echo $department_name.' ('.$department.')'; ?></td>
  </tr>
  <tr>
    <td><strong>Program</strong></td>
    <td><?php echo $program; ?></td>
  </tr>
  <tr>
    <td><strong>Course</strong></td>
    <td><?php echo $course_code.' - '.$course; ?></td>
  </tr>
  <tr>
    <td><strong>Scheme</strong></td>
    <td><?php echo $scheme; ?></td>
  </tr>
  <tr>
    <td><strong>Batch</strong></td>
    <td><?php echo $batch; ?></td>
  </tr>
  <tr>
    <td><strong>Semester</strong></td>
    <td><?php echo $semester; ?></td>
  </tr>
</table>
<table class="table table-bordered" id="FetchSubjectAllotment">
</table>
<!--POP Up Window-->
<div class="container-fluid">
  <div class="row-fluid">
    <div class="col-lg-12">
      <div class="modal fade" id="AllotStaff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Allot Teacher - <span id="SubjectName_Code">Test</span></h4>
            </div>
            <div class="modal-body">
              <?php $x=3; include('../../spinner.php'); ?>
              <form id="AllotStaff-Form" class="form-horizontal">
                <input type="hidden" name="allot-staff-program" id="allot-staff-program" class="form-control" placeholder="Course" required="required" readonly="readonly" value="<?php echo $program; ?>">
                <input type="hidden" name="allot-staff-department" id="allot-staff-department" class="form-control" placeholder="Course" required="required" readonly="readonly" value="<?php echo $department; ?>">
                <input type="hidden" name="allot-staff-course" id="allot-staff-course" class="form-control" placeholder="Course" required="required" readonly="readonly" value="<?php echo $course_code; ?>">
                <input type="hidden" name="allot-staff-batch" id="allot-staff-batch" class="form-control" placeholder="Course" required="required" readonly="readonly" value="<?php echo $batch; ?>">
                <input type="hidden" name="allot-staff-semester" id="allot-staff-semester" class="form-control" placeholder="Course" required="required" readonly="readonly" value="<?php echo $semester; ?>">
                <input type="hidden" name="allot-staff-course_code" id="allot-staff-course_code" class="form-control" placeholder="Course" required="required" readonly="readonly">
                <input type="hidden" name="allot-staff-course_code_sub" id="allot-staff-course_code_sub" class="form-control" placeholder="Course" required="required" readonly="readonly">
                <div class="form-group">
                  <label for="Scheme" class="col-sm-3 control-label">Scheme</label>
                  <div class="col-sm-9">
                    <input type="text" name="allot-staff-scheme" id="allot-staff-scheme" class="form-control" placeholder="Course" required="required" readonly="readonly" value="<?php echo $scheme; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Department" class="col-sm-3 control-label">Department</label>
                  <div class="col-sm-9">
                    <select name="allot-staff-department-other" id="allot-staff-department-other" class="form-control">
                      <option value="null" selected="selected">Select a Department</option>
                      <?php
						 $Department = mysql_query("SELECT * FROM `department`");
						 while ($row=mysql_fetch_array($Department))
						 {
					 		echo '<option value="'.$row['department_code'].'">'.$row['department_name'].'</option>';
						 }
						?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="Staff" class="col-sm-3 control-label">Faculty</label>
                  <div class="col-sm-9">
                    <select name="allot-staff-alloted-staff" id="allot-staff-alloted-staff" class="form-control">
                      <option value="null" selected="selected">Select a faculty</option>
                    </select>
                  </div>
                </div>
              </form>
              <div class="alert alert-warning hidden" id="AllotTeacher-warning"> Please enter a valid <span id="AllotTeacher-Error-Part"></span>.</div>
              <div class="alert alert-success hidden" id="AllotTeacher-success"> You have successfully added new program.</div>
              <div class="alert alert-danger hidden" id="AllotTeacher-error"><strong>Oops.!</strong> Something went wrong. Please contact us via support section.</div>
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="CloseAllotTeacherPopup();">Close</button>
                <button type="submit" class="btn btn-primary" id="AllotTeacher-FormButton" onclick="AllotTeacher();">Allot</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script>
function CloseAllotTeacherPopup() {
	$("#AllotStaff-Form").removeClass('hidden');
	$("#AllotTeacher-FormButton").removeClass('hidden');
	$("#AllotTeacher-error").addClass('hidden');
	$("#AllotTeacher-warning").addClass('hidden');
	$("#AllotTeacher-success").addClass('hidden');
}
//Fetch Faculty
$( "#allot-staff-department-other" )
.change(function () {
$( "#allot-staff-department-other option:selected" ).each(function() {
});
fetch_staff_data();
})
//Fetch Staff Data JSON
function fetch_staff_data () {
	$.ajax({
	type: "POST",
	url: "/online/dashboard_page/forms/fetch.php",
	data: {"department_code": $("#allot-staff-department-other").val(),
	"action": "fetch_staff_data"},
	dataType: "json",
	success: function (data) {
		$("#allot-staff-alloted-staff").html('');
		$("#allot-staff-alloted-staff").html('<option value="null">Select a faculty</option>');
		$.each(data , function(k , v ){
	  		$("#allot-staff-alloted-staff").append('<option value="'+v.code+'">'+v.name+'</option>');
		});
	}
	});
}
function AllotTeacherPopupFill(x,y,z)
{
	$("#allot-staff-course_code").val(x);
	$("#allot-staff-course_code_sub").val(y);;
	$("#SubjectName_Code").html(x+' '+z);
}
function AllotTeacher() {
 var program_name = $("#allot-staff-program").val();
 var department = $("#allot-staff-department").val();
 var course = $("#allot-staff-course").val();
 var batch = $("#allot-staff-batch").val();
 var semester = $("#allot-staff-semester").val();
 var course_code = $("#allot-staff-course_code").val();
 var course_code_sub = $("#allot-staff-course_code_sub").val();
 var scheme = $("#allot-staff-scheme").val();
 var department_from = $("#allot-staff-department-other").val();
 var alloted_staff = $("#allot-staff-alloted-staff").val();
 if(department_from=='null')
 {
	 $("#AllotTeacher-warning").removeClass('hidden');
	 $("#AllotTeacher-Error-Part").html('Department');
 }
 else if(alloted_staff=='null')
 {
	 $("#AllotTeacher-warning").removeClass('hidden');
	 $("#AllotTeacher-Error-Part").html('Faculty');
 }
 else
 {
	$.ajax({
		type: "POST",
		url: "/online/dashboard_page/forms/subject_management_form.php",
		beforeSend: function() {$('#Spinner3').removeClass('hidden'); $("#AllotStaff-Form").addClass('hidden'); $("#AllotTeacher-warning").addClass('hidden');},
		data: {
		"program_name": program_name,
		"department": department,
		"course": course,
		"batch": batch,
		"semester": semester,
		"course_code": course_code,
		"course_code_sub": course_code_sub,
		"scheme": scheme,
		"department_from": department_from,
		"alloted_staff": alloted_staff,
		"action": "allot_staff"
		},
		dataType: "json",
		success: function (data) {
			if(data.response=='success')
			{
			 $("#AllotTeacher-success").removeClass('hidden');
			 $('#Spinner3').addClass('hidden');
			 $("#AllotTeacher-FormButton").addClass('hidden');
			 <?php echo "RealTimeDataAllotment('".$program."','".$course_code."','".$scheme."','".$batch."','".$semester."','".$department."');"; ?>
			}
			else
			{
			 $("#AllotTeacher-error").removeClass('hidden');
			 $('#Spinner3').addClass('hidden');
			}
		}
		}); 
 }
}
</script>
<!--Loading Real Time Data-->
<script>
function RealTimeDataAllotment (program,course_code,scheme,batch,semester,department) {
$.ajax({
		type: "POST",
		url: "/online/dashboard_page/realtime_data.php",
		data: {
		"program": program,
		"course_code": course_code,
		"scheme": scheme,
		"batch": batch,
		"semester": semester,
		"department": department,
		"action": "fetch-subject-allotment"
		},
		dataType: "html",
		success: function (data) {
			 $("#FetchSubjectAllotment").html(data);
		}
		});
}
<?php echo "RealTimeDataAllotment('".$program."','".$course_code."','".$scheme."','".$batch."','".$semester."','".$department."');"; ?>
</script>
<?php } ?>
