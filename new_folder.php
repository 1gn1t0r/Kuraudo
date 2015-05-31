<?php


function save_folder($folder_name, $home_dir) {
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
	$stmt = $dbh->prepare("INSERT INTO virtual_files (pfile_id, user_id, user_path, file_type) VALUES (:pfile_id, :user_id, :user_path, :file_type )");
	$stmt->bindParam(':pfile_id', $file_id, PDO::PARAM_STR);
	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	$stmt->bindParam(':user_path', $user_path, PDO::PARAM_STR);
	$stmt->bindParam(':file_type', $file_type, PDO::PARAM_STR);
	$stmt->execute();
	
	
	
	$stmt = $dbh->prepare("SELECT vfile_id from virtual_files WHERE pfile_id = :pfile_id AND user_id = :user_id AND user_path = :user_path");
	$stmt->bindParam(':pfile_id', $file_id, PDO::PARAM_STR);
	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	$stmt->bindParam(':user_path', $user_path, PDO::PARAM_STR);
	$stmt->execute();
	$vfile_id = $stmt->fetchColumn();
			
	
	$stmt = $dbh->prepare("INSERT INTO permissions (vfile_id, user_id, owner_, read_, write_) VALUES (:vfile_id, :user_id, 1, 1, 1)");
	$stmt->bindParam(':vfile_id', $vfile_id, PDO::PARAM_STR);
	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
		
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

$folder_name = empty($_POST['foldername']) ? '' : $_POST['foldername'];
 
$current_dir = empty($_POST['curdir']) ? '' : $_POST['curdir'];
 
// file paths to store
$paths= [];
 
save_folder($folder_name, $current_dir);
?>