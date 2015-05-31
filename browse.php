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

?>
<html>
 <head>
  <meta charset="UTF-8">
  <title><?php echo $site_name?> - Files</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="js/script.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/fileinput.min.js"></script>
	<script type="text/javascript" src="js/ekko-lightbox.js"></script>
		
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap-theme.css">
	<link rel="stylesheet" href="css/ekko-lightbox.css">
	
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
	<p class="navbar-text pull-left"><?php echo $_SESSION['username']?>  </p>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Files <span class="sr-only">(current)</span></a></li>        
      </ul>
      <form class="navbar-form navbar-left" role="search">
		<div class="form-group has-feedback">
			<input type="text" class="form-control" placeholder="Search" />
			<i class="glyphicon glyphicon-search form-control-feedback"></i>
		</div>		
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">

		<li>
          <a href="#" data-jiggle="tooltip" data-placement="bottom" data-original-title="Share" class="glyphicon glyphicon glyphicon-share" aria-hidden="true"></a>
        </li>
		<li>
          <a href="#" data-toggle="modal" data-jiggle="tooltip" data-target="#uploadModal" data-placement="bottom" data-original-title="Upload" class="glyphicon glyphicon glyphicon-cloud-upload" aria-hidden="true"></a>
        </li>
		<li>
          <a href="#" data-jiggle="tooltip" data-placement="bottom" data-toggle="modal" data-target="#newFolderModal" data-original-title="New folder" class="glyphicon glyphicon-folder-open" aria-hidden="true"></a>
        </li>
		<li>

		</li>
		
		
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
 <div class="col-xs-2">
	<ul class="nav nav-pills" role="tablist">
  <li role="presentation"><a href="#" class="jiffysquad watashi">Upload </a></li>
  <li role="presentation"><a href="#" class="jiffysquad">New Folder</a></li>
  <li role="presentation"><a href="#">Messages</a></li>
  <li role="presentation"><a>Storage</a></li>
</ul>

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









     
<nav id="context-menu" class="context-menu">
    <ul class="context-menu__items nav nav-stacked nav-pills">
      <li class="context-menu__item">
        <a data-action="View" class="glyphicon glyphicon-download-alt">&emsp;Download</a>
      </li>
      <li class="context-menu__item">
        <a data-action="View" onclick="setDeleteModaInfo();" data-toggle="modal" data-target="#deleteModal" class="glyphicon glyphicon-remove">&emsp;Delete</a>
      </li>
      <li class="context-menu__item">
        <a data-action="View" onclick="setRenamePlaceholder();" data-toggle="modal" data-target="#renameModal" class="glyphicon glyphicon-pencil">&emsp;Rename</a>
      </li>
		<li class="context-menu__item">
        <a data-action="View" class="glyphicon glyphicon-retweet">&emsp;Move</a>
      </li>
	  <li class="context-menu__item">
        <a data-action="View" data-toggle="modal" data-target="#shareWithModal" class="glyphicon glyphicon-share">&emsp;Share</a>
      </li>
    </ul>
  </nav>
  

  <script src="js/contextmenu.js"></script>
  <script>theClickedItemName = '';theClickedItemId='';</script>
  
 
 <!-- Uploading Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModelLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="uploadModelLabel">Upload</h4>
      </div>
      <div class="modal-body" id="upload-modal-body">
			<input id="images" name="images[]" type="file" multiple>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

 <!-- New Folder Modal -->
<div class="modal fade" id="newFolderModal" tabindex="-1" role="dialog" aria-labelledby="newFolderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="newFolderModalLabel">Create new folder</h4>
      </div>
      <div class="modal-body">
		<div class="form-group has-feedback">
			<label class="control-label">Folder name:</label>
			<input type="text" class="form-control" id="newFolderName" placeholder="New Folder" />
			<i class="glyphicon glyphicon-folder-open form-control-feedback"></i>
		</div>
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-success" onclick="createNewFolder()" id="newFolderBtn">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
 <!-- New Folder Modal -->
 
  <!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="deleteModalLabel">Confirm Deletion</h4>
      </div>
      <div class="modal-body">
		<div class="form-group has-feedback">
			<label class="control-label">Are you sure you want to delete </label>
			<label data-attr="" id="deleteItemText">None</label><br>
		</div>
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-success" onclick="deleteItem()" id="confirmDeleteBtn">Confirm</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
 <!-- Delete Modal -->
 
<!-- Share With Modal -->
<div class="modal fade" id="shareWithModal" tabindex="-1" role="dialog" aria-labelledby="shareWithModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="shareWithModalLabel">Share with</h4>
      </div>
      <div class="modal-body">
		<div class="form-group has-feedback">
			<label class="control-label">Enter the email of the person to share with:</label>
			<input type="text" class="form-control" id="shareWithEmail" placeholder="james@live.com" />
			<i class="glyphicon glyphicon-folder-open form-control-feedback"></i>
			
			<span>Write Access<input type="checkbox" class="form-control" id="shareWithWrite"/></span>	
		</div>
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-success" onclick="shareWith()" id="shareWithBtn">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- Share With Modal -->
 
  <!-- Rename Modal -->
