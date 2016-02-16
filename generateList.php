<?php include 'verifySession.php' ; ?>
<!DOCTYPE html>
<head>
<title>Create new list</title>
<link href="home.css" rel="stylesheet" type="text/css" >
<link href='https://fonts.googleapis.com/css?family=Roboto:400,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</head>
<?php


?>
<body>
<div id="header"> 
	<h3>List: <?php echo $_POST['name'] ; ?> </h3> 
</div>
<div class="content fadein">
		<div id="form">
    			<?php 
   					 // using the List_ID and Listname we will output all of the list item information 
						$username = $_SESSION['username'] ;
						$listID = $_POST['listID'] ;
						$listName = $_POST['name'] ;

						$query = "SELECT * FROM Items WHERE ListID = '$listID'" ;

						$db = new SQLite3('todo.db') ;

						$results = $db->query($query) ;

						echo '<table>' ;
						while ($row = $results->fetchArray()) {
							echo '<form action="generateList.php" method="post">' ;
							echo '<tr>' ;
					echo '<td> <input type="hidden" name="ItemID" value = '.$row["ItemID"].'> </td>' ;
					echo "<td> <input type='text' name='content' value = '".$row['Content']."''> </td>" ;
					echo '<td> <button type="submit" name="update" value="update">update</button> </td>' ;
					echo '<td> <button type="submit" name="delete" value="delete">delete</button> </td>' ;
							echo '</tr>' ;
							echo '</form>';
						}
						echo '</table>' ;

								

				?>
			
		</div>
</div>

<?php include 'footer.php' ; ?>
</body>
