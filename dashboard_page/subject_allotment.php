<h2>Subject Allotment</h2>
<?php $x=1; include('spinner.php'); ?>
<div id="Subject-Allotment-Main-Window">
  <div class="form-group">
    <form id="SubjectAllotment-Form">
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
  <div id="Subject-Allotment-Department" class="hidden">
    <p>&nbsp;</p>
    <h4>Allot Subject</h4>
    <form id="Subject-Allotment-Department-Form" class="form-horizontal">
      <div class="form-group">
        <label for="Department" class="col-sm-3 control-label">Department</label>
        <div class="col-sm-9">
          <input type="text" name="subject-allotment-department-department-name" id="subject-allotment-department-department-name" class="form-control" placeholder="Course" required="required" readonly="readonly">
        </div>
      </div>
      <div class="form-group">
        <label for="Program" class="col-sm-3 control-label">Program</label>
        <div class="col-sm-9">
          <select name="subject-allotment-department-program" id="subject-allotment-department-program" class="form-control">
            <option value="null">Select a program</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="Course" class="col-sm-3 control-label">Course</label>
        <div class="col-sm-9">
          <select name="subject-allotment-department-course" id="subject-allotment-department-course" class="form-control">
            <option value="null">Select a course</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="Scheme" class="col-sm-3 control-label">Scheme</label>
        <div class="col-sm-9">
          <select name="subject-allotment-department-scheme" id="subject-allotment-department-scheme" class="form-control">
            <option value="null">Select a scheme</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="Semester" class="col-sm-3 control-label">Semester</label>
        <div class="col-sm-9">
          <select name="subject-allotment-department-semester" id="subject-allotment-department-semester" class="form-control">
            <option value="null">Select a semester</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="Scheme" class="col-sm-3 control-label">Batch</label>
        <div class="col-sm-9">
          <select name="subject-allotment-department-batch" id="subject-allotment-department-batch" class="form-control">
            <option value="null">Select a batch</option>
          </select>
        </div>
      </div>
    </form>
    <center>
      <button type='button' class='btn btn-default' id="Subject-Allotment-Department-Close" onClick="SubjectAllotmentClose();">Close</button>
      <button type='button' class='btn btn-success' id="Subject-Allotment-Department-Submit" onClick="SubjectAllotmentSubmit();">Submit</button>
    </center>
    <!--Warning Messages-->
    <p>&nbsp;</p>
<div class="alert alert-warning hidden" id="Subject-Allotment-Warning"><strong>Note!</strong> Please enter a valid input in field <strong><span id="Subjec-Allotment-Error-Part"></span></strong>. </div>
<!--Warning Messages-->
  </div>
