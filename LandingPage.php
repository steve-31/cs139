<!DOCTYPE html>
<html>

<head>
	<title>My lists</title>
	<meta charset="UTF-8">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300|Roboto:400,900' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="home.css">
	<!-- Roboto bold and Open sans fonts are now available -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
</head>
	<?php include 'verifySession.php' ; ?>
<body>
	<?php session_start();
	include 'userHeader.php' ;
	include 'database.php'?>

  
  
  <div class="usercontent fadein">
		<h1 class="title"> Welcome <?php echo $_SESSION['username']; ?></h1>
		<div class="left">
			<h2>All Lists</h2>
				<ul class="lists">
					<li>Home</li>
							<ul>
					<?php 
						$db = new SQLite3('todo.db');
						
						$query1 = "SELECT UserID FROM users WHERE Username = '$_SESSION[username]'" ;
                    	$_SESSION['User_ID'] = $db->querySingle($query1) ;
						
						$query2 = "SELECT Name FROM Lists WHERE UserID = '$_SESSION[User_ID]' AND Category = 'Home'" ;
                    	$result = $db->query($query2) ;
                    	
                    	
                    	
                    	while(($row = $result->fetchArray())) {
							echo "<a id='newList' href='generateList.php'><li>".$row['Name']."</li></a>";
						}
					?>
					</ul>
					
					<li>Work</li>
						<ul>				
						<?php
						
						$query2 = "SELECT Name FROM Lists WHERE UserID = '$_SESSION[User_ID]' AND Category = 'Work'" ;
                    	$result = $db->query($query2) ;
                    	
                    	
                    	
                    	while(($row = $result->fetchArray())) {
							echo "<a id='newList' href='generateList.php'><li>".$row['Name']."</li></a>";
						}
						?>
					</ul>
					
					<li>Other</li>
						<ul>				
						<?php
						
						$query2 = "SELECT Name FROM Lists WHERE UserID = '$_SESSION[User_ID]' AND Category = 'Other'" ;
                    	$result = $db->query($query2) ;
                    	
                    	
                    	
                    	while(($row = $result->fetchArray())) {
							echo "<a id='newList' href='generateList.php'><li>".$row['Name']."</li></a>";
						}
						?>
					</ul>
					<br><strong>
					<a id="newList" href="#"><li>+ CREATE NEW LIST</li></strong></a>
					
				</ul> 
	
		</div>
		
		<div class="right">
			<h2>My Recent Lists</h2>

					<?php
						$query5 = "SELECT Name FROM Lists WHERE UserID = '$_SESSION[User_ID]' ORDER BY lastEdit DESC, Name ASC LIMIT 1" ;
                    	$result3 = $db->querySingle($query5) ;
                    	$lasteditquery = "SELECT lastEdit FROM Lists WHERE UserID = '$_SESSION[User_ID]' ORDER BY lastEdit DESC, Name ASC LIMIT 1" ;
                    	$lastedit = $db->querySingle($lasteditquery) ;
                    	
						echo "<strong><a href='generateList.php'><div class='recentused'>".$result3." <span class='lastedit'>Last Edited: ". $lastedit ."</span></div></a></strong>";
						
						$query6 = "SELECT Name FROM Lists WHERE UserID = '$_SESSION[User_ID]' ORDER BY lastEdit DESC, Name ASC LIMIT 1 OFFSET 1" ;
                    	$result4 = $db->querySingle($query6) ;
                    	$lasteditquery = "SELECT lastEdit FROM Lists WHERE UserID = '$_SESSION[User_ID]' ORDER BY lastEdit DESC, Name ASC LIMIT 1 OFFSET 1" ;
                    	$lastedit = $db->querySingle($lasteditquery) ;
                    	
						echo "<strong><a href='generateList.php'><div class='recentused'>".$result4." <span class='lastedit'>Last Edited: ". $lastedit ."</span></div></a></strong>";
						
						$query7 = "SELECT Name FROM Lists WHERE UserID = '$_SESSION[User_ID]' ORDER BY lastEdit DESC, Name ASC LIMIT 1 OFFSET 2" ;
                    	$result5 = $db->querySingle($query7) ;
                    	$lasteditquery = "SELECT lastEdit FROM Lists WHERE UserID = '$_SESSION[User_ID]' ORDER BY lastEdit DESC, Name ASC LIMIT 1 OFFSET 2" ;
                    	$lastedit = $db->querySingle($lasteditquery) ;
                    	
						echo "<strong><a href='generateList.php'><div class='recentused'>".$result5." <span class='lastedit'>Last Edited: ". $lastedit ."</span></div></a></strong>";
					?>
	
		</div>
  </div>
  <?php include 'footer.php' ; ?>
	</body>

</html>
