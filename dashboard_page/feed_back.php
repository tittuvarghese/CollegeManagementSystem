<?php
$UserAuthData = $_SESSION['UserAuthData'];
$UserAuthData = unserialize($UserAuthData);
?>
<h2>Feed Back</h2>
<button type='button' class='btn btn-success'>View Response</button> 
<?php if($UserAuthData['role']=='hod')
 echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#AddAQuestion">Add Question</button>';
 ?>
<p>&nbsp;</p>
<?php
if($UserAuthData['role']=='hod')
{
?>
<div id="FeedBackQuestion">
  <table class="table table-bordered text-center" id="UserData-Fetch">
  <tr>
   <td><strong>#</strong></td>
   <td><strong>Question</strong></td>
   <td><strong>Added Date</strong></td>
   <td><strong>Operation</strong></td>
  </tr>
  <?php
  $count = 0;
  $questions = mysql_query("SELECT * FROM `feedback_questions` WHERE department_code='{$UserAuthData['department']}' ORDER BY timestamp DESC LIMIT 10");
  while($row=mysql_fetch_array($questions))
  {
	  $count++;
	  echo"<tr>";
	  echo "<td>".$count."</td>";
	  echo "<td>".$row['question']."</td>";
	  echo "<td>".$row['timestamp']."</td>";
	  echo "<td><a href='delete.php?p=feed_question&id=".$row['id']."'><button type='button' class='btn btn-danger'>Delete</button></a></td>";
	  echo"</tr>";
  }
  ?>
  </table>
</div>
<!--Pop Up Add Question-->
<div class="container-fluid">
  <div class="row-fluid">
    <div class="col-lg-12">
      <div class="modal fade" id="AddAQuestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Add a Question</h4>
            </div>
            <div class="modal-body">
              <?php $x=1; include('spinner.php'); ?>
              <form id="AddAQuestion-Form">
                <div class="form-group">
                  <input type="text" name="add-question-department" id="add-question-department" class="form-control" placeholder="Enter Year of Admission" required="required" value="<?php echo $UserAuthData['department']; ?>" readonly="readonly">
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="add-question-text" id="add-question-text" placeholder="Enter a Question"></textarea>
                </div>
              </form>
              <div class="alert alert-warning hidden" id="AddAQuestion-warning"> Please enter a valid <span id="AddAQuestion-error-part"></span>.</div>
              <div class="alert alert-success hidden" id="AddAQuestion-success"> You have successfully added new question. <br/></div>
              <div class="alert alert-danger hidden" id="AddAQuestion-error"><strong>Oops.!</strong> Something went wrong. Please contact us via support section.</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" onclick="AddAQuestionClose();">Close</button>
              <button type="submit" class="btn btn-primary" id="AddAQuestion-FormButton" onclick="AddAQuestion();">Register</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Pop Up Add Question-->
<script>
function AddAQuestion () {
	var question = $("#add-question-text").val();
	var department_code = $("#add-question-department").val();
	if(question.length<1)
	{
		$("#AddAQuestion-warning").removeClass('hidden');
		$("#AddAQuestion-error-part").html('Question');
	}
	else
	{
		 $.ajax({ 
		type: "POST",
		url: "/online/dashboard_page/forms/feedback_add_question.php",
		beforeSend: function() {$('#Spinner1').removeClass("hidden"); $("#AddAQuestion-Form").addClass("hidden"); $("#RegisterNewBatch-FormButton").addClass('hidden');$("#AddAQuestion-warning").addClass('hidden');$("#AddAQuestion-success").addClass('hidden'); $("#AddAQuestion-error").addClass('hidden');},
		data: {
			"department_code": department_code,
			"question": question,
			"action": "feed_back_add_question"
			  },
		dataType: "json",
		success: function (data) {
			if (data.response == "success") {
				$("#AddAQuestion-success").removeClass('hidden');
				$('#Spinner1').addClass("hidden");
				setTimeout(function () {
				location.reload(); 
				},2000);
			}
			else
			{
				$('#Spinner1').addClass("hidden"); 
				$("#AddAQuestion-Form").removeClass("hidden");
				$("#AddAQuestion-FormButton").removeClass('hidden');
				$("#AddAQuestion-error").removeClass('hidden');
			}
		}
	});
	}
}
</script>
<?php }?>