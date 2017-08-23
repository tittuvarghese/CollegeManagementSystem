<?php
include_once('../../config.php');
	$department = $_POST['Student-Data-Department'];
	$program = $_POST['Student-Data-Program'];
	$course_code = $_POST['Student-Data-Course'];
	$batch = $_POST['Student-Data-Batch'];
	$yoa = $_POST['Student-Data-YOA'];
	$table = 'stud_'.$yoa.'_main';
	
function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}	

$FileUploadPath= "uploads/";	
if ((($_FILES["Student-Data-CSV"]["type"] == "application/csv"))
&& ($_FILES["Student-Data-CSV"]["size"] < 20000000))
  {
  if ($_FILES["Student-Data-CSV"]["error"] > 0)
    {
    $result['response']= "Return Code: " . $_FILES["Artwork"]["error"] . "<br />";
    }else{
      $FileName = $program.$department.$course_code.$batch.$yoa.'.' . pathinfo($_FILES['Student-Data-CSV']['name'],PATHINFO_EXTENSION);
      move_uploaded_file($_FILES["Student-Data-CSV"]["tmp_name"],
      $FileUploadPath . $FileName);
	  $FileName = $FileUploadPath . $FileName;
	  //echo $FileName;
	  $result['response']= "Success";
      }
    }else{
    //echo "invalid file";
	$result['response']= "Invalid File";
    }
$file = fopen($FileName,"r");
$data = fgetcsv($file);
if($data[0]=='program' && $data[1]=='department' && $data[2]=='branch' && $data[3]=='batch' && $data[4]=='admission_no' && $data[5]=='roll_no' && $data[6]=='register_no' && $data[7]=='name' && $data[8]=='sex' && $data[9]=='address' && $data[10]=='religion' && $data[11]=='cast' && $data[12]=='reserv_group' && $data[13]=='father_name' && $data[14]=='father_occupation' && $data[15]=='year_of_admission' && $data[16]=='date_of_birth' && $data[17]=='father_mobile_number' && $data[18]=='local_guardian_mobile_number' && $data[19]=='blood_group' && $data[20]=='income' && $data[21]=='email' && $data[22]=='parent_email' && $data[23]=='name_of_local_guardian')
{
	while(!feof($file))
		{
  			$data = fgetcsv($file);
			$userid = rand(123,1795).strtolower(preg_replace('/\s+/', '', $data[7])).random_string(5);
			$password = md5($data[4]);
			$sql = "INSERT into `$table` (user_id,department,branch,program,batch,admno,rollNo,regno,name,sex,address,religion,cast,rsvgroup,fathername,fatheroccupation,yearOfAddmission,dateOfBirth,f_mob,lg_mob,blood_group,income,email,p_email,name_localG) values ('".mysql_real_escape_string($userid)."','".mysql_real_escape_string($data[1])."','".mysql_real_escape_string($data[2])."','".mysql_real_escape_string($data[0])."','".mysql_real_escape_string($data[3])."','".mysql_real_escape_string($data[4])."','".mysql_real_escape_string($data[5])."','".mysql_real_escape_string($data[6])."','".mysql_real_escape_string($data[7])."','".mysql_real_escape_string($data[8])."','".mysql_real_escape_string($data[9])."','".mysql_real_escape_string($data[10])."','".mysql_real_escape_string($data[11])."','".mysql_real_escape_string($data[12])."','".mysql_real_escape_string($data[13])."','".mysql_real_escape_string($data[14])."','".mysql_real_escape_string($data[15])."','".mysql_real_escape_string($data[16])."','".mysql_real_escape_string($data[17])."','".mysql_real_escape_string($data[18])."','".mysql_real_escape_string($data[19])."','".mysql_real_escape_string($data[20])."','".mysql_real_escape_string($data[21])."','".mysql_real_escape_string($data[22])."','".mysql_real_escape_string($data[23])."')";
			$sql2 = "INSERT into `login_student` (userid,admission_number,name,email,password,department,year_of_admission) values ('".mysql_real_escape_string($userid)."','".mysql_real_escape_string($data[4])."','".mysql_real_escape_string($data[7])."','".mysql_real_escape_string($data[21])."','".mysql_real_escape_string($password)."','".mysql_real_escape_string($data[1])."','".mysql_real_escape_string($data[15])."')";
			if(!empty($data))
				{$push_student = mysql_query($sql);
				mysql_query($sql2);
				}
			if($push_student)
			 {
				 echo "Inserted Student ".$data[4]." - ".$data['7']."<br/>";
			 }
			else
			 echo mysql_error();
  		}
}
else
{
	echo "CSV file is not in correct format. Use a Correct Format or download it from <a href='sample/student_data_sample.csv'>here</a>";
}
fclose($file);
?>