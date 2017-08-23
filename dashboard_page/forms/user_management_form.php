<?php
include_once('../../config.php');
$action =$_POST['action'];
if($action=='add_new_college_admin')
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
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$designation=$_POST['designation'];
	$password  = strtolower (str_replace(' ', '', $name)).$phone; //Password namephone Eg. tittu8547960432
	$password2 = $password;
	$password = md5($password);
	$userid = rand(123,1795).strtolower(preg_replace('/\s+/', '', $name)).random_string(5);
	if($designation!='admin')
	 $table='login_college_admin';
	else
	 $table = 'login_admin';
	
	//Checking Whether Principal is already assigned.
	if($designation!='admin')
	{
	$Principal_Check = mysql_query("SELECT * FROM `$table` WHERE role = '$designation'");
	$Principal_Check_Count = mysql_num_rows($Principal_Check);
	if($Principal_Check_Count>0)
	{
		$UpdateQuery = mysql_query("UPDATE `$table` SET userid='$userid',name='$name',email='$email',phone='$phone',password='$password' WHERE role='$designation'");
		if($UpdateQuery)
		{
		 $response['response']="success";
		 $response['pass']=$password2;
		}
		else
	 	{
		 $response['response']="error".mysql_error();
	 	}
		$response = json_encode($response); 
	 	echo $response;
	}
	else
	{
		$InsertQuery = mysql_query("INSERT into `$table` (userid,name,email,phone,password,role) VALUES ('$userid','$name','$email','$phone','$password','$designation')");
		if($InsertQuery)
		{
		 $response['response']="success";
		 $response['pass']=$password2;
		}
		else
	 	{
		 $response['response']="error".mysql_error();;
	 	}
		$response = json_encode($response); 
	 	echo $response;
	}
	}
	else
	{
		$InsertQuery = mysql_query("INSERT into `$table` (userid,name,email,phone,password,role) VALUES ('$userid','$name','$email','$phone','$password','$designation')");
		if($InsertQuery)
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
}
?>