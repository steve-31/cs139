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
		include 'encrypt.php'
		include 'db_connect.php'
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
                          try {
                               $conn = new PDO("mysql:host=$servername;dbname=$database", $database_username, $database_password);
                               // set the PDO error mode to exception
                               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                          }
                          catch(PDOException $e){
                               echo "Connection failed: " . $e->getMessage();
                          }
                    //run query
                    $db_password = $conn->query($query) ;
                    //check passwords match
                    		if ($hash==$db_password) {
                    			session_start() ;
                    			$session_['username'] = $username ;
                    			header(Location: 'LandingPage.php') ;
                    		}
                    	    else{
                    	    	$error="Username or password is incorrect, please try again" ;
                    	    }




            function test_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }





			}



	?>
	<body>
		<div id="header" style="height:120px;">
   		<?php include 'header.php' ; ?>
  		</div>
  		<div class="content fadein">
  			<div id="login">
  			<br>
				<form action="#" method="post">
					<input type="text" name="username" placeholder="Username"><span style="color:red;"> <?php echo $error ; ?></span></span><br>
					<input type="password" name="password" placeholder="Password"><br>
  		
  					<button class="loginButton" type="submit">Login</button>
				</form>
			</div>
		</div>
		<?php include 'footer.php'; ?>
	</body>
</html>

