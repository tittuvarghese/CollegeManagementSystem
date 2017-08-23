<?php
include_once('header.php');
include_once('config.php');
if(isset($_SESSION['UserAuthData']))
{
	$UserAuthData=$_SESSION['UserAuthData'];
	$UserAuthData = unserialize($UserAuthData);
}
else
 header('Location: logout.php');

if($UserAuthData)
 include_once('dashboard_page/admin_page.php');
else
 {
?>
<!--Students Account-->
<!--Students Account-->
<?php
 }
include_once('footer.php');
?>