<h2>Course Management</h2>
<p>&nbsp;</p>
<button type='button' class='btn btn-success' id="ProgramsButton" onclick="CourseManagementTab('programs');">Programs</button> 
<button type='button' class='btn btn-primary' id="DepartmentsButton" onclick="CourseManagementTab('departments');">Departments</button> 
<button type='button' class='btn btn-primary' id="CourseButton" onclick="CourseManagementTab('course');">Course Overview</button> 
<p>&nbsp;</p>
<!--Programs-->
<div id="ProgramsWindow">
<h4>Programs</h4>
<table class="table table-bordered text-center" id="ProgramsFetch">
</table>
<!--Programs-->
</div>
<div id="DepartmentsWindow" class="hidden">
<!--Departments-->
<h4>Departments</h4>
<table class="table table-bordered text-center" id="DepartmentFetch">
</table>
<!--Departments-->
</div>
<div id="CourseWindow" class="hidden">
<!--Courses-->
<h4>Course Overview</h4>
<table class="table table-bordered text-center" id="CourseFetch">
</table>
<!--Courses-->
</div>
<!-----------------------------------------------PopUp Boxes----------------------------------------------------------> 
<!--Register New Program-->
<div class="container-fluid">
  <div class="row-fluid">
    <div class="col-lg-12">
      <div class="modal fade" id="RegisterNewProgram" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Register New Program</h4>
            </div>
            <div class="modal-body">
              <?php $x=1; include('spinner.php'); ?>
              <form id="RegisterNewProgram-Form">
                <div class="form-group">
                  <input type="text" name="register-new-program-name" id="register-new-program-name" class="form-control" placeholder="Enter Program Name" required="required">
                </div>
              </form>
              <div class="alert alert-warning hidden" id="RegisterNewProgram-warning"> Please enter a valid Program name.</div>
              <div class="alert alert-success hidden" id="RegisterNewProgram-success"> You have successfully added new program.</div>
              <div class="alert alert-danger hidden" id="RegisterNewProgram-error"><strong>Oops.!</strong> Something went wrong. Please contact us via support section.</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" onclick="RegisterNewProgramClose();">Close</button>
              <button type="submit" class="btn btn-primary" id="RegisterNewProgram-FormButton" onclick="RegisterNewProgram();">Register</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Register New Program-->
<!--Register New Department-->
<div class="container-fluid">
  <div class="row-fluid">
    <div class="col-lg-12">
      <div class="modal fade" id="RegisterNewDepartment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Register New Department</h4>
            </div>
            <div class="modal-body">
              <?php $x=2; include('spinner.php'); ?>
              <form id="RegisterNewDepartment-Form">
                <div class="form-group">
                  <input type="text" name="register-new-department-name" id="register-new-department-name" class="form-control" placeholder="Enter Department Name" required="required">
                 </div>
                 <div class="form-group">
                  <input type="text" name="register-new-department-code" id="register-new-department-code" class="form-control" placeholder="Enter Department Code" required="required">
                 </div>
              </form>
              <div class="alert alert-warning hidden" id="RegisterNewDepartment-warning"> Please enter a valid department <span id="department-error-part">name</span>.</div>
              <div class="alert alert-success hidden" id="RegisterNewDepartment-success"> You have successfully added new department.</div>
              <div class="alert alert-danger hidden" id="RegisterNewDepartment-error"> <strong>Oops.!</strong> Something went wrong. Please contact us via support section.</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" onclick="RegisterNewDepartmentClose();">Close</button>
              <button type="submit" class="btn btn-primary" id="RegisterNewDepartment-FormButton" onclick="RegisterNewDepartment();">Register</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Register New Department-->
