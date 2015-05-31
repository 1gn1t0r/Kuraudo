<?php


function share_with($original_id, $email, $write) {
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

	$stmt = $dbh->prepare("SELECT user_id from users WHERE email=:email");
	$stmt->bindParam(':email', $email, PDO::PARAM_STR);
	$stmt->execute();
	$user_id_share = $stmt->fetchColumn();
	$owner = 0;
	if($user_id == $user_id_share)
		$owner = 1;
	$read = 1;
		
	$stmt = $dbh->prepare("INSERT into PERMISSIONS(vfile_id, user_id, owner_, read_, write_) values(:vfile_id, :user_id, :owner_, :read_, :write_)");
	$stmt->bindParam(':vfile_id', $original_id, PDO::PARAM_INT);
	$stmt->bindParam(':user_id', $user_id_share, PDO::PARAM_INT);
	$stmt->bindParam(':owner_', $owner, PDO::PARAM_INT);
	$stmt->bindParam(':read_', $read, PDO::PARAM_INT);
	$stmt->bindParam(':write_', $write, PDO::PARAM_INT);
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

$email = empty($_POST['email']) ? '' : $_POST['email']; 
$original_id = empty($_POST['original_id']) ? '' : $_POST['original_id'];
$write = empty($_POST['write']) ? '' : $_POST['write'];
if($write == 'false')
	$write = 0;
else
	$write = 1;
  
share_with($original_id, $email, $write);
?>