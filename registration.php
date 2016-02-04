<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Register</title>
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,900' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="home.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script type="text/javascript" src="script.js"></script>
	</head>
  <?php 
      include 'encrypt.php' ;
      include 'db_connect.php' ;
      // validate information 
      $titlerr = $firstNamerr = $surnamerr = $emailerr = $usernamerr = $passworderr = $confirmerr = " ";
      $title = $firstName = $surname = $email = $username = $password = " ";
      // if form is submitted
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //check that fields are not empty first
        //if they are filled strip the field of any special characters
        //that could lead to xss or the hacking of the application
        if (empty($_POST["title"])) {
          $titlerr = "Please select a title" ;
          $valid1 = False ;
        }
        else { $title = test_input($_POST["title"]) ; $valid1 = True ;}
       
        if (empty($_POST["firstname"]) || !preg_match("/^[a-zA-Z-]+$/",$_POST["firstname"])) {
          $firstNamerr = "Please enter a first name" ;
            $valid2 = False ;
        }
        else { $firstName = test_input($_POST["firstname"]) ;   $valid2 = True ; }

        if ( empty($_POST["surname"])||!preg_match("/^[a-zA-Z-]+$/",$_POST["surname"]) ) {
          $surnamerr = "Please enter a surname" ;
          $valid3 = False ;
        }
        else { $surname = test_input($_POST["surname"]) ;   $valid3 = True ;}

        if (empty($_POST["email"])||!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
          $emailerr = "Please enter a valid email address" ;
            $valid4 = False ;
        }
        else { $email = test_input($_POST["email"]) ;   $valid4 = True ;}

        if (empty($_POST["username"])||!preg_match("/^[a-zA-Z-._0-9]+$/",$_POST["username"])) {
          $usernamerr = "Please enter a valid username which can contain letters,numbers and the following special characters: -, ., _" ;
            $valid5 = False ;
        }
        else { $username = $_POST["username"] ;   $valid5 = True ; }
        // password must be atleast 6 characters with atleast one number and one letter
        if (empty($_POST["password"])|| !preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/",$_POST["password"]) ) {
          $passworderr = "Please enter a valid password which is atleast 6 characters and contains one letter and number" ;
          $valid6 = False ;
        }
        else { $password = $_POST["password"] ;   $valid6 = True ; }

            if ($password == $_POST["confirmpassword"]) {
                $valid7 = True ;
            }

            else { $confirmerr = "Please enter the same password in the confirm password field" ;   $valid7 = False ;}


            // if all data entered is valid
            if ($valid1 && $valid2 && $valid3 && $valid4 && $valid5 && $valid6 && $valid7) {
                        // encrypt the password 
                        $hash_value = hash1($password) ;
                        //connect to database
                          try {
                               $conn = new PDO("mysql:host=$servername;dbname=$database", $database_username, $database_password);
                               // set the PDO error mode to exception
                               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                          }
                          catch(PDOException $e){
                               echo "Connection failed: " . $e->getMessage();
                          }
                        //insert data into database
                        $sql = "INSERT INTO users(Title,Firstname,Surname,Username,EmailAddress,Password)  VALUES ('$title','$firstName','$surname','$username','$email','$hash_value')" ;
                        $conn->query($sql);
                        echo "
                             <script>

                              alert('Registration has been successful! Please go to the homepage to login ');

                             </script> " ;
                        $conn = null;
                        echo "<script> window.location.assign('index.php'); </script>";
                        exit;
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
    
       <div id="form">
			<h1 class="title">Register</h1>
			<form action="registration.php" method="post">
			<div class="form">  
  				<span style="color:red;"> <?php echo $titlerr ; ?> <span>
  				<select name="title" >
  					<option value=""></option>
  					<option value="Mr">Mr</option>
  					<option value="Mrs">Mrs</option>
  					<option value="Master">Master</option>
  					<option value="Miss">Miss</option>
  					<option value="Ms">Ms</option>
  					<option value="Dr">Dr</option>
  					<option value="Prof">Prof.</option>
				</select><br>
				<span style="color:red;"> <?php echo $firstNamerr ; ?>  </span>
  				<input type="text" name="firstname" maxlength="20"  placeholder="First Name" >
  				<br>
  				<span style="color:red;"> <?php echo $surnamerr ; ?> <span>
  				<input type="text" name="surname" maxlength="20"  placeholder="Surname">
  				<br>
  				<span style="color:red;"> <?php echo $emailerr ; ?> <span>
  				<input type="email" name="email"  placeholder="email">
  			</div>
  			<div class="form">
  				<span style="color:red;"> <?php echo $usernamerr  ; ?> <span> <br>
				<input type="text" name="username" maxlength="20"  placeholder="Username">
				<span style="color:red;" > <?php echo $passworderr ?> <span> <br> 
				<input type="password" name="password" maxlength="20"  placeholder="Password">
				<span style="color:red;"> <?php echo $confirmerr ; ?> <span> <br>
				<input type="password" name="confirmpassword" maxlength="20"  placeholder="Confirm Password"><br>
			</div>	
         		<br>
         		<div class="form">
         			<input type="checkbox" name="promEmail" checked style="width:30px">I wish to receive promotional emails from MagikList<br>
				<input type="checkbox" name="notifEmail" checked style="width:30px">I wish to receive notification emails from MagikList about my upcoming tasks
			</div>
			<br>
         			
         		
  			<button class="loginButton" type="submit">Register</button>
			</form>
		</div>
	</div>
	<?php include 'footer.php' ; ?> 
	</body>
</html>
