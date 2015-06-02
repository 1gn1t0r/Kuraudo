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
$cdir = $_SESSION['home_dir'];
?>
<html>
 <head>
  <meta charset="UTF-8">
  <title><?php echo $site_name?> - Files</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="js/files_browser.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/fileinput.min.js"></script>	
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap-theme.css">	
	<link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/styles.css" />

 
 </head>

<body>

<!-- Navigation Bar-->
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
      <ul class="nav navbar-nav navbar-right">

	  
		<li>
          <a data-toggle="modal" onclick="setPublicModalInfo();" data-target="#publicFolderModal" data-jiggle="tooltip" data-placement="bottom" data-original-title="Public Folder" class="glyphicon glyphicon-cloud" aria-hidden="true"></a>
        </li>
		<li>
          <a data-toggle="modal" onclick="setShareWithModalInfo();" data-target="#shareWithModal" data-jiggle="tooltip" data-placement="bottom" data-original-title="Share" class="glyphicon glyphicon-share" aria-hidden="true"></a>
        </li>
		<li>
          <a href="#" data-toggle="modal" data-jiggle="tooltip" data-target="#uploadModal" data-placement="bottom" data-original-title="Upload" class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></a>
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
            <li><a href="control/logout.php">Sign out</a></li>
          </ul>
        </li>
      </ul>
	  </div>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- Navigation Bar -->
 
 <!-- Container Menu -->
<div class="container">
<input type="hidden" id="default-dir" data-attr="<?php echo $cdir; ?>"></input>
	<div class="row">
		<div class="col-xs-2">
		</div>
		 <div class="col-xs-10">
			<!-- Filemanager -->
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
			<!-- Filemanager -->
		</div>
	</div>
</div>
<!-- Container Menu -->

<!-- Context Menu -->     
<nav id="context-menu" class="context-menu">
    <ul class="context-menu__items nav nav-stacked nav-pills">
      <li class="context-menu__item">
        <a data-action="View" onclick="setDeleteModaInfo();" data-toggle="modal" data-target="#deleteModal" class="glyphicon glyphicon-remove">&emsp;Delete</a>
      </li>
      <li class="context-menu__item">
        <a data-action="View" onclick="setRenamePlaceholder();" data-toggle="modal" data-target="#renameModal" class="glyphicon glyphicon-pencil">&emsp;Rename</a>
      </li>
    </ul>
</nav>
<!-- Context Menu -->  

<!-- Context Menu Javascript-->
<script src="js/contextmenu.js"></script>
<script>theClickedItemName = '';theClickedItemId=''; isClickedItemFolder=0;</script>
<!-- Context Menu Javascript -->  
 
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
<!-- Uploading Modal -->

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
        <h4 class="modal-title" id="previewItemModalLabel">Preview</h4>
      </div>
      <div class="modal-body">
		<center>
		<img id="previewImg" src="" alt=""/>
		</center>
      </div>
	  <div class="modal-footer">
		<a role="button" class="btn btn-primary" href="google.com" id="btnDownloadPreview">Download</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Preview Modal -->
  
<!-- Public Folder Modal -->
<div class="modal fade" id="publicFolderModal" tabindex="-1" role="dialog" aria-labelledby="publicFolderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="publicFolderModalLabel">Public file folder sharing</h4>
      </div>
      <div class="modal-body">
		<div class="form-group has-feedback">
			<span><label class="control-label" id="public-description">Enable public sharing for this folder</label> <input onChange="setPublicModalInfoonChecked();" type="checkbox" class="form-control" id="publicSharingCheckBox"/></span>
			<input type="text" class="form-control" id="publicFolderUrl" placeholder=""> </input>
		</div>
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-success" onclick="setPublicFolder()" id="publicSharingBtn">Confirm</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- Public Folder Modal -->

<div class="result"></div>

</body>
 
<!-- Show New Folder Modal -->
 <script>
 function createNewFolder() 
 {
	var folder_name = $("#newFolderName").val();
	var cdir = <?php echo $cdir;?>;
	if (typeof currentDir !== 'undefined') 
	{
		cdir = currentDir;
	}
	 $("#newFolderBtn").prop("disabled",true);
	 $.post( "control/new_folder.php", {foldername:folder_name, curdir:cdir}, function( data ) {
	  $( ".result" ).html( data );
	  $("#newFolderBtn").prop("disabled",false);
		$("#newFolderName").val("");
		$('#newFolderModal').modal('hide'); 
		//location.reload();
		//navigate_dir(5);
	
		 $(window).trigger("hashchange");
	 });

}; 
 </script>