<!--Register New Course-->
<div class="container-fluid">
  <div class="row-fluid">
    <div class="col-lg-12">
      <div class="modal fade" id="RegisterNewCourse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Register New Course</h4>
            </div>
            <div class="modal-body">
              <?php $x=3; include('spinner.php'); ?>
              <form id="RegisterNewCourse-Form">
                <div class="form-group">
                <select name="register-new-course-program" id="register-new-course-program" class="form-control">
                 <option value="null" selected="selected">Select a program to add course</option>
                 <?php
				  $CourseProgram = mysql_query("SELECT * FROM `programs` ORDER BY id DESC");
				  while($row=mysql_fetch_array($CourseProgram))
				  {
					  echo '<option value="'.$row['program_name'].'">'.$row['program_name'].'</option>';
				  }
				 ?>
                </select>
                </div>
                <div class="form-group">
                  <input type="text" name="register-new-course-name" id="register-new-course-name" class="form-control" placeholder="Enter Course Name" required="required">
                 </div>
                 <div class="form-group">
                  <input type="text" name="register-new-course-code" id="register-new-course-code" class="form-control" placeholder="Enter Course Code" required="required">
                 </div>
                 <div class="form-group">
                <select name="register-new-course-department" id="register-new-course-department" class="form-control">
                 <option value="null" selected="selected">Offeredby the department</option>
                 <?php
				 if($UserAuthData['role']=='admin')
				  $CourseDepartment = mysql_query("SELECT * FROM `department` ORDER BY id DESC");
				 else
				  $CourseDepartment = mysql_query("SELECT * FROM `department` WHERE department_code='{$UserAuthData['department']}' ORDER BY id DESC");
				  
				  while($row=mysql_fetch_array($CourseDepartment))
				  {
					  echo '<option value="'.$row['department_code'].'">'.$row['department_name'].'</option>';
				  }
				 ?>
                </select>
                </div>
                <div class="form-group">
                  <input type="text" name="register-new-course-batches" id="register-new-course-batches" class="form-control" placeholder="Enter Number of Batches" required="required">
                 </div>
                 <div class="form-group">
                  <input type="text" name="register-new-course-semester" id="register-new-course-semester" class="form-control" placeholder="Enter Number of Semesters" required="required">
                 </div>
                 <div class="form-group">
                  <input type="text" name="register-new-course-students" id="register-new-course-students" class="form-control" placeholder="Enter Number of Students" required="required">
                 </div>
              </form>
              <div class="alert alert-warning hidden" id="RegisterNewCourse-warning"> Please enter a valid entry in <span id="course-error-part">name</span> field.</div>
              <div class="alert alert-success hidden" id="RegisterNewCourse-success"> You have successfully added new course.</div>
              <div class="alert alert-danger hidden" id="RegisterNewCourse-error"> <strong>Oops.!</strong> Something went wrong. Please contact us via support section.</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" onclick="RegisterNewCourseClose();">Close</button>
              <button type="submit" class="btn btn-primary" id="RegisterNewCourse-FormButton" onclick="RegisterNewCourse();">Register</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Register New Course-->
