
<?php

include("config.php");

session_start();

if(isset( $_SESSION['user_id'] ))
{
    $message = 'User is already logged in';
}
if(!isset( $_POST['username'], $_POST['password']))
{
    $message = 'Please enter a valid username and password';
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

    $password_hash = sha1( $password );
    
		$mysqli = new mysqli($mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname);

		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}	

        $stmt = $mysqli->prepare("SELECT user_id, username, password, default_folder FROM users 
                    WHERE username = ? AND password = ?");
		
		$stmt->bind_param('ss', $username, $password_hash);

        $stmt->execute();

		$stmt->bind_result($user_id, $username2, $password, $default_folder);
		$stmt->fetch();
        if($user_id == false)
        {
            $message = 'Login Failed';
        }        
        else
        {
                /*** set the session user_id variable ***/
                $_SESSION['user_id'] = $user_id;
				$_SESSION['username'] = $username;
				$_SESSION['home_dir'] = $default_folder;

                /*** tell the user we are logged in ***/
                $message = 'You are now logged in';
				
				$stmt = NULL;
				$stmt = $mysqli->prepare("INSERT INTO logins(user_id, date)	VALUES(?, NOW())");
				$stmt->bind_param('d', $user_id);
				$stmt->execute();
				
				header("Location: browse.php");
				exit();
				die();
        }
}
?>
