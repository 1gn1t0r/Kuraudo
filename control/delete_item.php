<?php

include("../config.php");


function delete_item($item_id) {
    $username = $_SESSION['username'];
	$user_id = $_SESSION['user_id'];
	
	global $mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname;
		
	$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);

	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
		
	$stmt = $dbh->prepare("DELETE from virtual_files WHERE vfile_id=:vfile_id");
	$stmt->bindParam(':vfile_id', $item_id, PDO::PARAM_INT);
	$stmt->execute();
	
	$stmt = $dbh->prepare("DELETE from virtual_files WHERE vfile_id=:vfile_id");
	$stmt->bindParam(':vfile_id', $item_id, PDO::PARAM_INT);
	$stmt->execute();
			
}

session_start();
if(isset( $_SESSION['user_id'] ))
{
    
}
else
{
	return;
}

$item_id = empty($_POST['item_id']) ? '' : $_POST['item_id'];
  
delete_item($item_id);
?>