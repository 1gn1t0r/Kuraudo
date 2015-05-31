<?php
include("config.php")
?>
<html>
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="with=device-width,initial-scale=1.0">
  <title><?php echo $site_name?> - Register</title>
  <!-- <link rel="stylesheet" type="text/css" href="css/stylesheet.css"/> -->
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap-theme.css">
  <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="css/stylesheet-custom.css">
  <!--<script type="text/javascript" src="jquery-latest.min.js"></script>-->
   <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/bootstrap-custom.js"></script>
  
 </head>
<body>

<div class="navbar navbar-static-top">
<div class="container">
<a href="google.com" class="navbar-brand">Kuraudo </a>
<p class="navbar-text">Please sign in</p>
</div>
 </div>

 <?php

/*** begin our session ***/
session_start();

/*** set a form token ***/
$form_token = md5( uniqid('auth', true) );

/*** set the session form token ***/
$_SESSION['form_token'] = $form_token;
?>

 
 
<div class="container">

<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form role="form" action="add_user.php" method="post">
			<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
			<div class="panel panel-primary">
      <div class="panel-heading">
	   <h3 class="panel-title" id="panel-title">Please sign up<a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
      </div>
      <div class="panel-body">

	
			
		
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
                        <input type="text" name="fname" id="fname" class="form-control input-lg" placeholder="First Name" tabindex="1">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="lname" id="lname" class="form-control input-lg" placeholder="Last Name" tabindex="2">
					</div>
				</div>
			</div>
			<div class="form-group">
				<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Username" tabindex="3">
			</div>
			<div class="form-group">
				<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4">
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4 col-sm-3 col-md-3">
					<span class="button-checkbox">
						
						<div class="checkbox">
						<label><input type="checkbox" value="" name="tos">I agree</label>
						</div>

					</span>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-9">
					 By clicking <strong class="label label-primary">Register</strong>, you agree to the <a href="#" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a> set out by this site, including our Cookie Use.
				</div>
			</div>
			
		
			<div class="row">
				<div class="col-xs-12 col-md-6"><input type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>

			</div>
			</div>
      </div>
		</form>
	</div>
</div>

</div>

</body>

</html>

 </body>
 <?php include("footer.php");?>
 
</html>