<!---------------------------------Ajax Submission--------------------------------> 
<!--Register New Program---> 
<script>
function RegisterNewProgramClose () {
	$("#RegisterNewProgram-Form").removeClass("hidden");
	$("#RegisterNewProgram-FormButton").removeClass('hidden');
	$("#RegisterNewProgram-success").addClass('hidden'); 
	$("#RegisterNewProgram-error").addClass('hidden');
	$("#RegisterNewProgram-warning").addClass('hidden');
	$("#RegisterNewProgram #register-new-program-name").val('');
}
function RegisterNewProgram() {
	var ProgramName = $("#RegisterNewProgram #register-new-program-name").val();
	if(ProgramName.length < 2)
	  {
		  $("#RegisterNewProgram-warning").removeClass('hidden');
	  }
	 else
	  {
		 $.ajax({ 
		type: "POST",
		url: "/online/dashboard_page/forms/course_management_form.php",
		beforeSend: function() {$('#Spinner1').removeClass("hidden"); $("#RegisterNewProgram-Form").addClass("hidden"); $("#RegisterNewProgram-FormButton").addClass('hidden');$("#RegisterNewProgram-warning").addClass('hidden');$("#RegisterNewProgram-success").addClass('hidden'); $("#RegisterNewProgram-error").addClass('hidden');},
		data: {
			"program_name": $("#RegisterNewProgram #register-new-program-name").val(),
			"action": "register-new-program"
			  },
		dataType: "json",
		success: function (data) {
			if (data.response == "success") {
				$("#RegisterNewProgram-success").removeClass('hidden');
				$('#Spinner1').addClass("hidden"); 
				RealTimeData('fetch-program');
			}
			else
			{
				$('#Spinner1').addClass("hidden"); 
				$("#RegisterNewProgram-Form").removeClass("hidden");
				$("#RegisterNewProgram-FormButton").removeClass('hidden');
				$("#RegisterNewProgram-error").removeClass('hidden');
			}
		}
	});
	  }
}
</script>
<!--Register New Program---> 
<!--Register New Department---> 
<script>
function RegisterNewDepartmentClose () {
	$("#RegisterNewDepartment-Form").removeClass("hidden");
	$("#RegisterNewDepartment-FormButton").removeClass('hidden');
	$("#RegisterNewDepartment-success").addClass('hidden'); 
	$("#RegisterNewDepartment-error").addClass('hidden');
	$("#RegisterNewDepartment-warning").addClass('hidden');
	$("#RegisterNewDepartment #register-new-department-name").val('');
	$("#RegisterNewDepartment #register-new-department-code").val('');
}
function RegisterNewDepartment() {
	var DepartmentName = $("#RegisterNewDepartment #register-new-department-name").val();
	var DepartmentCode = $("#RegisterNewDepartment #register-new-department-code").val();
	if(DepartmentName.length < 2)
	  {
		  $("#RegisterNewDepartment-warning").removeClass('hidden');
		  $("#department-error-part").html('name');
	  }
	 else if(DepartmentCode.length <1)
	 {
		 $("#RegisterNewDepartment-warning").removeClass('hidden');
		  $("#department-error-part").html('code');
	 }
	 else
	  {
		 $.ajax({ 
		type: "POST",
		url: "/online/dashboard_page/forms/course_management_form.php",
		beforeSend: function() {$('#Spinner2').removeClass("hidden"); $("#RegisterNewDepartment-Form").addClass("hidden"); $("#RegisterNewDepartment-FormButton").addClass('hidden');$("#RegisterNewDepartment-warning").addClass('hidden');$("#RegisterNewDepartment-success").addClass('hidden'); $("#RegisterNewDepartment-error").addClass('hidden');},
		data: {
			"department_name": $("#RegisterNewDepartment #register-new-department-name").val(),
			"department_code": $("#RegisterNewDepartment #register-new-department-code").val(),
			"action": "register-new-department"
			  },
		dataType: "json",
		success: function (data) {
			if (data.response == "success") {
				$("#RegisterNewDepartment-success").removeClass('hidden');
				$('#Spinner2').addClass("hidden"); 
				RealTimeData('fetch-department');
			}
			else
			{
				$('#Spinner2').addClass("hidden"); 
				$("#RegisterNewDepartment-Form").removeClass("hidden");
				$("#RegisterNewDepartment-FormButton").removeClass('hidden');
				$("#RegisterNewDepartment-error").removeClass('hidden');
			}
		}
	});
	  }
}
</script>
<!--Register New Department--->
<!--Register New Course--->
<script>
function RegisterNewCourseClose () {
	$("#RegisterNewCourse-Form").removeClass("hidden");
	$("#RegisterNewCourse-FormButton").removeClass('hidden');
	$("#RegisterNewCourse-success").addClass('hidden'); 
	$("#RegisterNewCourse-error").addClass('hidden');
	$("#RegisterNewCourse-warning").addClass('hidden');
	//$("#RegisterNewCourse #register-new-course-program").val('');
	$("#RegisterNewCourse #register-new-course-name").val('');
	$("#RegisterNewCourse #register-new-course-code").val('');
	//$("#RegisterNewCourse #register-new-course-department").val('');
	$("#RegisterNewCourse #register-new-course-batches").val('');
	$("#RegisterNewCourse #register-new-course-semester").val('');
	$("#RegisterNewCourse #register-new-course-students").val(''); 
}
function RegisterNewCourse() {
	var CourseProgram = $("#RegisterNewCourse #register-new-course-program").val();
	var CourseName = $("#RegisterNewCourse #register-new-course-name").val();
	var CourseCode = $("#RegisterNewCourse #register-new-course-code").val();
	var CourseDepartment = $("#RegisterNewCourse #register-new-course-department").val();
	var CourseBatches = $("#RegisterNewCourse #register-new-course-batches").val();
	var DepartmentSemester = $("#RegisterNewCourse #register-new-course-semester").val();
	var DepartmentStudents = $("#RegisterNewCourse #register-new-course-students").val();
	if(CourseProgram == 'null')
	  {
		  $("#RegisterNewCourse-warning").removeClass('hidden');
		  $("#course-error-part").html('Program Name');
	  }
	 else if(CourseName.length <2)
	 {
		 $("#RegisterNewCourse-warning").removeClass('hidden');
		 $("#course-error-part").html('Course Name');
	 }
	 else if(CourseCode.length < 2)
	 {
		 $("#RegisterNewCourse-warning").removeClass('hidden');
		 $("#course-error-part").html('Course Code');
	 }
	 else if(CourseDepartment == 'null')
	 {
		 $("#RegisterNewCourse-warning").removeClass('hidden');
		 $("#course-error-part").html('Department Name');
	 }
	 else if(CourseBatches < 1 || CourseBatches =='')
	 {
		 $("#RegisterNewCourse-warning").removeClass('hidden');
		 $("#course-error-part").html('Number of Batches');
	 }
	 else if(DepartmentSemester <1 || DepartmentSemester =='')
	 {
		 $("#RegisterNewCourse-warning").removeClass('hidden');
		 $("#course-error-part").html('Number of Batches');
	 }
	 else if(DepartmentStudents<1 || DepartmentStudents=='')
	 {
		 $("#RegisterNewCourse-warning").removeClass('hidden');
		 $("#course-error-part").html('Number of Students');
	 }
	 else
	  {
		$.ajax({ 
		type: "POST",
		url: "/online/dashboard_page/forms/course_management_form.php",
		beforeSend: function() {$('#Spinner3').removeClass("hidden"); $("#RegisterNewCourse-Form").addClass("hidden"); $("#RegisterNewCourse-FormButton").addClass('hidden');$("#RegisterNewCourse-warning").addClass('hidden');$("#RegisterNewCourse-success").addClass('hidden'); $("#RegisterNewCourse-error").addClass('hidden');},
		data: {
			"course_program": $("#RegisterNewCourse #register-new-course-program").val(),
			"course_name": $("#RegisterNewCourse #register-new-course-name").val(),
			"course_code": $("#RegisterNewCourse #register-new-course-code").val(),
			"course_department": $("#RegisterNewCourse #register-new-course-department").val(),
			"course_batches": $("#RegisterNewCourse #register-new-course-batches").val(),
			"course_semester": $("#RegisterNewCourse #register-new-course-semester").val(),
			"course_students": $("#RegisterNewCourse #register-new-course-students").val(),
			"action": "register-new-course"
			  },
		dataType: "json",
		success: function (data) {
			if (data.response == "success") {
				$("#RegisterNewCourse-success").removeClass('hidden');
				$('#Spinner3').addClass("hidden"); 
				RealTimeData('fetch-course');
			}
			else
			{
				$('#Spinner3').addClass("hidden"); 
				$("#RegisterNewCourse-Form").removeClass("hidden");
				$("#RegisterNewCourse-FormButton").removeClass('hidden');
				$("#RegisterNewCourse-error").removeClass('hidden');
			}
		}
	});
	  }
}
</script>
<!--Register New Course--->
<!--Tab Menu Function -->
<script>
function CourseManagementTab(x) {
 if(x=='programs')
 {
	$('#ProgramsButton').removeClass("btn-success");
	$('#DepartmentsButton').removeClass("btn-success");
	$('#CourseButton').removeClass("btn-success");
	$('#ProgramsButton').addClass("btn-success");
	$('#DepartmentsButton').addClass("btn-primary");
	$('#CourseButton').addClass("btn-primary");
	$('#ProgramsWindow').fadeIn().removeClass('hidden');
	$('#DepartmentsWindow').addClass('hidden');
	$('#CourseWindow').addClass('hidden');
 }
 else if(x=='departments')
 {
	$('#ProgramsButton').removeClass("btn-success");
	$('#DepartmentsButton').removeClass("btn-success");
	$('#CourseButton').removeClass("btn-success");
	$('#ProgramsButton').addClass("btn-primary");
	$('#DepartmentsButton').addClass("btn-success");
	$('#CourseButton').addClass("btn-primary");
	$('#DepartmentsWindow').fadeIn().removeClass('hidden');
	$('#ProgramsWindow').addClass('hidden');
	$('#CourseWindow').addClass('hidden');
 }
 else if(x=='course')
 {
	$('#ProgramsButton').removeClass("btn-success");
	$('#DepartmentsButton').removeClass("btn-success");
	$('#CourseButton').removeClass("btn-success");
	$('#ProgramsButton').addClass("btn-primary");
	$('#DepartmentsButton').addClass("btn-primary");
	$('#CourseButton').addClass("btn-success");
	$('#CourseWindow').fadeIn().removeClass('hidden');
	$('#ProgramsWindow').addClass('hidden');
	$('#DepartmentsWindow').addClass('hidden');
 }
 else
 {
	$('#ProgramsButton').removeClass("btn-success");
	$('#DepartmentsButton').removeClass("btn-success");
	$('#CourseButton').removeClass("btn-success");
	$('#ProgramsButton').addClass("btn-success");
	$('#DepartmentsButton').addClass("btn-primary");
	$('#CourseButton').addClass("btn-primary");
	$('#ProgramsWindow').fadeIn().removeClass('hidden');
	$('#DepartmentsWindow').addClass('hidden');
	$('#CourseWindow').addClass('hidden');
 }
}
</script>
<!--Tab Menu Function -->
<!--Loading Real Time Data-->
<script>
function RealTimeData (action) {
$.ajax({
		type: "POST",
		url: "/online/dashboard_page/realtime_data.php",
		data: {
		"action": action
		},
		dataType: "html",
		success: function (data) {
			if(action=='fetch-program')
			 $("#ProgramsFetch").html(data);
			else if(action=='fetch-department')
			 $("#DepartmentFetch").html(data);
			else if(action=='fetch-course')
			 $("#CourseFetch").html(data);
		}
		});
}
RealTimeData('fetch-program');
RealTimeData('fetch-department');
RealTimeData('fetch-course');
</script>