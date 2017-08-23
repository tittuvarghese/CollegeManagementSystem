<?php
include_once('../../config.php');
$action =$_POST['action'];
if($action=='add_new_staff')
{
//Function Generate Unique ID
function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}
	$department=$_POST['department'];
	$name=$_POST['name'];
	$dob=$_POST['dob'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$joindate=$_POST['joindate'];
	$designation=$_POST['designation'];
	$type=$_POST['type'];
	if($designation=='Head of the Department')
	 $role = 'hod';
	else
	 $role = 'staff';
	$password  = strtolower (str_replace(' ', '', $name)).$phone; //Password namephone Eg. tittu8547960432
	$password2 = $password;
	$password = md5($password);
	$userid = rand(123,1795).strtolower(preg_replace('/\s+/', '', $name)).random_string(5);
	
	$StaffInsert=mysql_query("INSERT into `login_staff` (userid,name,date_of_birth,email,phone,password,role,designation,type,department,joining_date) values ('$userid','$name','$dob','$email','$phone','$password','$role','$designation','$type','$department','$joindate')");
	if($StaffInsert)
	 {
		 $response['response']="success";
		 $response['pass']=$password2;
	 }
	else
	 {
		 $response['response']="error";
	 }
	 $response = json_encode($response); 
	 echo $response;
}
?>