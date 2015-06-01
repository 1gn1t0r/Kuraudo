<?php
include("../config.php");

function set_public_folder($folder_id, $public) {
    $username = $_SESSION['username'];
	$user_id = $_SESSION['user_id'];
	
	global $mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname;
	
	$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
		
	try {
	
		$stmt = $dbh->prepare("INSERT INTO public_folders (folder_id, public) VALUES (:folder_id, :public)");
		$stmt->bindParam(':folder_id', $folder_id, PDO::PARAM_INT);
		$stmt->bindParam(':public', $public, PDO::PARAM_INT);
		$stmt->execute();	
	
	}
	catch(Exception $e)
	{
		$stmt = $dbh->prepare("UPDATE public_folders set public = :public where folder_id = :folder_id");
		$stmt->bindParam(':folder_id', $folder_id, PDO::PARAM_INT);
		$stmt->bindParam(':public', $public, PDO::PARAM_INT);
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

$folder_id = empty($_POST['folder_id']) ? '' : $_POST['folder_id'];
$publicc = empty($_POST['publicc']) ? '' : $_POST['publicc'];
  
set_public_folder($folder_id, $publicc);
?>