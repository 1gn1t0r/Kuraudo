<?php


function save_data($userid, $uname, $filepath, $original_name, $home_dir, $file_size, $file_hash) {
    $username = $_SESSION['username'];
	$user_id = $_SESSION['user_id'];
	
	$mysql_hostname = 'localhost';
    $mysql_username = 'root';
    $mysql_password = '';
    $mysql_dbname = 'kuraudo';
	
	$filename = basename($filepath);
	$file_type = 0;//file
	
	$sha1file = $file_hash;
	
	$did_exist = 0;	

	$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);

	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$stmt = $dbh->prepare("SELECT file_id from logical_files WHERE file_hash = :file_hash AND original_file_name = :original_file_name");
	$stmt->bindParam(':file_hash', $sha1file, PDO::PARAM_STR);
	$stmt->bindParam(':original_file_name', $original_name, PDO::PARAM_STR);
	$stmt->execute();
	$file_id = $stmt->fetchColumn();
	if($file_id == false)
	{
			#Only insert a new physical file if it is unique
		   $stmt = $dbh->prepare("INSERT INTO logical_files (original_file_name, original_uploader_id, file_hash, file_path, file_size, file_type, last_modified) VALUES (:original_file_name, :original_upload_id, :file_hash, :file_path, :file_size, :file_type, NOW() )");

			$stmt->bindParam(':original_file_name', $original_name, PDO::PARAM_STR);
			$stmt->bindParam(':original_upload_id', $user_id, PDO::PARAM_STR);
			$stmt->bindParam(':file_hash', $sha1file, PDO::PARAM_STR);
			$stmt->bindParam(':file_path', $filepath, PDO::PARAM_STR);
			$stmt->bindParam(':file_size', $file_size, PDO::PARAM_STR);
			$stmt->bindParam(':file_type', $filepath, PDO::PARAM_STR);
			
		
			$stmt->execute();
	}
	else
	{
		$did_exist = 1;
	}

		$stmt = $dbh->prepare("SELECT file_id from logical_files WHERE file_hash = :file_hash AND original_file_name = :original_file_name");
        $stmt->bindParam(':file_hash', $sha1file, PDO::PARAM_STR);
        $stmt->bindParam(':original_file_name', $original_name, PDO::PARAM_STR);
        $stmt->execute();
        $file_id = $stmt->fetchColumn();
			
		

		$user_path = $home_dir . $original_name;
		//Check if virtual file exists
		$stmt = $dbh->prepare("SELECT vfile_id from virtual_files WHERE pfile_id = :pfile_id AND user_id = :user_id AND user_path = :user_path");
		$stmt->bindParam(':pfile_id', $file_id, PDO::PARAM_STR);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
		$stmt->bindParam(':user_path', $user_path, PDO::PARAM_STR);
		$stmt->execute();
		$vfile_id = $stmt->fetchColumn();
		
		if($vfile_id == false)
		{
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
		else
		{
			$did_exist = 2;
		}
		
		
		return $did_exist;
}




session_start();
if(isset( $_SESSION['user_id'] ))
{
    
}
else
{
	return;
}
// upload.php
// 'images' refers to your file input name attribute
if (empty($_FILES['images'])) {
    echo json_encode(['error'=>'No files found for upload.']); 
    // or you can throw an exception 
    return; // terminate
}
 
// get the files posted
$images = $_FILES['images'];
 
// get user id posted
$userid = empty($_POST['userid']) ? '' : $_POST['userid'];
 
// get user name posted
$username = empty($_POST['username']) ? '' : $_POST['username'];

$current_dir = empty($_POST['curdir']) ? '' : $_POST['curdir'];
 
// a flag to see if everything is ok
$success = null;
 
// file paths to store
$paths= [];
 
// get file names
$filenames = $images['name'];
 
// loop and process files
for($i=0; $i < count($filenames); $i++){
    $ext = explode('.', basename($filenames[$i]));
    $target = "uploads" . DIRECTORY_SEPARATOR . strval($userid) . md5(uniqid()) . "." . array_pop($ext);
	$file_size = filesize($images['tmp_name'][$i]);
	$file_hash = sha1_file($images['tmp_name'][$i]);
	$did_exist = save_data($userid, $username, $target, $filenames[$i], $current_dir, $file_size, $file_hash);
	
	if ($did_exist == 0)
	{
		if(move_uploaded_file($images['tmp_name'][$i], $target)) 
		{
			$success = true;
			$paths[] = $target;
		} else {
			$success = true;
			break;
		}
	}
	else if ($did_exist == 1)
	{
		$sucess = true;
	}
	else
	{
		$success = false;
		break;
	}
    
}
$output = [];
if($did_exist < 2)
{
	//$output = ['error'=> 'did exist:' . strval($did_exist)];
	//Sucessfully uploaded
}
else
{
	$output = ['error'=>  strval($did_exist) . ': File already exists:'];
}

// return a json encoded response for plugin to process successfully
echo json_encode($output);
?>