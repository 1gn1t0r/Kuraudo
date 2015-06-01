<?php

include("../config.php");


function delete_item($item_id, $is_dir) {
    $username = $_SESSION['username'];
	$user_id = $_SESSION['user_id'];
	
	global $mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname;
		
	$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);

	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
		
	if($is_dir == 0)
	{
		$stmt = $dbh->prepare("DELETE from virtual_files WHERE vfile_id=:vfile_id");
		$stmt->bindParam(':vfile_id', $item_id, PDO::PARAM_INT);
		$stmt->execute();
	}
	else
	{
		$stmt = $dbh->prepare("DELETE from folders WHERE folder_id=:item_id");
		$stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
		$stmt->execute();
	}
			
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
$is_dir = empty($_POST['is_dir']) ? '' : $_POST['is_dir'];
  
delete_item($item_id, $is_dir);
?>