<?php
include("../config.php");

function get_public_shared($folder_id) {
    $username = $_SESSION['username'];
	$user_id = $_SESSION['user_id'];
	
	global $mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname;

	$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);

	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
		
	$stmt = $dbh->prepare("Select public from public_folders where folder_id = :folder_id");
	$stmt->bindParam(':folder_id', $folder_id, PDO::PARAM_INT);
	$stmt->execute();
	$public = $stmt->fetchColumn();
	if($public)
	{
		if($public == 1)
		{
			return 1;
		}
	}
	return 0;
	
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

echo get_public_shared($folder_id);
?>