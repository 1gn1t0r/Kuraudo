<?php
include("../config.php");

function rename_item($original_id, $renamed_name, $is_dir) {
    $username = $_SESSION['username'];
	$user_id = $_SESSION['user_id'];
	
	global $mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname;

	$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);

	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
	if($is_dir==0)
	{
		$stmt = $dbh->prepare("UPDATE virtual_files SET file_name=:renamed_name where vfile_id=:vfile_id");
		$stmt->bindParam(':renamed_name', $renamed_name, PDO::PARAM_STR);
		$stmt->bindParam(':vfile_id', $original_id, PDO::PARAM_INT);
		$stmt->execute();	
	}
	else
	{
		$stmt = $dbh->prepare("UPDATE folders SET folder_name=:renamed_name where folder_id=:folder_id");
		$stmt->bindParam(':renamed_name', $renamed_name, PDO::PARAM_STR);
		$stmt->bindParam(':folder_id', $original_id, PDO::PARAM_INT);
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

$original_id = empty($_POST['original_id']) ? '' : $_POST['original_id'];
$renamed_name = empty($_POST['renamed_name']) ? '' : $_POST['renamed_name'];
$is_dir = empty($_POST['is_dir']) ? '' : $_POST['is_dir'];
  
rename_item($original_id, $renamed_name, $is_dir);
?>