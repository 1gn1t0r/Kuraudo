<?php
include("../config.php");
/*** begin our session ***/
session_start();


if(!isset( $_POST['username'], $_POST['password'], $_POST['form_token']))
{
    $message = 'Please enter a valid username and password';
}

elseif( $_POST['form_token'] != $_SESSION['form_token'])
{
    $message = 'Invalid form submission';
}

elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
{
    $message = 'Incorrect Length for Username';
}

elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4)
{
    $message = 'Incorrect Length for Password';
}

elseif (ctype_alnum($_POST['username']) != true)
{
    /*** if there is no match ***/
    $message = "Username must be alpha numeric";
}

elseif (ctype_alnum($_POST['password']) != true)
{
        /*** if there is no match ***/
    $message = "Password must be alpha numeric";
}
else
{

    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
	$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
	$lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
    

    $password_hash = sha1( $password);
    

    try
    {
        $mysqli = new mysqli($mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname);
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}	
        $stmt = $mysqli->prepare("INSERT INTO users (username, fname, lname, email, password, user_plan ) VALUES (?, ?, ?, ?, ?, 2)");
		$stmt->bind_param('sssss',$username, $fname, $lname, $email, $password_hash);
        $stmt->execute() or die(mysqli_error($db));
		$user_id = $mysqli->insert_id;
		
		$stmt = NULL;
		$stmt = $mysqli->prepare("INSERT INTO folders (user_id, folder_name, contained_in) VALUES (?, 'home', -1)");
		$stmt->bind_param('d',$user_id);
        $stmt->execute() or die(mysqli_error($db));
		$folder_id = $mysqli->insert_id;
		
		$stmt = NULL;
		$stmt = $mysqli->prepare("INSERT INTO PERMISSIONS (folder_id, user_id, owner_, read_, write_) VALUES (?, ?, 1, 1, 1)");
		$stmt->bind_param('dd',$folder_id, $user_id);
        $stmt->execute() or die(mysqli_error($db));
		
		$stmt = NULL;
		$stmt = $mysqli->prepare("UPDATE users SET default_folder=? where user_id =?");
		$stmt->bind_param('dd',$folder_id, $user_id);
        $stmt->execute() or die(mysqli_error($db));		
		
		

        /*** unset the form token session variable ***/
        unset( $_SESSION['form_token'] );

        /*** if all is done, say thanks ***/
        $message = 'New user added';
		
		header("Location: ../index.php");
		die();
    }
    catch(Exception $e)
    {
       //some error
	   $message = "zhat was invalid";
    }
}
echo $message;
?>

