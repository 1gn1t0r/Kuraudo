<?php
include("config.php")
?>
<html>
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="with=device-width,initial-scale=1.0">
  <title><?php echo $site_name?> - Login</title>
  <!-- <link rel="stylesheet" type="text/css" href="css/stylesheet.css"/> -->
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap-theme.css">
  <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="css/stylesheet-custom.css">
  <script type="text/javascript" src="jquery-latest.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
  
 </head>
 <body>


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Kuraudo</a>
    </div>
	<div><p>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a>Login <span class="sr-only">(current)</span></a></li>   
	
      </ul>

      <ul class="nav navbar-nav navbar-right">
		<li><a href="privacypolicy.php">Privacy Policy</a></li>  
		<li><a href="tos.php">TOS</a></li>  
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
 

 <div class="container">
 
 
 
 
  <div id="login-overlay" class="modal-dialog">
  <div class="pagination-centered">
  <h1 class="text-center">Share, Protect, Collaborate</h1>
  <blockquote class="text-center">
  <p>
  Kuraudo offers a simple solution to manage online file storage
  </p>
  </blockquote>
  </div>
      <div class="modal-content">
          <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Login</h4>
          </div>
          <div class="modal-body">
              <div class="row">
			
                  <div class="col-xs-6 col-xs-offset-3">
                      <div >
                          <form id="loginForm" method="POST" action="control/login_submit.php" novalidate="novalidate">
                              <div class="form-group has-feedback">
                                  <label for="username" class="control-label">Username</label>
                                  <input type="text" class="form-control" id="username" name="username" value="" required="" title="Please enter you username" placeholder="example@gmail.com">
                                  <i class="glyphicon glyphicon-user form-control-feedback"></i>
								  <span class="help-block"></span>
                              </div>
                              <div class="form-group has-feedback">
                                  <label for="password" class="control-label">Password</label>
                                  <input type="password" class="form-control" id="password" name="password" value="" required="" title="Please enter your password">
								  <i class="glyphicon glyphicon-lock form-control-feedback"></i>
                                  <span class="help-block"></span>
                              </div>
                              <div id="loginErrorMsg" class="alert alert-error hide">Wrong username og password</div>
                              <div class="checkbox">
                                  <label>
                                      <input type="checkbox" name="remember" id="remember"> Remember login
                                  </label>
                              
                              </div>
                              <button type="submit" class="btn btn-success btn-block">Login</button>
                              <a href="register.php" class="btn btn-primary btn-block">Register</a>
							  <a href="/forgot/" class="btn btn-default btn-block">Help to login</a>
                          </form>
                      </div>
                  </div>
  
              </div>
          </div>
      </div>
  </div>

  
  
  

  
  
  
  
  
  
  

</div>

</body>

</html>

 </body>
  <?php include("footer.php");?>
</html>