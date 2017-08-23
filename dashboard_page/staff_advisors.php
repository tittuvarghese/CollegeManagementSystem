<h2>Staff Advisors</h2>
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
<div id="StaffAdvisor-Data-Window" class="hidden">
  <h4>Staff Advisor - <span id="Department-Name"></span></h4>
  <table class="table table-bordered text-center" id="StaffAdvisorData-Fetch">
  </table>
</div>
<!--Pop Up Box-->
<div class="container-fluid">
  <div class="row-fluid">
    <div class="col-lg-12">
      <div class="modal fade" id="AllotStaffAdvisor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Allot Staff Advisor</h4>
            </div>
            <div class="modal-body">
              <?php $x=1; include('./spinner.php'); ?>
              <form id="AllotStaffAdvisor-Form" class="form-horizontal">
                <div class="form-group">
                  <label for="Staff-Program" class="col-sm-3 control-label">Program</label>
                  <div class="col-sm-9">
                    <input type="text" name="add-new-staffadvisor-program" id="add-new-staffadvisor-program" class="form-control" placeholder="Program Name" required="required" readonly="readonly">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Staff-Department" class="col-sm-3 control-label">Department Name</label>
                  <div class="col-sm-9">
                    <input type="text" name="add-new-staffadvisor-department" id="add-new-staffadvisor-department" class="form-control" placeholder="Department Name" required="required" readonly="readonly">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Staff-Course" class="col-sm-3 control-label">Course</label>
                  <div class="col-sm-9">
                    <input type="text" name="add-new-staffadvisor-course" id="add-new-staffadvisor-course" class="form-control" placeholder="Course Name" required="required" readonly="readonly">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Staff-Batch" class="col-sm-3 control-label">Batch</label>
                  <div class="col-sm-9">
                    <input type="text" name="add-new-staffadvisor-batch" id="add-new-staffadvisor-batch" class="form-control" placeholder="Batch" required="required" readonly="readonly">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Staff-YOA" class="col-sm-3 control-label">Year of Admission</label>
                  <div class="col-sm-9">
                    <input type="text" name="add-new-staffadvisor-yoa" id="add-new-staffadvisor-yoa" class="form-control" placeholder="Batch" required="required" readonly="readonly">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Staff-StaffName" class="col-sm-3 control-label">Staffs</label>
                  <div class="col-sm-9">
                    <select name="add-new-staffadvisor-staff" id="add-new-staffadvisor-staff" class="form-control">
                      <option value="null" selected="selected">Select a faculty</option>
                    </select>
                  </div>
                </div>
              </form>
              <div class="alert alert-warning hidden" id="AllotStaffAdvisor-warning"> Please enter a valid <span id="AllotStaffAdvisor-Error-Part"></span>.</div>
              <div class="alert alert-success hidden" id="AllotStaffAdvisor-success"> You have successfully alloted a staff adisor.</div>
              <div class="alert alert-danger hidden" id="AllotStaffAdvisor-error"><strong>Oops.!</strong> Something went wrong. Please contact us via support section.</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" onclick="CloseAllotStaffAdvisor();">Close</button>
              <button type="submit" class="btn btn-primary" id="AllotStaffAdvisor-FormButton" onclick="AllotStaffAdvisor();">Allot</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Pop Up Box--> 

<script>
//Change Department
$( "#select-department" )
.change(function () {
var str = $( "#select-department option:selected" ).text();
var str2 = $( "#select-department option:selected" ).val();
$( "#select-department option:selected" ).each(function() {
});
if(str2!='null')
 {$("#StaffAdvisor-Data-Window").removeClass('hidden');
 fetch_staff_data();
 }
else
 {$("#StaffAdvisor-Data-Window").addClass('hidden');}
$("#Department-Name").html(str);
})
//Function Fetch Staff Data
function fetch_staff_data() {
	$("#StaffAdvisorData-Fetch").html('');
$.ajax({
	type: "POST",
	url: "/online/dashboard_page/forms/fetch_staff_advisor.php",
	data: {"department_code": $("#select-department").val(),
	"action": "fetch_staffadvisor_data"},
	dataType: "html",
	success: function (data) {
		//Staff
		$( "#StaffAdvisorData-Fetch").append(data);
	}
	});
}
//Function pushFormData
function pushFormData(a,b,c,d,e) {
$("#add-new-staffadvisor-program").val(a);
$("#add-new-staffadvisor-department").val(b);
$("#add-new-staffadvisor-course").val(c);
$("#add-new-staffadvisor-batch").val(d);
$("#add-new-staffadvisor-yoa").val(e);
fetch_staff_list (b);
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
		$("#add-new-staffadvisor-staff").html('');
		$("#add-new-staffadvisor-staff").html('<option value="null">Select a faculty</option>');
		$.each(data , function(k , v ){
	  		$("#add-new-staffadvisor-staff").append('<option value="'+v.code+'">'+v.name+'</option>');
		});
	}
	});
}
function AllotStaffAdvisor () {
var program = $("#add-new-staffadvisor-program").val();
var department = $("#add-new-staffadvisor-department").val();
var course = $("#add-new-staffadvisor-course").val();
var batch = $("#add-new-staffadvisor-batch").val();
var yoa = $("#add-new-staffadvisor-yoa").val();
var staff = $("#add-new-staffadvisor-staff").val();
if(staff=='null')
{
	$("#AllotStaffAdvisor-warning").removeClass('hidden');
	$("#AllotStaffAdvisor-Error-Part").html('Staff');
}
else
{
	$.ajax({ 
		type: "POST",
		url: "/online/dashboard_page/forms/allot_staff_advisor_form.php",
		beforeSend: function() {$('#Spinner1').removeClass("hidden"); $("#AllotStaffAdvisor-Form").addClass("hidden"); $("#AllotStaffAdvisor-FormButton").addClass('hidden');$("#AllotStaffAdvisor-warning").addClass('hidden');$("#AllotStaffAdvisor-success").addClass('hidden'); $("#AllotStaffAdvisor-error").addClass('hidden');},
		data: {
			"program": program,
			"department": department,
			"course": course,
			"batch": batch,
			"yoa": yoa,
			"staff": staff,
			"action": "allot-staff-advisor"
			  },
		dataType: "json",
		success: function (data) {
			if (data.response == "success") {
				$("#AllotStaffAdvisor-success").removeClass('hidden');
				$('#Spinner1').addClass("hidden"); 
				fetch_staff_data();
			}
			else
			{
				$('#Spinner1').addClass("hidden"); 
				$("#AllotStaffAdvisor-Form").removeClass("hidden");
				$("#AllotStaffAdvisor-FormButton").removeClass('hidden');
				$("#AllotStaffAdvisor-error").removeClass('hidden');
			}
		}
	});
}
}
function CloseAllotStaffAdvisor () {
	$("#AllotStaffAdvisor-Form").removeClass("hidden");
	$("#AllotStaffAdvisor-FormButton").removeClass('hidden');
	$("#AllotStaffAdvisor-warning").addClass('hidden');
	$("#AllotStaffAdvisor-success").addClass('hidden'); 
	$("#AllotStaffAdvisor-error").addClass('hidden');
}
</script>