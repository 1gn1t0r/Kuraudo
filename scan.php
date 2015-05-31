<?php

include("config.php");


//$test_dir = "/home/images/prent.jpg";
//$search_dir = "/home";

//echo get_base_dir($test_dir, $search_dir) . "<br>";
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


function is_same_dir($file_path, $dir)
{
	return basename(dirname($file_path)) == basename($dir);
}

function get_base_dir($test_dir, $search_dir)
{
	$residu = substr($test_dir,strlen($search_dir)+1);
	$base_dir = explode("/",$residu)[0];
	return $base_dir;
}


function scan2($dir)
{
	global $mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname;
	$username = $_SESSION['username'];
	$user_id = $_SESSION['user_id'];
	
	$mysqli = new mysqli($mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname);

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	

    $stmt = $mysqli->prepare("SELECT user_path, original_file_name, file_size, file_path, pfile_id, virtual_files.file_type, last_modified, virtual_files.vfile_id
					FROM logical_files, virtual_files 
					WHERE (logical_files.file_id = virtual_files.pfile_id OR virtual_files.pfile_id = -1)
                    AND virtual_files.user_id = ?
					AND (user_path LIKE BINARY ?)
					ORDER BY user_path");
	$dir_b = $dir . "/%";
	$stmt->bind_param('ds', $user_id, $dir_b);

	$files = array();
	$stmt->execute();
	$stmt->bind_result($vpath, $file_name, $file_size, $physical_path, $pfile_id, $virtual_file_type, $last_modified, $vfile_id);
	
	$dirs = array();
	
    while ($stmt->fetch()) {
		// printf ("%s %s, %s\n", $vpath, $file_name, $physical_path);

		if($vpath == $dir || $vpath == $dir . "/")
		{
		}
		else
		if ($virtual_file_type == 1)
		{
			$dirs[] = basename($vpath);
		}
		else if(is_same_dir($vpath, $dir))
		{		
			//echo basename($vpath) . "<br>";
			// error_log(basename($vpath), 0);
			
			$files[] = array(
						"name" => basename($vpath),
						"type" => "file",
						"path" => $physical_path,
						"size" => $file_size,
						"modified" => $last_modified,
						"vfile_id" => $vfile_id
					);
		}
		else
		{
			$dirs[] = get_base_dir($vpath, $dir);
		}
    }
	
	$udirs = array_unique($dirs);
	foreach($udirs as $d)
	{
		//echo $d . "<br>";
		//error_log($d, 0);
		$files[] = array(
						"name" => basename($d),
						"type" => "folder",
						"path" => $dir . "/" . $d,
						"items" => array()
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
