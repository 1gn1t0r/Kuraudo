<?php

include("../config.php");


//$test_dir = "/home/test2";
//$search_dir = "/home";

//echo get_base_path(2);
//return;
//echo basename($search_dir . "/");

//function get_base_dir($test_dir, $search_dir)
//{
//	$residu = substr($test_dir,strlen($search_dir)+1);
//	$base_dir = explode("/",$residu)[0];
//	return $base_dir;
//}

//return;

session_start();
if(isset( $_SESSION['user_id'] ))
{
    
}
else
{
	return;
}


if (isset( $_GET['directory']))
{
}
else
{
	return;
}

 error_log("directory is " . $_GET['directory'], 0);

//echo basename(dirname("/home/test2"));
//return "home"
function is_in_dir($file_path, $dir)
{
	return basename(dirname($file_path)) == basename($dir);
}

function get_base_dir($test_dir, $search_dir)
{
	$residu = substr($test_dir,strlen($search_dir)+1);
	$base_dir = explode("/",$residu)[0];
	return $base_dir;
}

function get_base_path($folder_id)
{
	global $mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname;
	
	$mysqli = new mysqli($mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname);

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$contained_in = $folder_id;
	global $base_folder_path;
	$base_folder_path = "";
	
	
	while($contained_in != -1)
	{		
		$stmt = NULL;
		$stmt = $mysqli->prepare("SELECT folder_name, contained_in from folders
					WHERE folder_id = ?
					ORDER BY folder_name");
		$stmt->bind_param('d' , $contained_in);
		$stmt->execute();
		$stmt->bind_result($folder_name, $contained_in);
		$stmt->fetch();
	
		if($base_folder_path == "")
			$base_folder_path = $folder_name;
		else
			$base_folder_path  = $folder_name . "/" . $base_folder_path;
	}
	
	return $base_folder_path;
}



function scan2($base_folder_id)
{
	global $mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname;
	$username = $_SESSION['username'];
	$user_id = $_SESSION['user_id'];
	
	$mysqli = new mysqli($mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname);

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}


    $stmt = $mysqli->prepare("SELECT folder_id, folder_name from folders
					WHERE contained_in = ?
					ORDER BY folder_name");

	$stmt->bind_param('d', $base_folder_id);

	$files = array();
	$stmt->execute();
	$stmt->bind_result($folder_id, $folder_name);
			
    while ($stmt->fetch()) {

		$files[] = array(
					"name" => $folder_name,
					"type" => "folder",
					"path" => get_base_path($base_folder_id) . "/" . $folder_name,
					"folder_id" => $folder_id,
					"items" => array()
				);
		
	}
	$stmt = NULL;
	$stmt = $mysqli->prepare("SELECT vfile_id, pfile_id, file_name, file_size, last_modified FROM virtual_files, logical_files
					WHERE folder_id = ?
					AND pfile_id = file_id
					ORDER BY file_name");

	$stmt->bind_param('d', $base_folder_id);

	$stmt->execute();
	$stmt->bind_result($vfile_id, $pfile_id, $file_name, $file_size, $last_modified);
			
    while ($stmt->fetch()) {

		$files[] = array(
						"name" => $file_name,
						"type" => "file",
						"path" => get_base_path($base_folder_id) . "/" . $file_name,
						"size" => $file_size,
						"modified" => $last_modified,
						"folder_id" => $base_folder_id,
						"vfile_id" => $vfile_id
					);
		
	}

	return $files;
}





////////////////////////

$dir = $_GET['directory'];

// Run the recursive function 
$response = scan2($dir);

// Output the directory listing as JSON
header('Content-type: application/json');

echo json_encode(array(
	"name" => "files",
	"type" => "folder",
	"path" => $dir,
	"items" => $response
));
