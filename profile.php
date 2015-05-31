<?php
include("config.php");
session_start();
if(isset( $_SESSION['user_id'] ))
{
    	
}
else
{
	header("Location: index.php");
	die(); 
}
$user_id = $_SESSION['user_id'];
?>
<html>
 <head>
  <meta charset="UTF-8">
  <title><?php echo $site_name?> - Files</title>
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
 
 
 
 
 
 
 <?php
 global $mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname;
	$username = $_SESSION['username'];
	$user_id = $_SESSION['user_id'];
	
	$mysqli = new mysqli($mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname);

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
 ?>
 
 
 
 
 
 
 
 
 
 

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
	<p class="navbar-text pull-left"><?php echo $_SESSION['username']?>  </p>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
	    <li ><a href="browse.php">Files <span class="sr-only"></span></a></li>   
        <li class="active"><a href="#">Profile <span class="sr-only">(current)</span></a></li>        
      </ul>
      <ul class="nav navbar-nav navbar-right">
		
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Account <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="profile.php">Profile</a></li>
            <li><a href="#">Settings</a></li>
            <li class="divider"></li>
            <li><a href="logout.php">Sign out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
 
<div class="container">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
	<?php $stmt = $mysqli->prepare("SELECT username, fname, lname, email, description from users, user_plans
	WHERE user_id=? and user_plan = plan_id");
	$stmt->bind_param('d', $user_id);

	$files = array();
	$stmt->execute();
	$stmt->bind_result($username, $fname, $lname, $email, $plan_desc);
	$stmt->fetch(); ?>
	<h2>Profile information</h2>
	<span><label>Username: </label> <label><?php echo $username;?></label></span><br>
	<span><label>First Name: </label> <label><?php echo $fname;?></label></span><br>
	<span><label>Last Name: </label> <label><?php echo $lname;?></label></span><br>
	<span><label>Email: </label> <label><?php echo $email;?></label></span><br>
	<span><label>Plan: </label> <label><?php echo $plan_desc;?></label></span><br>
	
	
	<h2>Current Usage</h2>
	<i>Current space usage</i>
	<br>
	<canvas id="cur_usage" width="400" height="400"></canvas>
	
	<?php
	global $available_usage;
	global $used_usage;
	$stmt = NULL;
    $stmt = $mysqli->prepare("SELECT space_available from user_plans, users where user_id=? and user_plan = plan_id");
	$stmt->bind_param('d', $user_id);

	$files = array();
	$stmt->execute();
	$stmt->bind_result($max_usage);
	$stmt->fetch();
	
	$used_usage = 0;
	$stmt = NULL;
	$stmt = $mysqli->prepare("SELECT sum(file_size) from logical_files, virtual_files 
	WHERE logical_files.file_id = virtual_files.pfile_id
	AND virtual_files.user_id = ?");
	$stmt->bind_param('d', $user_id);
	$stmt->execute();
	$stmt->bind_result($used_usage);
	$stmt->fetch();
	$available_usage = $max_usage - $used_usage;	

?>

<script>

var data = [
    {
        value: <?php echo $available_usage/1024/1024; ?>,
        color:"#F7464A",
        highlight: "#FF5A5E",
        label: "Available space (MB)"
    },
    {
        value: <?php echo $used_usage/1024/1024; ?>,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Used space (MB)"
    }
];
var options = 
{
    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke : true,

    //String - The colour of each segment stroke
    segmentStrokeColor : "#fff",

    //Number - The width of each segment stroke
    segmentStrokeWidth : 2,

    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout : 50, // This is 0 for Pie charts

    //Number - Amount of animation steps
    animationSteps : 100,

    //String - Animation easing effect
    animationEasing : "easeOutBounce",

    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate : true,

    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale : false,

    //String - A legend template
    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"

};

var ctx = document.getElementById("cur_usage").getContext("2d");
var myPieChart = new Chart(ctx).Pie(data,options);
</script>

	<h2>Past download usage</h2>
	<i>Past usage from the last 30 days</i>
	<canvas id="past_usage" width="600" height="400"></canvas>
	<script>
	var data = 
	{
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,0.8)",
            highlightFill: "rgba(220,220,220,0.75)",
            highlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 80, 81, 56, 55, 40]
        }]
	};
	
	var options = 
	{
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero : true,

    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines : true,

    //String - Colour of the grid lines
    scaleGridLineColor : "rgba(0,0,0,.05)",

    //Number - Width of the grid lines
    scaleGridLineWidth : 1,

    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,

    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,

    //Boolean - If there is a stroke on each bar
    barShowStroke : true,

    //Number - Pixel width of the bar stroke
    barStrokeWidth : 2,

    //Number - Spacing between each of the X value sets
    barValueSpacing : 5,

    //Number - Spacing between data sets within X values
    barDatasetSpacing : 1,

    //String - A legend template
    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

}
	
	
	var ctx = document.getElementById("past_usage").getContext("2d");
	var myBarChart = new Chart(ctx).Bar(data, options);
	</script>
	
	
	</div>
    <div class="col-md-2"></div>
  </div>

  <br><br><br><br><br><br>

</div>

 </body>
  <?php include("footer.php");?>
</html>