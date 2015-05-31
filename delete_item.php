<?php


function delete_item($item_id) {
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
		
	$stmt = $dbh->prepare("DELETE from virtual_files WHERE vfile_id=:vfile_id");
	$stmt->bindParam(':vfile_id', $item_id, PDO::PARAM_INT);
	$stmt->execute();
	
	$stmt = NULL;
	$stmt = $dbh->prepare("SELECT owner_ from permissions WHERE vfile_id = :vfile_id AND user_id= :user_id");
	$stmt->bindParam(':vfile_id', $item_id, PDO::PARAM_INT);
	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$stmt->execute();
	$owner_ = $stmt->fetchColumn();

	if($owner_ == 1)
	{
		$stmt = NULL;
		$stmt = $dbh->prepare("DELETE from permissions WHERE vfile_id = :vfile_id");
		$stmt->bindParam(':vfile_id', $item_id, PDO::PARAM_INT);
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
  
delete_item($item_id);
?>