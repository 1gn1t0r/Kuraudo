<?php
include("config.php");
session_start();
$user_id = '';
$username = '';
if(isset( $_SESSION['user_id'] ))
{
    $user_id = $_SESSION['user_id'];
	$username = $_SESSION['username'];
}
else
{
}

?>
<html>
 <head>
  <meta charset="UTF-8">
  <title><?php echo $site_name?> - Privacy Policy</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/fileinput.min.js"></script>
	<script src="js/Chart.js"></script>
		
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap-theme.css">
	
	<link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/styles.css" />

  
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
	<p class="navbar-text pull-left"><?php echo $username?>  </p>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
	    <li ><a href="browse.php">Files <span class="sr-only"></span></a></li>   
        <li class="active"><a href="#">Privacy Policy <span class="sr-only">(current)</span></a></li>        
      </ul>
      <ul class="nav navbar-nav navbar-right">
		<?php if(isset( $_SESSION['user_id'] ))
        echo '<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Account <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="profile.php">Profile</a></li>
            <li><a href="#">Settings</a></li>
            <li class="divider"></li>
            <li><a href="control/logout.php">Sign out</a></li>
          </ul>
        </li>';
		?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
 
<div class="container">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">

<h2>
	Privacy Policy
</h2>

<p>
	Your privacy is very important to us. Accordingly, we have developed this Policy in order for you to understand how we collect, use, communicate and disclose and make use of personal information. The following outlines our privacy policy.
</p>

<ul>
	<li>
		Before or at the time of collecting personal information, we will identify the purposes for which information is being collected.
	</li>
	<li>
		We will collect and use of personal information solely with the objective of fulfilling those purposes specified by us and for other compatible purposes, unless we obtain the consent of the individual concerned or as required by law.		
	</li>
	<li>
		We will only retain personal information as long as necessary for the fulfillment of those purposes. 
	</li>
	<li>
		We will collect personal information by lawful and fair means and, where appropriate, with the knowledge or consent of the individual concerned. 
	</li>
	<li>
		Personal data should be relevant to the purposes for which it is to be used, and, to the extent necessary for those purposes, should be accurate, complete, and up-to-date. 
	</li>
	<li>
		We will protect personal information by reasonable security safeguards against loss or theft, as well as unauthorized access, disclosure, copying, use or modification.
	</li>
	<li>
		We will make readily available to customers information about our policies and practices relating to the management of personal information. 
	</li>
</ul>

<p>
	We are committed to conducting our business in accordance with these principles in order to ensure that the confidentiality of personal information is protected and maintained. 
</p>		

			
	</div>
    <div class="col-md-2"></div>
  </div>

  <br><br><br><br><br><br>

</div>

 </body>
  <?php include("footer.php");?>
</html>