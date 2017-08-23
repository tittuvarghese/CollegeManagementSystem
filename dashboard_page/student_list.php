<h2>Student List</h2>
<div id="Student-List-Main-Window">
  <div class="form-group">
    <form id="StudentList-Form">
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
  <div id="Student-List-Department" class="hidden">
    <p>&nbsp;</p>
    <form id="Student-List-Department-Form" class="form-horizontal">
      <div class="form-group">
        <label for="Department" class="col-sm-3 control-label">Department</label>
        <div class="col-sm-9">
          <input type="text" name="student-list-department-name" id="student-list-department-name" class="form-control" placeholder="Course" required="required" readonly="readonly">
        </div>
      </div>
      <div class="form-group">
        <label for="Program" class="col-sm-3 control-label">Program</label>
        <div class="col-sm-9">
          <select name="student-list-program" id="student-list-program" class="form-control">
            <option value="null">Select a program</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="Course" class="col-sm-3 control-label">Course</label>
        <div class="col-sm-9">
          <select name="student-list-course" id="student-list-course" class="form-control">
            <option value="null">Select a course</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="Scheme" class="col-sm-3 control-label">Batch</label>
        <div class="col-sm-9">
          <select name="student-list-batch" id="student-list-batch" class="form-control">
            <option value="null">Select a batch</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="Year of Admission" class="col-sm-3 control-label">Year of Admission</label>
        <div class="col-sm-9">
          <select name="student-list-yoa" id="student-list-yoa" class="form-control">
            <option value="null">Select Year of Admission</option>
          </select>
        </div>
      </div>
    </form>
    <center>
      <button type='button' class='btn btn-default' id="Student-List-Close" onClick="StudenListClose();">Close</button>
      <button type='button' class='btn btn-success' id="Student-List-Submit" onClick="StudenList();">Submit</button>
    </center>
    <!--Warning Messages-->
    <p>&nbsp;</p>
<div class="alert alert-warning hidden" id="Student-List-Warning"><strong>Note!</strong> Please enter a valid input in field <strong><span id="Student-List-Error-Part"></span></strong>. </div>
<!--Warning Messages-->
  </div>
</div>
<!--Student List-->
<div id="Student-List-Data-Window" class="hidden">
</div>
<!--Student List-->
<!--Department Data Updation Using JSON --> 
<script>
function StudenListClose ()
{
	$("#Student-List-Department").addClass('hidden');
}
//Change Department
$( "#select-department" )
.change(function () {
var str = "";
$( "#select-department option:selected" ).each(function() {
str = $( this ).text();
});
$( "#student-list-department-name" ).val(str);
$("#Student-List-Department").fadeIn().removeClass('hidden');
fetch_department_data();
})
//Change Programs
$( "#student-list-program" )
.change(function () {
$( "#student-list-program option:selected" ).each(function() {
});
fetch_course_data();
})
//Change Course
$( "#student-list-course" )
.change(function () {
$( "#student-list-course option:selected" ).each(function() {
});
fetch_batch_data();
})
//Fetch Batch Data
function fetch_batch_data() {
	$.ajax({
	type: "POST",
	url: "/online/dashboard_page/forms/fetch.php",
	data: {
	"course_code": $("#student-list-course").val(),
	"course_department": $("#select-department").val(),
	"course_program": $("#student-list-program").val(),
	"action": "fetch_batch_data"},
	dataType: "json",
	success: function (data) {
		$("#student-list-batch").html('');
		$("#student-list-batch").html('<option value="null">Select a batch</option><option value="all">All</option>');
		var limitBatch  = data.batch;
		for(i=1;i<=limitBatch;i++)
		{
	  		$("#student-list-batch").append('<option value="'+i+'">'+i+'</option>');
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
		$("#student-list-program").html('');
		$("#student-list-program").html('<option value="null">Select a program</option>');
		$.each(data , function(k , v ){
	  		$("#student-list-program").append('<option value="'+v+'">'+v+'</option>');
		});
	}
	});
}
function fetch_course_data() {
	$.ajax({
	type: "POST",
	url: "/online/dashboard_page/forms/fetch.php",
	data: {"department_code": $("#select-department").val(),
	"department_program": $("#student-list-program").val(),
	"action": "fetch_course_data"},
	dataType: "json",
	success: function (data) {
		//Courses
		$("#student-list-course").html('');
		$("#student-list-course").html('<option value="null">Select a course</option>');
		$.each(data.courses , function(k , v ){
	  		$("#student-list-course").append('<option value="'+v.code+'">'+v.name+'</option>');
		});
		$("#student-list-yoa").html('');
		$("#student-list-yoa").html('<option value="null">Select Year of Admission</option>');
		$.each(data.yoa , function(k , v ){
	  		$("#student-list-yoa").append('<option value="'+v+'">'+v+'</option>');
		});
	}
	});
}
//Loading Page To View / Add Subjects
function StudenList () {
	var program = $("#student-list-program").val();
	var course = $("#student-list-course").val();
	var batch = $("#student-list-batch").val();
	var yoa = $("#student-list-yoa").val();
	if(program=='null')
	{
		$("#Student-List-Warning").removeClass('hidden');
		$("#Student-List-Error-Part").html('Program');
	}
	else if(course=='null')
	{
		$("#Student-List-Warning").removeClass('hidden');
		$("#Student-List-Error-Part").html('Course');
	}
	else if(batch=='null')
	{
		$("#Student-List-Warning").removeClass('hidden');
		$("#Student-List-Error-Part").html('Batch');
	}
	else if(yoa=='null')
	{
		$("#Student-List-Warning").removeClass('hidden');
		$("#Student-List-Error-Part").html('Year of Admissionss');
	}
	else
	{
		$.ajax({
		type: "POST",
		url: "/online/dashboard_page/forms/student_list.php",
		beforeSend: function() {$('#Spinner1').removeClass('hidden'); $("#Student-List-Main-Window").addClass('hidden');},
		data: {
		"department": $("#select-department").val(),
		"department_name": $("#select-department option:selected").text(),
		"program": program,
		"course_code": course,
		"course": $("#student-list-course option:selected").text(),
		"batch": batch,
		"yoa": yoa,
		"action": "fetch_student_data"
		},
		dataType: "html",
		success: function (data) {
			$('#Spinner1').addClass('hidden');
			$("#Student-List-Data-Window").removeClass('hidden');
			$("#Student-List-Data-Window").html(data);
		}
		});
	}
}
</script>