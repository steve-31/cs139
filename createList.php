<?php session_start() ; ?>
<!DOCTYPE html>
<head>
<title>Create new list</title>
<link href="home.css" rel="stylesheet" type="text/css" >
<link href='https://fonts.googleapis.com/css?family=Roboto:400,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
1<script type="text/javascript" src="script.js"></script>
</head>
<?php
	include 'database.php' ;	

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$name = test_input($_POST['listName']) ;
		$category = test_input($_POST['category']) ;
		$last_edit = date('Y-m-d H:i:s') ; //returns current time and date
		$findID = "SELECT UserID FROM users WHERE Username = '$_SESSION[username]' " ;
		echo $_SESSION['username'] ;
		$db = new SQLite3('todo.db') ;
	    $id = $db->querySingle($findID) ;
	    $query="INSERT INTO Lists(UserID,Name,LastEdit,Category) VALUES('$id','$name','$last_edit','$category')" ;
		$db->exec($query) ;
	}

	function test_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }

?>
<body>
<div id="header"> 
	<h3>Create a new list c</h3> 

</div>
<div class="content fadein">
		<div id="form">
			<form action="createList.php" method="post">
    			<p> Name <input type="text" name="listName"> </p>
      			<p> Category 
      				<select name="category">
      					<option value="Home">Home</option>
      					<option value="Work">Work</option>
      					<option value="Other">Other</option>
      				</select>
      			</p>
      			<button class="loginButton" type="submit">Create</button>
			</form>	
		</div>
</div>

<?php include 'footer.php' ; ?>
</body>