<!-- Show New Folder Modal -->

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

<!-- Set public share modal info -->
 <script>
 function setPublicModalInfo() 
 {
	var cdir = <?php echo $cdir;?>;
	if (typeof currentDir !== 'undefined') 
	{
		cdir = currentDir;
	}
	
	
	$.post("control/get_public_shared.php", {
		 folder_id : cdir
	 }
	 , function( data ) {
		if(data == 1)
		{
			$("#publicFolderUrl").show();
			var server_path = "<?php echo "http://" . $_SERVER['SERVER_NAME'];?>";
			var cur_path = "<?php echo $_SERVER['REQUEST_URI']; ?>";
			var pathArray = window.location.pathname.split( '/' );
			var newPathname = "";
			for (i = 0; i < pathArray.length-1; i++) {
			  newPathname += pathArray[i];
			  newPathname += "/";
			}
			$("#publicFolderUrl").val(server_path + newPathname + "public.php#"+cdir);
			$("#publicSharingCheckBox").prop('checked', true);
		}
		else
		{
			$("#publicFolderUrl").hide();
			$("#publicSharingCheckBox").prop('checked', false);
		}
		
	 });
	 
	 	$.post("control/get_dir_name.php", {
		 dir_id : cdir
	 }
	 , function( data ) {
		$("#public-description").text("Enable public sharing for " + data + " folder");
	 });

}; 
 </script>
<!-- Set public share modal info -->

<!-- Set public share modal info onChecked -->
 <script>
 function setPublicModalInfoonChecked() 
 {
	var cdir = <?php echo $cdir;?>;
	if (typeof currentDir !== 'undefined') 
	{
		cdir = currentDir;
	}
	
		if($("#publicSharingCheckBox").prop('checked'))
		{
			$("#publicFolderUrl").show();
			var server_path = "<?php echo "http://" . $_SERVER['SERVER_NAME'];?>";
			var cur_path = "<?php echo $_SERVER['REQUEST_URI']; ?>";
			var pathArray = window.location.pathname.split( '/' );
			var newPathname = "";
			for (i = 0; i < pathArray.length-1; i++) {
			  newPathname += pathArray[i];
			  newPathname += "/";
			}
			$("#publicFolderUrl").val(server_path + newPathname + "public.php#"+cdir);
		}
		else
		{
			$("#publicFolderUrl").hide();
		}


}; 
 </script>
<!-- Set public share modal info onChecked -->

<!-- Set share with modal info -->
 <script>
 function setShareWithModalInfo() 
 {
	var cdir = <?php echo $cdir;?>;
	if (typeof currentDir !== 'undefined') 
	{
		cdir = currentDir;
	}
	
	$.post("control/get_dir_name.php", {
		 dir_id : cdir
	 }
	 , function( data ) {
		$("#shareWithModalLabel").text("Share " + data + " with");
	 });
	
	
}; 
 </script>
<!-- Set share with modal info -->

<!-- Delete item -->
<script>
 function deleteItem() 
 {
	if(!theClickedItemId)
		return;
				 
	 $("#confirmDeleteBtn").prop("disabled",true);
	 $.post("control/delete_item.php", {
		 item_id : theClickedItemId,
		 is_dir: isClickedItemFolder
	 }
	 , function( data ) {
	 $("#confirmDeleteBtn").prop("disabled",false);
	  $( ".result" ).html( data );
		$('#deleteModal').modal('hide'); 
		 $(window).trigger("hashchange");
	 });
}; 
 </script>
<!-- Delete item -->

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
		
	var cdir = <?php echo $cdir;?>;
	if (typeof currentDir !== 'undefined') 
	{
		cdir = currentDir;
	}
	 
	 $("#renameBtn").prop("disabled",true);
	 $.post("control/rename_item.php", {
		 original_id:theClickedItemId,
		 renamed_name: new_name,
		 is_dir: isClickedItemFolder
	 }
	 , function( data ) {
	  $( ".result" ).html( data );
	  $("#renameBtn").prop("disabled",false);
		$("#newRenamedName").val("");
		$('#renameModal').modal('hide'); 
		window.location.hash = cdir;
		 $(window).trigger("hashchange");
	 });
}; 
 </script>
