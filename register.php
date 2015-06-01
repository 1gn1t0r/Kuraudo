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
<a href="index.php" class="navbar-brand">Kuraudo </a>
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
		<form role="form" action="control/add_user.php" method="post">
			<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
			<div class="panel panel-primary">
      <div class="panel-heading">
	   <h4 class="panel-title" id="panel-title">Please sign up<a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h4>
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
					 By clicking <strong class="label label-primary">Register</strong>, you agree to the <a href="" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a> set out by this site, including our Cookie Use.
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



 <!-- New Folder Modal -->
<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="t_and_c_mLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="t_and_c_mLabel">Terms and Conditions</h4>
      </div>
      <div class="modal-body">
		

<h4>
	1. Terms
</h4>

<p>
	By accessing this web site, you are agreeing to be bound by these 
	web site Terms and Conditions of Use, all applicable laws and regulations, 
	and agree that you are responsible for compliance with any applicable local 
	laws. If you do not agree with any of these terms, you are prohibited from 
	using or accessing this site. The materials contained in this web site are 
	protected by applicable copyright and trade mark law.
</p>

<h4>
	2. Use License
</h4>

<ol type="a">
	<li>
		Permission is granted to temporarily download one copy of the materials 
		(information or software) on Kuraudo's web site for personal, 
		non-commercial transitory viewing only. This is the grant of a license, 
		not a transfer of title, and under this license you may not:
		
		<ol type="i">
			<li>modify or copy the materials;</li>
			<li>use the materials for any commercial purpose, or for any public display (commercial or non-commercial);</li>
			<li>attempt to decompile or reverse engineer any software contained on Kuraudo's web site;</li>
			<li>remove any copyright or other proprietary notations from the materials; or</li>
			<li>transfer the materials to another person or "mirror" the materials on any other server.</li>
		</ol>
	</li>
	<li>
		This license shall automatically terminate if you violate any of these restrictions and may be terminated by Kuraudo at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession whether in electronic or printed format.
	</li>
</ol>

<h4>
	3. Disclaimer
</h4>

<ol type="a">
	<li>
		The materials on Kuraudo's web site are provided "as is". Kuraudo makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties, including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights. Further, Kuraudo does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its Internet web site or otherwise relating to such materials or on any sites linked to this site.
	</li>
</ol>

<h4>
	4. Limitations
</h4>

<p>
	In no event shall Kuraudo or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption,) arising out of the use or inability to use the materials on Kuraudo's Internet site, even if Kuraudo or a Kuraudo authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.
</p>
			
<h4>
	5. Revisions and Errata
</h4>

<p>
	The materials appearing on Kuraudo's web site could include technical, typographical, or photographic errors. Kuraudo does not warrant that any of the materials on its web site are accurate, complete, or current. Kuraudo may make changes to the materials contained on its web site at any time without notice. Kuraudo does not, however, make any commitment to update the materials.
</p>

<h4>
	6. Links
</h4>

<p>
	Kuraudo has not reviewed all of the sites linked to its Internet web site and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by Kuraudo of the site. Use of any such linked web site is at the user's own risk.
</p>

<h4>
	7. Site Terms of Use Modifications
</h4>

<p>
	Kuraudo may revise these terms of use for its web site at any time without notice. By using this web site you are agreeing to be bound by the then current version of these Terms and Conditions of Use.
</p>

<h4>
	8. Governing Law
</h4>

<p>
	Any claim relating to Kuraudo's web site shall be governed by the laws of the State of North West without regard to its conflict of law provisions.
</p>

<p>
	General Terms and Conditions applicable to Use of a Web Site.
</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 <!-- New Folder Modal -->



</div>
</body>

</html>

 </body>
 <?php include("footer.php");?>
 
</html>