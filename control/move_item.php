<?php

include("../config.php");


function move_item($src_id, $target_folder, $is_dir) {
    $username = $_SESSION['username'];
	$user_id = $_SESSION['user_id'];
	
	global $mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname;
		
	$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);

	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
		
	if($is_dir == 1)
	{
		$stmt = $dbh->prepare("UPDATE folders SET contained_in=:target_folder WHERE folder_id=:src_folder");
		$stmt->bindParam(':target_folder', $target_folder, PDO::PARAM_INT);
		$stmt->bindParam(':src_folder', $src_id, PDO::PARAM_INT);
		$stmt->execute();
	}
	else
	{
		$stmt = $dbh->prepare("UPDATE virtual_files SET folder_id=:target_folder WHERE vfile_id=:vfile_id");
		$stmt->bindParam(':target_folder', $target_folder, PDO::PARAM_INT);
		$stmt->bindParam(':vfile_id', $src_id, PDO::PARAM_INT);
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

$is_dir = empty($_POST['is_dir']) ? '' : $_POST['is_dir'];
$src_folder = empty($_POST['src_folder']) ? '' : $_POST['src_folder'];
$target_folder = empty($_POST['target_folder']) ? '' : $_POST['target_folder'];
  
move_item($src_folder, $target_folder, $is_dir);
?>