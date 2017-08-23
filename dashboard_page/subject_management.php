<h2>Subject Management</h2>
<?php $x=1; include('spinner.php'); ?>
<div id="Subject-Management-Main-Window">
  <div class="form-group">
    <form id="SelectDepartment-Form">
      <select name="select-department" id="select-department" class="form-control">
        <option value="null">Select a Department</option>
        <?php
		$Department = mysql_query("SELECT * FROM `department`");
		while ($row=mysql_fetch_array($Department))
		{
			echo '<option value="'.$row['department_code'].'">'.$row['department_name'].'</option>';
		}
		?>
      </select>
    </form>
  </div>
  <div id="Subject-Management-Department" class="hidden">
    <p>&nbsp;</p>
    <h4>Manage Subject Details</h4>
    <form id="Subject-Management-Department-Form" class="form-horizontal">
      <div class="form-group">
        <label for="Department" class="col-sm-3 control-label">Department</label>
        <div class="col-sm-9">
          <input type="text" name="subject-managemet-department-department-name" id="subject-managemet-department-department-name" class="form-control" placeholder="Course" required="required" readonly="readonly">
        </div>
      </div>
      <div class="form-group">
        <label for="Program" class="col-sm-3 control-label">Program</label>
        <div class="col-sm-9">
          <select name="subject-managemet-department-program" id="subject-managemet-department-program" class="form-control">
            <option value="null">Select a program</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="Course" class="col-sm-3 control-label">Course</label>
        <div class="col-sm-9">
          <select name="subject-managemet-department-course" id="subject-managemet-department-course" class="form-control">
            <option value="null">Select a course</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="Scheme" class="col-sm-3 control-label">Scheme</label>
        <div class="col-sm-9">
          <select name="subject-managemet-department-scheme" id="subject-managemet-department-scheme" class="form-control">
            <option value="null">Select a scheme</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="Semester" class="col-sm-3 control-label">Semester</label>
        <div class="col-sm-9">
          <select name="subject-managemet-department-semester" id="subject-managemet-department-semester" class="form-control">
            <option value="null">Select a semester</option>
          </select>
        </div>
      </div>
    </form>
    <center>
      <button type='button' class='btn btn-default' id="Subject-Management-Department-Close" onClick="SubjectManagementClose();">Close</button>
      <button type='button' class='btn btn-success' id="Subject-Management-Department-Submit" onClick="SubjectManagementSubmit();">Submit</button>
    </center>
    <!--Warning Messages-->
    <p>&nbsp;</p>
<div class="alert alert-warning hidden" id="Subject-Management-Warning"><strong>Note!</strong> Please enter a valid input in field <strong><span id="Subjec-Management-Error-Part"></span></strong>. </div>
<!--Warning Messages-->
  </div>
</div>
<div id="Subject-Management-Edit-Window" class="hidden">
</div>
<!--Department Data Updation Using JSON --> 
<script>
function SubjectManagementClose ()
{
	$("#Subject-Management-Department").addClass('hidden');
}
//Change Department
$( "#select-department" )
.change(function () {
var str = "";
$( "#select-department option:selected" ).each(function() {
str = $( this ).text();
});
$( "#subject-managemet-department-department-name" ).val(str);
$("#Subject-Management-Department").fadeIn().removeClass('hidden');
fetch_department_data();
})
//Change Programs
$( "#subject-managemet-department-program" )
.change(function () {
$( "#subject-managemet-department-program option:selected" ).each(function() {
});
fetch_course_data();
})
//Fetching Data
function fetch_department_data()
{
	$.ajax({
	type: "POST",
	url: "/online/dashboard_page/forms/fetch.php",
	data: {"department_code": $("#select-department").val(),
	"action": "fetch_department_data"},
	dataType: "json",
	success: function (data) {
		$("#subject-managemet-department-program").html('');
		$("#subject-managemet-department-program").html('<option value="null">Select a Program</option>');
		$.each(data , function(k , v ){
	  		$("#subject-managemet-department-program").append('<option value="'+v+'">'+v+'</option>');
		});
	}
	});
}
function fetch_course_data() {
	$.ajax({
	type: "POST",
	url: "/online/dashboard_page/forms/fetch.php",
	data: {"department_code": $("#select-department").val(),
	"department_program": $("#subject-managemet-department-program").val(),
	"action": "fetch_course_data"},
	dataType: "json",
	success: function (data) {
		//Courses
		$("#subject-managemet-department-course").html('');
		$("#subject-managemet-department-course").html('<option value="null">Select a course</option>');
		$.each(data.courses , function(k , v ){
	  		$("#subject-managemet-department-course").append('<option value="'+v.code+'">'+v.name+'</option>');
		});
		//Scheme
		$("#subject-managemet-department-scheme").html('');
		$("#subject-managemet-department-scheme").html('<option value="null">Select a scheme</option>');
		$.each(data.scheme , function(k , v ){
	  		$("#subject-managemet-department-scheme").append('<option value="'+v+'">'+v+'</option>');
		});
		//Semester
		var sem_count = data.semester;
		$("#subject-managemet-department-semester").html('');
		$("#subject-managemet-department-semester").html('<option value="null">Select a semester</option>');
		$("#subject-managemet-department-semester").html('<option value="1">Semester 1 AND 2</option>');
		for(sem=1; sem<=sem_count;sem++)
		 $("#subject-managemet-department-semester").append('<option value="'+sem+'">Semester '+sem+'</option>');
	}
	});
}
//Loading Page To View / Add Subjects
function SubjectManagementSubmit () {
	var program = $("#subject-managemet-department-program").val();
	var course = $("#subject-managemet-department-course").val();
	var scheme = $("#subject-managemet-department-scheme").val();
	var semester = $("#subject-managemet-department-semester").val();
	if(program=='null')
	{
		$("#Subject-Management-Warning").removeClass('hidden');
		$("#Subjec-Management-Error-Part").html('Program');
	}
	else if(course=='null')
	{
		$("#Subject-Management-Warning").removeClass('hidden');
		$("#Subjec-Management-Error-Part").html('Course');
	}
	else if(scheme=='null')
	{
		$("#Subject-Management-Warning").removeClass('hidden');
		$("#Subjec-Management-Error-Part").html('Scheme');
	}
	else if(semester=='null')
	{
		$("#Subject-Management-Warning").removeClass('hidden');
		$("#Subjec-Management-Error-Part").html('Semester');
	}
	else
	{
		$.ajax({
		type: "POST",
		url: "/online/dashboard_page/forms/fetch.php",
		beforeSend: function() {$('#Spinner1').removeClass('hidden'); $("#Subject-Management-Main-Window").addClass('hidden');},
		data: {
		"department": $("#select-department").val(),
		"department_name": $("#select-department option:selected").text(),
		"program": program,
		"course_code": course,
		"course": $("#subject-managemet-department-course option:selected").text(),
		"scheme": scheme,
		"semester":semester,
		"action": "fetch_subject_data"
		},
		dataType: "html",
		success: function (data) {
			$('#Spinner1').addClass('hidden');
			$("#Subject-Management-Edit-Window").removeClass('hidden');
			$("#Subject-Management-Edit-Window").html(data);
		}
		});
	}
}
</script>