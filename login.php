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
	<body>
		<div id="header" style="height:120px;">
   		<?php include 'header.php' ; ?>
  		</div>
  		<div class="content fadein">
  			<div id="login">
  			<br>
				<form action="#" method="post">
					<input type="text" name="username" placeholder="Username"><br>
					<input type="password" name="password" placeholder="Password"><br>
  		
  					<button class="loginButton" type="submit">Login</button>
				</form>
			</div>
		</div>
		<?php include 'footer.php'; ?>
	</body>
</html>

