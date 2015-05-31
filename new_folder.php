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
	$stmt = $dbh->prepare("INSERT INTO folders (user_id, folder_name, contained_in) VALUES (:user_id, :folder_name, :contained_in)");
	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$stmt->bindParam(':folder_name', $folder_name, PDO::PARAM_INT);
	$stmt->bindParam(':contained_in', $home_dir, PDO::PARAM_INT);
	$stmt->execute();	
	
			
	$folder_id = $dbh->lastInsertId();
	$stmt = $dbh->prepare("INSERT INTO permissions (folder_id, user_id, owner_, read_, write_) VALUES (:folder_id, :user_id, 1, 1, 1)");
	$stmt->bindParam(':folder_id', $folder_id, PDO::PARAM_STR);
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