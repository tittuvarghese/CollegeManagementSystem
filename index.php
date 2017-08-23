<?php
include_once('header.php');
?>
<!--Login Windows -->
<div class="row-fluid">
  <div class="col-lg-4 col-md-offset-4">
    <div id="Login">
      <div class="v-center">
        <div class="content">
          <div class="table-cell1">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Sign in</h3>
              </div>
              <div class="panel-body">
                <h6><b>Welcome.</b> Sign in to get started!</h6>
                <form action="login-form.php" method="post" enctype="application/x-www-form-urlencoded">
                  <div class="form-group">
                    <input type="email" name="login-email" class="form-control" placeholder="Enter Your E-Mail address" required="required">
                  </div>
                  <div class="form-group">
                    <input type="password" name="login-password" class="form-control" placeholder="Enter your password" required="required">
                  </div>
                  <div class="form-group">
                    <select class="form-control" name="login-role">
                      <option>Login as</option>
                      <option value="staff">Principal</option>
                      <option value="staff">Head of the Department</option>
                      <option value="staff">Staff</option>
                      <option value="student">Students</option>
                      <option value="admin">Admin</option>
                    </select>
                  </div>
                  <div class="form-group">
                   <button class="btn btn-info btn-block" type="submit" name="login-submit">Sign in</button>
                  </div>
                </form>
              </div>
            </div>
            <?php if(isset($_GET['login-error'])&&$_GET['login-error']=='error')
			{
			?>
            <!--Alert Messages / Errors in Login-->
            <div class="alert alert-danger" role="alert"><strong>Failed!</strong> We are unable to authenticate your login. </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Login Windows -->
<?php
include_once('footer.php');
?>