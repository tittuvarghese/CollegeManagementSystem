<?php
session_start();
?>
<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
<link href="css/page.css" rel="stylesheet" type="text/css">
<link href="css/docs.css" rel="stylesheet" type="text/css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

</head>
<body>
<header>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="col-lg-12"> <a class="navbar-brand" href="./">Student Management System</a>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Support</a></li>
          <li><a href="#">Help</a></li>
          <?php
		  if(isset($_SESSION['UserAuthData']))
		  {
			  $UserAuthData = $_SESSION['UserAuthData'];
			  $UserAuthData = unserialize($UserAuthData);
		  ?>
		  <li><a href="#">Notifications <span class="badge">3</span></a></li>
          <li class="dropdown">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $UserAuthData['name']; ?> <span class="caret"></span></a>
           <ul class="dropdown-menu" role="menu">
            <li><a href="#">Manage Account</a></li>
            <li><a href="logout.php">Logout</a></li>
           </ul>
          </li>
		  <?php }
		  ?>
        </ul>
      </div>
    </div>
  </div>
</header>
<div class="clearfix"></div>