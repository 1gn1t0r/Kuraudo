<?php

include("config.php");


function force_download($filename, $basename) 
{
    $filedata = @file_get_contents($filename);

    // SUCCESS
    if ($filedata)
    {
        // THESE HEADERS ARE USED ON ALL BROWSERS
        header("Content-Type: application-x/force-download");
        header("Content-Disposition: attachment; filename=$basename");
        header("Content-length: " . (string)(strlen($filedata)));
        header("Expires: ".gmdate("D, d M Y H:i:s", mktime(date("H")+2, date("i"), date("s"), date("m"), date("d"), date("Y")))." GMT");
        header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
        header("Pragma: no-cache");
		ob_clean(); 

        flush();

        // CAPTURE THE FILE IN THE OUTPUT BUFFERS - WILL BE FLUSHED AT SCRIPT END
        ob_start();
        echo $filedata;
    }

    // FAILURE
    else
    {
        die("ERROR: UNABLE TO OPEN $filename");
    }
}

session_start();
	

if (isset( $_GET['file']))
{
}
else
{
	return;
}
		
	global $mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname;
	$vfile_id =  $_GET['file'];
	
	$mysqli = new mysqli($mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname);

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}	
	


    $stmt = $mysqli->prepare("SELECT public 
					FROM public_files
					WHERE vfile_id = ?");
					
	$stmt->bind_param('i', $vfile_id);
	$stmt->execute();
	$stmt->bind_result($public_);
	$stmt->fetch();
    if($public_ != 1)
	{
		if(isset( $_SESSION['user_id'] ))
		{
			
		}
		else
		{
			echo "Insufficient permissions<br>";
			return;
		}
		$username = $_SESSION['username'];
		$user_id = $_SESSION['user_id'];

		$stmt = $mysqli->prepare("SELECT owner_, read_, write_ 
						FROM permissions
						WHERE user_id = ?
						AND vfile_id = ?");
						
		$stmt->bind_param('ii', $user_id, $vfile_id);
		$stmt->execute();
		$stmt->bind_result($owner_, $read_, $write_);
		$stmt->fetch();
		if($read_ != 1)
		{
			echo "Insufficient permissions<br>";
			return;
		}
	}	
		
	$stmt = NULL;
	$stmt = $mysqli->prepare("SELECT pfile_id, file_type, user_path
					FROM virtual_files
					WHERE vfile_id = ?");
	$stmt->bind_param('i', $vfile_id);
	$stmt->execute();
	$stmt->bind_result($pfile_id, $file_type, $user_path);
	$stmt->fetch();

	$stmt = NULL;
	$stmt = $mysqli->prepare("SELECT original_file_name, file_path
					FROM logical_files
					WHERE file_id = ?");
	$stmt->bind_param('d', $pfile_id);
	$stmt->execute();
	$stmt->bind_result($original_file_name, $file_path);
	$stmt->fetch();
	
	force_download($file_path, basename($user_path));
	
	
	
	
	
	
	


?>