</div>
<div id="Subject-Allotment-Edit-Window" class="hidden">
</div>
<!--Department Data Updation Using JSON --> 
<script>
function SubjectAllotmentClose ()
{
	$("#Subject-Allotment-Department").addClass('hidden');
}
//Change Department
$( "#select-department" )
.change(function () {
var str = "";
$( "#select-department option:selected" ).each(function() {
str = $( this ).text();
});
$( "#subject-allotment-department-department-name" ).val(str);
$("#Subject-Allotment-Department").fadeIn().removeClass('hidden');
fetch_department_data();
})
//Change Programs
$( "#subject-allotment-department-program" )
.change(function () {
$( "#subject-allotment-department-program option:selected" ).each(function() {
});
fetch_course_data();
})
//Change Course
$( "#subject-allotment-department-course" )
.change(function () {
$( "#subject-allotment-department-course option:selected" ).each(function() {
});
fetch_batch_data();
})
//Fetch Batch Data
function fetch_batch_data() {
	$.ajax({
	type: "POST",
	url: "/online/dashboard_page/forms/fetch.php",
	data: {
	"course_code": $("#subject-allotment-department-course").val(),
	"course_department": $("#select-department").val(),
	"course_program": $("#subject-allotment-department-program").val(),
	"action": "fetch_batch_data"},
	dataType: "json",
	success: function (data) {
		$("#subject-allotment-department-batch").html('');
		$("#subject-allotment-department-batch").html('<option value="null">Select a batch</option>');
		var limitBatch  = data.batch;
		for(i=1;i<=limitBatch;i++)
		{
	  		$("#subject-allotment-department-batch").append('<option value="'+i+'">'+i+'</option>');
		}
	}
	});
}
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
		$("#subject-allotment-department-program").html('');
		$("#subject-allotment-department-program").html('<option value="null">Select a program</option>');
		$.each(data , function(k , v ){
	  		$("#subject-allotment-department-program").append('<option value="'+v+'">'+v+'</option>');
		});
	}
	});
}
function fetch_course_data() {
	$.ajax({
	type: "POST",
	url: "/online/dashboard_page/forms/fetch.php",
	data: {"department_code": $("#select-department").val(),
	"department_program": $("#subject-allotment-department-program").val(),
	"action": "fetch_course_data"},
	dataType: "json",
	success: function (data) {
		//Courses
		$("#subject-allotment-department-course").html('');
		$("#subject-allotment-department-course").html('<option value="null">Select a course</option>');
		$.each(data.courses , function(k , v ){
	  		$("#subject-allotment-department-course").append('<option value="'+v.code+'">'+v.name+'</option>');
		});
		//Scheme
		$("#subject-allotment-department-scheme").html('');
		$("#subject-allotment-department-scheme").html('<option value="null">Select a scheme</option>');
		$.each(data.scheme , function(k , v ){
	  		$("#subject-allotment-department-scheme").append('<option value="'+v+'">'+v+'</option>');
		});
		//Semester
		var sem_count = data.semester;
		$("#subject-allotment-department-semester").html('');
		$("#subject-allotment-department-semester").html('<option value="null">Select a semester</option>');
		$("#subject-allotment-department-semester").html('<option value="1">Semester 1 AND 2</option>');
		for(sem=1; sem<=sem_count;sem++)
		 $("#subject-allotment-department-semester").append('<option value="'+sem+'">Semester '+sem+'</option>');
	}
	});
}
//Loading Page To View / Add Subjects
function SubjectAllotmentSubmit () {
	var program = $("#subject-allotment-department-program").val();
	var course = $("#subject-allotment-department-course").val();
	var scheme = $("#subject-allotment-department-scheme").val();
	var batch = $("#subject-allotment-department-batch").val();
	var semester = $("#subject-allotment-department-semester").val();
	if(program=='null')
	{
		$("#Subject-Allotment-Warning").removeClass('hidden');
		$("#Subjec-Allotment-Error-Part").html('Program');
	}
	else if(course=='null')
	{
		$("#Subject-Allotment-Warning").removeClass('hidden');
		$("#Subjec-Allotment-Error-Part").html('Course');
	}
	else if(scheme=='null')
	{
		$("#Subject-Allotment-Warning").removeClass('hidden');
		$("#Subjec-Allotment-Error-Part").html('Scheme');
	}
	else if(semester=='null')
	{
		$("#Subject-Allotment-Warning").removeClass('hidden');
		$("#Subjec-Allotment-Error-Part").html('Semester');
	}
	else if(batch=='null')
	{
		$("#Subject-Allotment-Warning").removeClass('hidden');
		$("#Subjec-Allotment-Error-Part").html('Batch');
	}
	else
	{
		$.ajax({
		type: "POST",
		url: "/online/dashboard_page/forms/fetch.php",
		beforeSend: function() {$('#Spinner1').removeClass('hidden'); $("#Subject-Allotment-Main-Window").addClass('hidden');},
		data: {
		"department": $("#select-department").val(),
		"department_name": $("#select-department option:selected").text(),
		"program": program,
		"course_code": course,
		"course": $("#subject-allotment-department-course option:selected").text(),
		"batch": batch,
		"scheme": scheme,
		"semester":semester,
		"action": "fetch_subject_staff_data"
		},
		dataType: "html",
		success: function (data) {
			$('#Spinner1').addClass('hidden');
			$("#Subject-Allotment-Edit-Window").removeClass('hidden');
			$("#Subject-Allotment-Edit-Window").html(data);
		}
		});
	}
}
</script>