<!-- Show Rename Modal -->

<!-- Share With -->
<script>
 function shareWith() 
 {
	var email_ = $("#shareWithEmail").val();
	var write_ = $("#shareWithWrite").is(':checked');
	if(!email_)
		return;
	if(email_ == '')
		return;
	
	var cdir = <?php echo $cdir;?>;
	if (typeof currentDir !== 'undefined') 
	{
		cdir = currentDir;
	}
	 
	 $("#shareWithBtn").prop("disabled",true);
	 $.post("control/share_with.php", {
		 original_id: cdir,
		 email : email_,
		 write : write_
	 }
	 , function( data ) {
	  $( ".result" ).html( data );
		$("#shareWithEmail").val("");
		$('#shareWithModal').modal('hide');
		$("#shareWithBtn").prop("disabled",false);
		
	 });
}; 
 </script>
<!-- Share With -->

<!-- Set Public Folder -->
<script>
 function setPublicFolder() 
 {
	var is_public = $("#publicSharingCheckBox").is(':checked');
	if(is_public)
		is_public = 1;
	else
		is_public = 0;

	var cdir = <?php echo $cdir;?>;
	if (typeof currentDir !== 'undefined') 
	{
		cdir = currentDir;
	}
	 
	 $("#publicSharingBtn").prop("disabled",true);
	 $.post("control/set_public.php", {
		 folder_id: cdir,
		 publicc : is_public
	 }
	 , function( data ) {
	  $( ".result" ).html( data );
		$('#publicFolderModal').modal('hide');
		$("#publicSharingBtn").prop("disabled",false);
		
	 });
}; 
 </script>
<!-- Set Public Folder -->
 
<!-- Upload Script -->
<script>
 $(document).on("ready", function() {
	 	 		
    $("#images").fileinput({
        uploadAsync: false,
        uploadUrl: "control/upload.php", // your upload server url
		uploadExtraData:function(){
		var cdir = <?php echo $cdir;?>;
		if (typeof currentDir !== 'undefined') 
		{
			cdir = currentDir;
		}
		return {curdir: cdir}}
    });
});
	$('#uploadModal').on('hidden.bs.modal', function () {
				$(window).trigger("hashchange");
		});
 </script>
<!-- Upload Script-->
 
<!-- Moving Script -->
<script>
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
	var isFolder = 1;
	if($(ev.target).hasClass("files"))
	{
		ev.dataTransfer.setData("src-id", $(ev.target).attr('data-attr'));
		ev.dataTransfer.setData("is-dir", 0);
	}
	else
	{
		ev.dataTransfer.setData("src-id", $(ev.target).attr('containing-folder'));
		ev.dataTransfer.setData("is-dir", 1);
	}
	
    
}

function drop(ev) {
    ev.preventDefault();
    var src_id = ev.dataTransfer.getData("src-id");
	var is_folder = ev.dataTransfer.getData("is-dir");
	
	var target_folder_ = $(ev.target).attr('containing-folder');
	
	
	if(!target_folder_)
		return;
	if(!src_id)
		return;
	if(target_folder_ == src_id && is_folder == 1)
		return;
	
	
	 $.post("control/move_item.php", {
		 src_folder: src_id,
		 target_folder : target_folder_,
		 is_dir: is_folder
	 }
	 , function( data ) {
	  $( ".result" ).html( data );
		 $(window).trigger("hashchange");
	 });
	
    //ev.target.appendChild(document.getElementById(data));
}
</script>
<!-- Moving Script -->

 
 <script>
 $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
    event.preventDefault();
	$("#previewImg").attr("src", $(event.target).attr("href"));
	$("#btnDownloadPreview").attr("href", $(event.target).attr("href"));	
	$("#previewItemModalLabel").text("Preview" + $(event.target).text());
	
	$('#previewItemModal').modal('show'); 
}); 
 </script>
 
 <script type="text/javascript">
$(document).ready(function(){
    $('[data-jiggle="tooltip"]').tooltip();   
});
</script>
  <?php include("footer.php");?>
</html>