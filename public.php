<?php
include("config.php");
session_start();
?>
<html>
 <head>
  <meta charset="UTF-8">
  <title><?php echo $site_name?> - Files</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="js/files_browser_public.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/ekko-lightbox.js"></script>
		
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap-theme.css">
	<link rel="stylesheet" href="css/ekko-lightbox.css">
	
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

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
	   <li ><a href="browse.php">Files <span class="sr-only"></span></a></li>   
        <li class="active"><a href="#">Public Files <span class="sr-only">(current)</span></a></li>        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
 
<div class="container">
<input type="hidden" id="default-dir" data-attr="<?php echo $cdir; ?>">

 
<div class="row">
 <div class="col-xs-2">
</div>

 <div class="col-xs-10">

	<div class="filemanager">
	 <div class = "well">
		<ol class="breadcrumb "></ol>
	
		<table class="table data table-striped">
		</table>
					
	<div>
	<img src="images/482.gif" id="loading-indicator" style="display:none" />
	</div>
	</div>
	
</div>
</div>
	
</div>
</div>

 
<!-- Preview Modal -->
<div class="modal fade" id="previewItemModal" tabindex="-1" role="dialog" aria-labelledby="previewItemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="previewItemModalLabel">Create new folder</h4>
      </div>
      <div class="modal-body">
		<img id="previewImg" src="" alt=""/>
      </div>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
 <!-- Preview Modal -->
  
 
<div class="result"></div>

 </body>
 
 
 <script>
 $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
}); 
 </script>
 

  <?php include("footer.php");?>
</html>