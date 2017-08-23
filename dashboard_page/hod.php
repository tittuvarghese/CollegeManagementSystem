<h2>Head Of the Departments</h2>
<div id="HOD-Data-Window">
  <table class="table table-bordered text-center" id="HODData-Fetch">
  </table>
</div>
<!--Pop Up Box-->
<div class="container-fluid">
  <div class="row-fluid">
    <div class="col-lg-12">
      <div class="modal fade" id="AllotHOD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Allot HOD</h4>
            </div>
            <div class="modal-body">
              <?php $x=1; include('./spinner.php'); ?>
              <form id="AllotHOD-Form" class="form-horizontal">
                <div class="form-group">
                  <label for="HOD-Department" class="col-sm-3 control-label">Department Code</label>
                  <div class="col-sm-9">
                    <input type="text" name="allot-hod-department" id="allot-hod-department" class="form-control" placeholder="Department Name" required="required" readonly="readonly">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Staff-StaffName" class="col-sm-3 control-label">Staffs</label>
                  <div class="col-sm-9">
                    <select name="allot-hod-staff" id="allot-hod-staff" class="form-control">
                      <option value="null" selected="selected">Select a faculty</option>
                    </select>
                  </div>
                </div>
              </form>
              <div class="alert alert-warning hidden" id="AllotHOD-warning"> Please enter a valid <span id="AllotStaffAdvisor-Error-Part"></span>.</div>
              <div class="alert alert-success hidden" id="AllotHOD-success"> You have successfully alloted a staff adisor.</div>
              <div class="alert alert-danger hidden" id="AllotHOD-error"><strong>Oops.!</strong> Something went wrong. Please contact us via support section.</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" onclick="CloseAllotHOD();">Close</button>
              <button type="submit" class="btn btn-primary" id="AllotHOD-FormButton" onclick="AllotHOD();">Allot</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Pop Up Box--> 
<script>
//Function Fetch HOD Data
function fetch_hod_data() {
	$("#HODData-Fetch").html('');
$.ajax({
	type: "POST",
	url: "/online/dashboard_page/forms/fetch_hod.php",
	data: {"action": "fetch_hod_data"},
	dataType: "html",
	success: function (data) {
		//Staff
		$("#HODData-Fetch").append(data);
	}
	});
}
fetch_hod_data();
</script>
<script>
function pushFormData(department_code) {
	$("#allot-hod-department").val(department_code);
	fetch_staff_list(department_code);
}
//Fetch Staff Data JSON
function fetch_staff_list (f) {
	$.ajax({
	type: "POST",
	url: "/online/dashboard_page/forms/fetch.php",
	data: {"department_code": f,
	"action": "fetch_staff_data"},
	dataType: "json",
	success: function (data) {
		$("#allot-hod-staff").html('');
		$("#allot-hod-staff").html('<option value="null">Select a faculty</option>');
		$.each(data , function(k , v ){
	  		$("#allot-hod-staff").append('<option value="'+v.code+'">'+v.name+'</option>');
		});
	}
	});
}
//Allot HOD
function AllotHOD () {
	var department = $("#allot-hod-department").val();
    var hod = $("#allot-hod-staff").val();
	if(hod=='null')
	{
		$("#AllotHOD-warning").removeClass('hidden');
		$("#AllotHOD-Error-Part").html('Staff');
	}
	else
	{
		$.ajax({ 
		type: "POST",
		url: "/online/dashboard_page/forms/allot_hod_form.php",
		beforeSend: function() {$('#Spinner1').removeClass("hidden"); $("#AllotHOD-Form").addClass("hidden"); $("#AllotHOD-FormButton").addClass('hidden');$("#AllotHOD-warning").addClass('hidden');$("#AllotHOD-success").addClass('hidden'); $("#AllotHOD-error").addClass('hidden');},
		data: {
			"department": department,
			"hod": hod,
			"action": "allot-hod"
			  },
		dataType: "json",
		success: function (data) {
			if (data.response == "success") {
				$("#AllotHOD-success").removeClass('hidden');
				$('#Spinner1').addClass("hidden"); 
				fetch_hod_data();
			}
			else
			{
				$('#Spinner1').addClass("hidden"); 
				$("#AllotHOD-Form").removeClass("hidden");
				$("#AllotHOD-FormButton").removeClass('hidden');
				$("#AllotHOD-error").removeClass('hidden');
			}
		}
	});
	}
}
function CloseAllotHOD () {
	$("#AllotHOD-Form").removeClass("hidden");
	$("#AllotHOD-FormButton").removeClass('hidden');
	$("#AllotHOD-warning").addClass('hidden');
	$("#AllotHOD-success").addClass('hidden'); 
	$("#AllotHOD-error").addClass('hidden');
}
</script>