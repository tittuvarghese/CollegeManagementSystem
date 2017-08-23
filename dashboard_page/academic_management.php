<h2>Academic Management</h2>
<!--Warning Messages-->
<div class="alert alert-success hidden" id="Update-Semester-Success"><strong>Success!</strong> You have updated a semester details. </div>
<div class="alert alert-danger hidden" id="Update-Semester-Failed"><strong>Oops!</strong> Something went wrong. Please contact us via support section. </div>
<div class="alert alert-warning hidden" id="Update-Semester-Warning"><strong>Note!</strong> Please enter a valid input in field <strong><span id="Update-Semester-Error-Part"></span></strong>. </div>
<!--Warning Messages-->
<?php $x=2; include('spinner.php'); ?>
<div id="UpdateSemester" class="hidden">
  <p>&nbsp;</p>
  <h4>Update Semester Details</h4>  
  <form id="UpdateSemester-Form" class="form-horizontal">
    <input type="hidden" name="update-semester-id" id="update-semester-id" class="form-control" placeholder="Course ID" required="required" readonly="readonly">
    <div class="form-group">
      <label for="Course" class="col-sm-3 control-label">Course</label>
      <div class="col-sm-9">
        <input type="text" name="update-semester-course" id="update-semester-course" class="form-control" placeholder="Course" required="required" readonly="readonly">
      </div>
    </div>
    <div class="form-group">
      <label for="Admission-Year" class="col-sm-3 control-label">Admission Year</label>
      <div class="col-sm-9">
        <input type="text" name="update-semester-admission-year" id="update-semester-admission-year" class="form-control" placeholder="Admission Year" required="required" readonly="readonly">
      </div>
    </div>
    <div class="form-group">
      <label for="Current-Semester" class="col-sm-3 control-label">Current Semester</label>
      <div class="col-sm-9">
        <select name="update-semester-current-semester" id="update-semester-current-semester" class="form-control">
          <option value="null">Current Semester</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="Start-Date" class="col-sm-3 control-label">Start Date</label>
      <div class="col-sm-9">
        <input type="date" name="update-semester-start-date" id="update-semester-start-date" class="form-control" placeholder="Semester Start Date, Eg. 2015-01-15" required="required">
      </div>
    </div>
    <div class="form-group">
      <label for="Start-Date" class="col-sm-3 control-label">End Date</label>
      <div class="col-sm-9">
        <input type="date" name="update-semester-end-date" id="update-semester-end-date" class="form-control" placeholder="Semester End Date, Eg. 2015-01-15" required="required">
      </div>
    </div>
    </form>
    <div class="form-group">
     <div class="col-sm-4 col-xs-offset-6">
      <button type="button" class="btn btn-default" onclick="UpdateSemesterClose();">Close</button>
      <button type="submit" class="btn btn-primary" id="UpdateSemester-FormButton" onclick="UpdateSemester();">Update</button>
      <p>&nbsp;</p>
     </div>
    </div>
  <p>&nbsp;</p>
</div>
<table class="table table-bordered text-center" id="AcademicManagementFetch">
</table>
<!--Register New Batch-->
<div class="container-fluid">
  <div class="row-fluid">
    <div class="col-lg-12">
      <div class="modal fade" id="RegisterNewBatch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Register New Program</h4>
            </div>
            <div class="modal-body">
              <?php $x=1; include('spinner.php'); ?>
              <form id="RegisterNewBatch-Form">
                <div class="form-group">
                  <select name="register-new-batch-program" id="register-new-batch-program" class="form-control">
                    <option value="null">Select a course to add new batch</option>
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
                  <input type="text" name="register-new-batch-year" id="register-new-batch-year" class="form-control" placeholder="Enter Year of Admission" required="required">
                </div>
                <div class="form-group">
                  <input type="text" name="register-new-batch-scheme" id="register-new-batch-scheme" class="form-control" placeholder="Enter Acadamic Scheme" required="required">
                </div>
              </form>
              <div class="alert alert-warning hidden" id="RegisterNewBatch-warning"> Please enter a valid <span id="new-batch-error-part">Program Name.</span>.</div>
              <div class="alert alert-success hidden" id="RegisterNewBatch-success"> You have successfully added new batch. <br/>
                <strong>Don't forget to set semester duration.</strong></div>
              <div class="alert alert-danger hidden" id="RegisterNewBatch-error"><strong>Oops.!</strong> Something went wrong. Please contact us via support section.</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" onclick="RegisterNewBatchClose();">Close</button>
              <button type="submit" class="btn btn-primary" id="RegisterNewBatch-FormButton" onclick="RegisterNewBatch();">Register</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Register New Batch--> 
