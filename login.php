<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>MagikList | Login</title>
		<link rel="stylesheet" type="text/css" href="home.css">
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,900' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script type="text/javascript" src="script.js"></script>
	</head>
		<?php
		session_start();
		include 'encrypt.php';
		include 'database.php';
		$error = "";
		//if a user submits the form 
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
					//validate information
					$username = test_input($_POST['username']) ;
					$password = test_input($_POST['password']) ;
					//hash password
					$hash = hash1($password) ;
					//query to fetch password from db
					$query = "SELECT Password FROM users WHERE Username = '$username'" ;
					//connect to database
                    $db = new SQLite3('todo.db');
                    //run query
                    $db_password = $db->querySingle($query) ;
                    //check passwords match
                    		if ($hash == $db_password) {
                    			$_SESSION['username'] = $username ;
                    			echo "<script> window.location.assign('LandingPage.php'); </script>";
                    		}
                    	    else{

                    	    	$error="Username or Password Incorrect. Please Try Again." ;
                    	    }
                    	    
                } 
            function test_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }
	?>
	<body>
		<div id="header" style="height:120px;">
   		<?php include 'header.php' ; ?>
  		</div>
  		<div class="content fadein">
  			<div id="login">
  			<br>
				<form action="login.php" method="post">
					<input type="text" name="username" placeholder="Username"><span style="color:red;"> <?php echo $error ; ?></span></span><br>
					<input type="password" name="password" placeholder="Password"><br>
  		
  					<button class="loginButton" type="submit">Login</button>
				</form>
			</div>
		</div>
		<?php include 'footer.php'; ?>
	</body>
</html>

