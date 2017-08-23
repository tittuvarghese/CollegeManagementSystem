<?php
session_start();
$UserAuthData = $_SESSION['UserAuthData'];
$UserAuthData = unserialize($UserAuthData);
include_once('../../config.php');
$action = $_POST['action'];
if($action=='fetch_student_data')
{
	$department = $_POST['department'];
	$program = $_POST['program'];
	$course_code = $_POST['course_code'];
	$batch = $_POST['batch'];
	$yoa = $_POST['yoa'];
	if($UserAuthData['role']=='admin' || ($UserAuthData['role']=='hod'&&$UserAuthData['department']==$department_code))
	{
	echo "<a href='sample/student_data_sample.csv'><button type='button' class='btn btn-success'>Download Sample Student Data Sheet (CSV File)</button></a> ";
	echo "<button type='button' class='btn btn-success' id='Student-Data-CSV' data-toggle='modal' data-target='#UploadCSV'>Upload Student Data (CSV File)</button></a> ";
	echo "<a href='#'><button type='button' class='btn btn-success' id='Student-Data-Manual'>Manual Insertion</button></a> ";
	}
?>
<p>&nbsp;</p>
<table class="table table-bordered text-center" id="Student-List-Fetch">
</table>
<!-- Pop up Upload CSV-->
<div class="container-fluid">
  <div class="row-fluid">
    <div class="col-lg-12">
      <div class="modal fade" id="UploadCSV" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form method="post" action="dashboard_page/forms/upload_student_data.php" target="new" enctype="multipart/form-data" class="form-horizontal">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Upload Student CSV File</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="Department Code" class="col-sm-3 control-label">Department Code</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="Student-Data-Department" id="Student-Data-Department" value="<?php echo $department; ?>" readonly="readonly">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Program" class="col-sm-3 control-label">Program</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="Student-Data-Program" id="Student-Data-Program" value="<?php echo $program; ?>" readonly="readonly">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Course" class="col-sm-3 control-label">Course</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="Student-Data-Course" id="Student-Data-Course" value="<?php echo $course_code; ?>" readonly="readonly">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Batch" class="col-sm-3 control-label">Batch</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="Student-Data-Batch" id="Student-Data-Batch" value="<?php echo $batch; ?>" readonly="readonly">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Year of Admission" class="col-sm-3 control-label">Year of Admission</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="Student-Data-YOA" id="Student-Data-YOA" value="<?php echo $yoa; ?>" readonly="readonly">
                  </div>
                </div>
                <div class="form-group">
                  <label for="CSV File" class="col-sm-3 control-label">CSV File</label>
                  <div class="col-sm-9">
                    <input type="file" name="Student-Data-CSV" id="Student-Data-CSV" required="required">
                  </div>
                </div>
                <p>&nbsp;</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="UploadCSV-Submit">Upload Student Data</button>
              </div>
            </div>
          </form>
          <!-- /.modal-content --> 
        </div>
        <!-- /.modal-dialog --> 
      </div>
      <!-- /.modal --> 
    </div>
  </div>
</div>
<!-- Pop up Upload CSV--> 
<script>
//Student List Fetch
function fetch_student_data() {
	$("#Student-List-Fetch").html('');
	var program = $("#student-list-program").val();
	var course = $("#student-list-course").val();
	var batch = $("#student-list-batch").val();
	var yoa = $("#student-list-yoa").val();
$.ajax({
	type: "POST",
	url: "/online/dashboard_page/forms/fetch_student.php",
	data: {
		"department": $("#select-department").val(),
		"program": program,
		"course_code": course,
		"course": $("#student-list-course option:selected").text(),
		"batch": batch,
		"yoa": yoa,
		"action": "fetch_student"},
	dataType: "html",
	success: function (data) {
		//Staff
		$( "#Student-List-Fetch").append(data);
	}
	});
}
fetch_student_data();
</script>
<?php
}
?>
