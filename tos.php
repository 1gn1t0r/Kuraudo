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
  <title><?php echo $site_name?> - Terms and Conditions</title>
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
        <li class="active"><a href="#">Terms and Conditions <span class="sr-only">(current)</span></a></li>        
      </ul>
      <ul class="nav navbar-nav navbar-right">
		<?php if(isset( $_SESSION['user_id'] ))
		echo '
        <li class="dropdown">
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
	Web Site Terms and Conditions of Use
</h2>

<h3>
	1. Terms
</h3>

<p>
	By accessing this web site, you are agreeing to be bound by these 
	web site Terms and Conditions of Use, all applicable laws and regulations, 
	and agree that you are responsible for compliance with any applicable local 
	laws. If you do not agree with any of these terms, you are prohibited from 
	using or accessing this site. The materials contained in this web site are 
	protected by applicable copyright and trade mark law.
</p>

<h3>
	2. Use License
</h3>

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

<h3>
	3. Disclaimer
</h3>

<ol type="a">
	<li>
		The materials on Kuraudo's web site are provided "as is". Kuraudo makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties, including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights. Further, Kuraudo does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its Internet web site or otherwise relating to such materials or on any sites linked to this site.
	</li>
</ol>

<h3>
	4. Limitations
</h3>

<p>
	In no event shall Kuraudo or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption,) arising out of the use or inability to use the materials on Kuraudo's Internet site, even if Kuraudo or a Kuraudo authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.
</p>
			
<h3>
	5. Revisions and Errata
</h3>

<p>
	The materials appearing on Kuraudo's web site could include technical, typographical, or photographic errors. Kuraudo does not warrant that any of the materials on its web site are accurate, complete, or current. Kuraudo may make changes to the materials contained on its web site at any time without notice. Kuraudo does not, however, make any commitment to update the materials.
</p>

<h3>
	6. Links
</h3>

<p>
	Kuraudo has not reviewed all of the sites linked to its Internet web site and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by Kuraudo of the site. Use of any such linked web site is at the user's own risk.
</p>

<h3>
	7. Site Terms of Use Modifications
</h3>

<p>
	Kuraudo may revise these terms of use for its web site at any time without notice. By using this web site you are agreeing to be bound by the then current version of these Terms and Conditions of Use.
</p>

<h3>
	8. Governing Law
</h3>

<p>
	Any claim relating to Kuraudo's web site shall be governed by the laws of the State of North West without regard to its conflict of law provisions.
</p>

<p>
	General Terms and Conditions applicable to Use of a Web Site.
</p>
			
	</div>
    <div class="col-md-2"></div>
  </div>

  <br><br><br><br><br><br>

</div>

 </body>
  <?php include("footer.php");?>
</html>