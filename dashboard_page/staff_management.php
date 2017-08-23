<h2>Staff Management</h2>
<div class="form-group">
  <form id="SelectDepartment-Form">
    <select name="select-department" id="select-department" class="form-control">
      <option value="null">Select a Department</option>
      <option value="all">All Staffs</option>
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
<div id="Staff-Data-Window" class="hidden">
  <h4>Staffs - <span id="Department-Name"></span></h4>
  <table class="table table-bordered text-center" id="StaffData-Fetch">
  </table>
</div>
<!--Pop Up Box-->
<div class="container-fluid">
  <div class="row-fluid">
    <div class="col-lg-12">
      <div class="modal fade" id="AddNewStaff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Add New Subject</h4>
            </div>
            <div class="modal-body">
              <?php $x=1; include('./spinner.php'); ?>
              <form id="AddNewStaff-Form" class="form-horizontal">
                <input type="hidden" name="add-new-staff-department" id="add-new-staff-department" class="form-control" placeholder="DepartmentCode" required="required" readonly="readonly">
                <div class="form-group">
                  <label for="Staff-Name" class="col-sm-3 control-label">Name</label>
                  <div class="col-sm-9">
                    <input type="text" name="add-new-staff-name" id="add-new-staff-name" class="form-control" placeholder="Enter Staff Name Eg. Firstname Lastname" required="required">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Staff-DOB" class="col-sm-3 control-label">Date of Birth</label>
                  <div class="col-sm-9">
                    <input type="date" name="add-new-staff-dob" id="add-new-staff-dob" class="form-control" placeholder="Enter Date of Birth Eg. 2014-05-30 (YY-MM-DD)" required="required">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Staff-Email" class="col-sm-3 control-label">E-Mail</label>
                  <div class="col-sm-9">
                    <input type="email" name="add-new-staff-email" id="add-new-staff-email" class="form-control" placeholder="Enter E-Mail Address Eg. sample@sampledomain.com" required="required">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Staff-Phone" class="col-sm-3 control-label">Phone Number</label>
                  <div class="col-sm-9">
                    <input type="text" name="add-new-staff-phone" id="add-new-staff-phone" class="form-control" placeholder="Enter Phone Number Eg. 9876543210" required="required">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Staff-JoinDate" class="col-sm-3 control-label">Join Date</label>
                  <div class="col-sm-9">
                    <input type="date" name="add-new-staff-joindate" id="add-new-staff-joindate" class="form-control" placeholder="Enter Date of Join Eg. 2014-05-30 (YY-MM-DD)" required="required">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Staff-Designation" class="col-sm-3 control-label">Designation</label>
                  <div class="col-sm-9">
                    <select name="add-new-staff-designation" id="add-new-staff-designation" class="form-control">
                      <option value="null" selected="selected">Select a Designation</option>
                      <option value="Professor">Professor</option>
                      <option value="Assistant Professor">Assistant Professor</option>
                      <option value="Guest Lecturer">Guest Lecturer</option>
                      <option value="Lab Assistant">Lab Assistant</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="Staff-Type" class="col-sm-3 control-label">Type</label>
                  <div class="col-sm-9">
                    <select name="add-new-staff-type" id="add-new-staff-type" class="form-control">
                      <option value="null" selected="selected">Select a Type</option>
                      <option value="technical">Technical</option>
                      <option value="no technical">Non Technical</option>
                    </select>
                  </div>
                </div>
              </form>
              <div class="alert alert-warning hidden" id="AddNewStaff-warning"> Please enter a valid <span id="AddNewStaff-Error-Part"></span>.</div>
              <div class="alert alert-success hidden" id="AddNewStaff-success"> You have successfully added new staff. The temporary password generated for the user is <strong><span id="AddNewStaff-password"></span></strong>.</div>
              <div class="alert alert-danger hidden" id="AddNewStaff-error"><strong>Oops.!</strong> Something went wrong. Please contact us via support section.</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" onclick="CloseAddNewStaff();">Close</button>
              <button type="submit" class="btn btn-primary" id="AddNewStaff-FormButton" onclick="AddNewStaff();">Register</button>
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
 {$("#Staff-Data-Window").removeClass('hidden');
 fetch_staff_data();
 }
else
 {$("#Staff-Data-Window").addClass('hidden');}