<div class="modal fade" id="renameModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="renameModalLabel">Rename item</h4>
      </div>
      <div class="modal-body">
		<div class="form-group has-feedback">
			<label class="control-label">New name:</label>
			<input type="text" class="form-control" id="newRenamedName" placeholder="INSERT ORIGINAL NAME" />
			<i class="glyphicon glyphicon-folder-open form-control-feedback"></i>
		</div>
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-success" onclick="renameItem()" id="renameBtn">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
 <!-- Rename Modal -->
 
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
 
 <!-- Show New Folder Modal -->
 <script>
 function createNewFolder() 
 {
	var folder_name = $("#newFolderName").val();
	var cdir = "home";
	if (typeof currentDir !== 'undefined') 
	{
		cdir = currentDir;
	}
	cdir = cdir + "/";
 
	 $("#newFolderBtn").prop("disabled",true);
	 $.post( "new_folder.php", {foldername:folder_name, curdir:cdir}, function( data ) {
	  $( ".result" ).html( data );
		$("#newFolderName").val("");
		$('#newFolderModal').modal('hide'); 
		window.location.hash = cdir + folder_name;
	 });

}; 
 </script>
<!-- End Show New Folder Modal -->


 <!-- Set rename placeholder text -->
 <script>
 function setRenamePlaceholder() 
 {
	if(!theClickedItemName)
		return;
	if(!theClickedItemId)
		return;
	if(theClickedItemName == '')
		return;
	var item_name = theClickedItemName;
	$("#newRenamedName").attr('placeholder',theClickedItemName);
	
}; 
 </script>
<!-- Set rename placeholder text -->

 <!-- Set delete modal info -->
 <script>
 function setDeleteModaInfo() 
 {
	if(!theClickedItemName)
		return;
	if(!theClickedItemId)
		return;
	if(theClickedItemName == '')
		return;
	var item_name = theClickedItemName;
	$("#deleteItemText").attr('data-attr',theClickedItemId);
	$("#deleteItemText").text(theClickedItemName);
	
	
}; 
 </script>
<!-- Set delete modal info -->

 <!-- Delete item -->
 <script>
 function deleteItem() 
 {
	if(!theClickedItemId)
		return;
				 
	 $("#confirmDeleteBtn").prop("disabled",true);
	 $.post("delete_item.php", {
		 item_id : theClickedItemId
	 }
	 , function( data ) {
	  $( ".result" ).html( data );
		$('#deleteModal').modal('hide'); 
	 });
}; 
 </script>
<!-- End Delete item -->


 <!-- Show Rename Modal -->
 <script>
 function renameItem() 
 {

	if(!theClickedItemName)
		return;
	if(!theClickedItemId)
		return;
	
	if(theClickedItemName == '')
		return;
	var new_name = $("#newRenamedName").val();
	if(!new_name)
		return;
	if(new_name == '')
		return;
		
	var cdir = "home";
	if (typeof currentDir !== 'undefined') 
	{
		cdir = currentDir;
	}
	cdir = cdir + "/";
	
	 
	 $("#renameBtn").prop("disabled",true);
	 $.post("rename_item.php", {
		 original_name:theClickedItemName,
		 original_id:theClickedItemId,
		 renamed_name: new_name,
		 current_dir: cdir
	 }
	 , function( data ) {
	  $( ".result" ).html( data );
		$("#newRenamedName").val("");
		$('#renameModal').modal('hide'); 
		window.location.hash = cdir;
	 });
}; 
 </script>
<!-- End Show Rename Modal -->

 <!-- Share With -->
 <script>
 function shareWith() 
 {
	if(!theClickedItemName)
		return;
	if(!theClickedItemId)
		return;
	
	if(theClickedItemName == '')
		return;
	var email_ = $("#shareWithEmail").val();
	var write_ = $("#shareWithWrite").is(':checked');
	if(!email_)
		return;
	if(email_ == '')
		return;
	 
	 $("#shareWithBtn").prop("disabled",true);
	 $.post("share_with.php", {
		 original_id: theClickedItemId,
		 email : email_,
		 write : write_
	 }
	 , function( data ) {
	  $( ".result" ).html( data );
		$("#shareWithEmail").val("");
		$('#shareWithModal').modal('hide'); 
	 });
}; 
 </script>
<!-- Share With -->
 
  <!-- Upload Script -->
 <script>
 $(document).on("ready", function() {
	 	 		
    $("#images").fileinput({
        uploadAsync: false,
        uploadUrl: "upload.php", // your upload server url
		uploadExtraData:function(){
		var cdir = "home";
		if (typeof currentDir !== 'undefined') 
		{
			cdir = currentDir;
		}
		cdir = cdir + "/";
		return {curdir: cdir}}
            

    });
});
 </script>
  <!-- End Upload Script-->
 
 <script>
 $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
}); 
 </script>
 
 <script>
 //This is not working. The event handler is lost when the table is generated
$(document).ready(function(){
  $('.jiffysquad').click(function(){
    alert($(this).attr('href'));
    // or alert($(this).hash();
  });
});
 </script>

 <script type="text/javascript">
$(document).ready(function(){
    $('[data-jiggle="tooltip"]').tooltip();   
});
</script>
  <?php include("footer.php");?>
</html>