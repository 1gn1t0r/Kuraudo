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
	
		
		$stmt = NULL;
		$stmt = $mysqli->prepare("SELECT folder_name, contained_in from folders
					WHERE folder_id = ?
					ORDER BY folder_name");
		$stmt->bind_param('d' , $contained_in);
		$stmt->execute();
		$stmt->bind_result($folder_name, $contained_in);
		$stmt->fetch();
		
	return $folder_name;
}



$dir_id = empty($_POST['dir_id']) ? '' : $_POST['dir_id']; 
  
echo get_base_path($dir_id);