<!---------------------------------Ajax Submission--------------------------------> 
<!--Register New Batch---> 
<script>
function RegisterNewBatchClose () {
	$("#RegisterNewBatch-Form").removeClass("hidden");
	$("#RegisterNewBatch-FormButton").removeClass('hidden');
	$("#RegisterNewBatch-success").addClass('hidden'); 
	$("#RegisterNewBatch-error").addClass('hidden');
	$("#RegisterNewBatch-warning").addClass('hidden');
	$("#RegisterNewBatch #register-new-batch-program").val('');
	$("#RegisterNewBatch #register-new-batch-scheme").val('');
	$("#RegisterNewBatch #register-new-batch-year").val('');
}
function RegisterNewBatch() {
	var ProgramName = $("#RegisterNewBatch #register-new-batch-program").val();
	var YearOfAdmission = $("#RegisterNewBatch #register-new-batch-year").val();
	var AcadamicScheme = $("#RegisterNewBatch #register-new-batch-scheme").val();
	if(ProgramName.length < 2)
	  {
		  $("#RegisterNewBatch-warning").removeClass('hidden');
		  $("#new-batch-error-part").html('Program Name');
	  }
	 else if(YearOfAdmission.length<3 || YearOfAdmission.length >4)
	 {
		 $("#RegisterNewBatch-warning").removeClass('hidden');
		  $("#new-batch-error-part").html('Year of Admission');
	 }
	 else if(AcadamicScheme.length<3 || AcadamicScheme.length >4)
	 {
		 $("#RegisterNewBatch-warning").removeClass('hidden');
		  $("#new-batch-error-part").html('Acadamic Scheme');
	 }
	 else
	  {
		 $.ajax({ 
		type: "POST",
		url: "/online/dashboard_page/forms/academic_management_form.php",
		beforeSend: function() {$('#Spinner1').removeClass("hidden"); $("#RegisterNewBatch-Form").addClass("hidden"); $("#RegisterNewBatch-FormButton").addClass('hidden');$("#RegisterNewBatch-warning").addClass('hidden');$("#RegisterNewBatch-success").addClass('hidden'); $("#RegisterNewBatch-error").addClass('hidden');},
		data: {
			"program_name": $("#RegisterNewBatch #register-new-batch-program").val(),
			"year_of_admission": $("#RegisterNewBatch #register-new-batch-year").val(),
			"acadamic_scheme": $("#RegisterNewBatch #register-new-batch-scheme").val(),
			"action": "register-new-batch"
			  },
		dataType: "json",
		success: function (data) {
			if (data.response == "success") {
				$("#RegisterNewBatch-success").removeClass('hidden');
				$('#Spinner1').addClass("hidden");
				RealTimeData('fetch-academic-data');
			}
			else
			{
				$('#Spinner1').addClass("hidden"); 
				$("#RegisterNewBatch-Form").removeClass("hidden");
				$("#RegisterNewBatch-FormButton").removeClass('hidden');
				$("#RegisterNewBatch-error").removeClass('hidden');
			}
		}
	});
	  }
}
</script> 
<!--Register New Batchh---> 
<!--Update Semester Details--> 
<script>
function SetSemester (a,b,c,d,e,f)
{
	$("#Update-Semester-Failed").addClass('hidden');
	$("#Update-Semester-Success").addClass('hidden');
	$("#Update-Semester-Warning").addClass('hidden');
	
	$("#Update-Semester-error").addClass('hidden');
	$("#Update-Semester-error").addClass('hidden');
	var limit=1; var semester=0;
	$("#UpdateSemester").fadeIn().removeClass('hidden');
	$("#UpdateSemester-Form #update-semester-id").val(a);
	$("#UpdateSemester-Form #update-semester-course").val(b);
	$("#UpdateSemester-Form #update-semester-admission-year").val(c);
	//Semester
	if(b=='B.Tech')
	 semester=8;
	else if(b=='M.Tech')
	 semester=4;
	$("#update-semester-current-semester").html('');
	if(d!=0)
	 $("#update-semester-current-semester").html('<option value="'+d+'">Semester '+d+'</option>');
	else
	 $("#update-semester-current-semester").html('<option value="0">Passout</option>');
	for (limit=1;limit<=semester;limit++)
	 {
		 if(limit != d)
		 	$("#update-semester-current-semester").append('<option value="'+limit+'">Semester '+limit+'</option>');
	 }
	if(d!=0)
	 {
		 $("#update-semester-current-semester").append('<option value="0">Passout</option>');
	 }
	$("#UpdateSemester-Form #update-semester-start-date").val('');
	$("#UpdateSemester-Form #update-semester-end-date").val('');
	if(e!='0000-00-00')
	 $("#UpdateSemester-Form #update-semester-start-date").val(e);
	if(f!='0000-00-00')
	 $("#UpdateSemester-Form #update-semester-end-date").val(f);
}
</script> 
<script>
//Close Button Handling
function UpdateSemesterClose () {
	$("#UpdateSemester").addClass('hidden');
}
function UpdateSemester() {
	var update_semester_id = $("#UpdateSemester-Form #update-semester-id").val();
	//var update_semester_course = $("#UpdateSemester-Form #update-semester-course").val();
	//var update_semester_admission_year = $("#UpdateSemester-Form #update-semester-admission-year").val();
	var update_semester_current_semester = $("#UpdateSemester-Form #update-semester-current-semester").val();
	var update_semester_start_date = $("#UpdateSemester-Form #update-semester-start-date").val();
	var update_semester_end_date = $("#UpdateSemester-Form #update-semester-end-date").val();
	if(update_semester_start_date=='')
	 {
		 $("#Update-Semester-Warning").removeClass('hidden');
		 $("#Update-Semester-Error-Part").html('Start Date');
	 }
	else if(update_semester_end_date=='')
	{
		$("#Update-Semester-Warning").removeClass('hidden');
		$("#Update-Semester-Error-Part").html('End Date');
	}
	else
	{
		$.ajax({ 
		type: "POST",
		url: "/online/dashboard_page/forms/academic_management_form.php",
		beforeSend: function() {$('#Spinner2').removeClass('hidden'); $("#UpdateSemester").addClass('hidden');},
		data: {
			"update_id": $("#UpdateSemester-Form #update-semester-id").val(),
			"update_semester": $("#UpdateSemester-Form #update-semester-current-semester").val(),
			"update_start_date": $("#UpdateSemester-Form #update-semester-start-date").val(),
			"update_end_date": $("#UpdateSemester-Form #update-semester-end-date").val(),
			"action": "update_semester"
			  },
		dataType: "json",
		success: function (data) {
			if (data.response == "success") {
				$("#Update-Semester-Success").removeClass('hidden');
				$('#Spinner2').addClass("hidden");
				window.setTimeout(function(){$("#Update-Semester-Success").addClass('hidden');},2000)
				RealTimeData('fetch-academic-data');
			}
			else
			{
				$('#Spinner2').addClass("hidden"); 
				$("#UpdateSemester").removeClass('hidden');
				$("#Update-Semester-Failed").removeClass('hidden');
			}
		}
	});
	}
}
</script>
<!--Update Semester Details-->
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
			 $("#AcademicManagementFetch").html(data);
		}
		});
}
RealTimeData('fetch-academic-data');
</script>