$("#Department-Name").html(str);
$("#add-new-staff-department").val(str2);
})
//Function Fetch Staff Data
function fetch_staff_data() {
	$("#StaffData-Fetch").html('');
$.ajax({
	type: "POST",
	url: "/online/dashboard_page/forms/fetch_staff.php",
	data: {"department_code": $("#select-department").val(),
	"action": "fetch_staff_data"},
	dataType: "html",
	success: function (data) {
		//Staff
		$( "#StaffData-Fetch").append(data);
	}
	});
}
//Function AddNewStaff
function AddNewStaff () {
	var department = $("#add-new-staff-department").val();
	var name = $("#add-new-staff-name").val();
	var dob = $("#add-new-staff-dob").val();
	var email = $("#add-new-staff-email").val();
	var phone = $("#add-new-staff-phone").val();
	var joindate = $("#add-new-staff-joindate").val();
	var designation = $("#add-new-staff-designation").val();
	var type = $("#add-new-staff-type").val();
	var date_pattern = /^([0-9]{4})\-([0-9]{2})\-([0-9]{2})$/;
	var email_pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var phone_pattern = /^([0-9]{10})$/;
	if(name == null || name=='' || name.length<2)
	{
		$("#AddNewStaff-warning").removeClass('hidden');
		$("#AddNewStaff-Error-Part").html("Name");
	}
	else if(date_pattern.test(dob) == false || dob=='')
	{
		$("#AddNewStaff-warning").removeClass('hidden');
		$("#AddNewStaff-Error-Part").html("Date of Birth YY-MM-DD");
	}
	else if(email_pattern.test(email) == false || email=='')
	{
		$("#AddNewStaff-warning").removeClass('hidden');
		$("#AddNewStaff-Error-Part").html("E-Mail address");
	}
	else if(phone_pattern.test(phone) == false || phone=='')
	{
		$("#AddNewStaff-warning").removeClass('hidden');
		$("#AddNewStaff-Error-Part").html("Phone Number");
	}
	else if(date_pattern.test(joindate) == false || joindate=='')
	{
		$("#AddNewStaff-warning").removeClass('hidden');
		$("#AddNewStaff-Error-Part").html("Date of Join YY-MM-DD");
	}
	else if(designation == null || designation=='null' || designation.length<2)
	{
		$("#AddNewStaff-warning").removeClass('hidden');
		$("#AddNewStaff-Error-Part").html("Designation");
	}
	else if(type == null || type=='null' || type.length<2)
	{
		$("#AddNewStaff-warning").removeClass('hidden');
		$("#AddNewStaff-Error-Part").html("Type");
	}
	else {
		$("#AddNewStaff-warning").addClass('hidden');
		$.ajax({
		type: "POST",
		url: "/online/dashboard_page/forms/staff_management_form.php",
		beforeSend: function() {$('#Spinner1').removeClass('hidden'); $("#AddNewStaff-Form").addClass('hidden');},
		data: {
			"department":department,
			"name":name,
			"dob":dob,
			"email":email,
			"phone":phone,
			"joindate":joindate,
			"designation":designation,
			"type":type,
			"action": "add_new_staff"
		},
		dataType: "json",
		success: function (data) {
			if(data.response=='success')
			{
				$('#Spinner1').addClass('hidden');
				$('#AddNewStaff-success').removeClass('hidden');
				$("#AddNewStaff-password").html(data.pass);
				$("#AddNewStaff-FormButton").addClass('hidden');
				fetch_staff_data();
			}
			else
			{
				$('#Spinner1').addClass('hidden');
				$("#AddNewStaff-Form").removeClass('hidden');
				$('#AddNewStaff-error').removeClass('hidden');
			}
		}
		});
	}
}
function CloseAddNewStaff() {
	$("#AddNewStaff-Form").removeClass('hidden');
	$('#AddNewStaff-error').addClass('hidden');
	$('#AddNewStaff-warning').addClass('hidden');
	$('#AddNewStaff-success').addClass('hidden');
	$("#add-new-staff-name").val('');
	$("#add-new-staff-dob").val('');
	$("#add-new-staff-email").val('');
	$("#add-new-staff-phone").val('');
	$("#add-new-staff-joindate").val('');
	$('#Spinner1').addClass('hidden');
	$("#AddNewStaff-FormButton").removeClass('hidden');
	
}
</script> 
