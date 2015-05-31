<?php


function rename_item($original_name, $original_id, $renamed_name, $current_dir) {
    $username = $_SESSION['username'];
	$user_id = $_SESSION['user_id'];
	
	$mysql_hostname = 'localhost';
    $mysql_username = 'root';
    $mysql_password = '';
    $mysql_dbname = 'kuraudo';
	
	$file_type = 1;//folder
	$file_id = -1;
	
	$did_exist = 0;	

	$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);

	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
		
	$user_path = $home_dir . $folder_name;
	$stmt = $dbh->prepare("UPDATE virtual_files SET user_path=:new_path, file_name=:file_name where vfile_id=:vfile_id");
	$new_path = $current_dir . $renamed_name;
	$stmt->bindParam(':new_path', $new_path, PDO::PARAM_STR);
	$stmt->bindParam(':file_name', $renamed_name, PDO::PARAM_STR);
	$stmt->bindParam(':vfile_id', $original_id, PDO::PARAM_STR);
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

$original_name = empty($_POST['original_name']) ? '' : $_POST['original_name']; 
$original_id = empty($_POST['original_id']) ? '' : $_POST['original_id'];
$renamed_name = empty($_POST['renamed_name']) ? '' : $_POST['renamed_name'];
$current_dir = empty($_POST['current_dir']) ? '' : $_POST['current_dir'];
  
rename_item($original_name, $original_id, $renamed_name, $current_dir);
?>