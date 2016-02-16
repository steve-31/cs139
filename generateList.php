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
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// if update was clicked
		if (isset($_POST['update'])) {
				$content = $_POST['content'] ;
				$itemID = $_POST['ItemID'] ;
				$date = $_POST['dueDate'] ;
				$db = new SQLite3('todo.db') ;
				$update = "UPDATE items SET Content = '$content',DueDate = '$date' WHERE ItemID = '$itemID' " ;
				$db->exec($update) ;
				echo "<script> window.location.assign('LandingPage.php'); </script>";
		}
		// if delete was clicked
		if (isset($_POST['done'])) {
				$content = $_POST['content'] ;
				$itemID = $_POST['ItemID'] ;
				$db = new SQLite3('todo.db') ;
				$delete = "DELETE FROM Items WHERE ItemID = '$itemID' " ;
				$db->exec($delete) ;
				echo "<script> window.location.assign('LandingPage.php'); </script>";
		}
		// if add was clicked 
		if (isset($_POST['add'])) {
				$content = $_POST['newItem'] ;
				$listID = $_POST['listID1'] ;
				$date = $_POST['date'] ;
				$db = new SQLite3('todo.db') ;
				$new = "INSERT INTO Items  VALUES(null,'$listID','$content',0,'$date') " ;
				$db->exec($new) ;
				echo "<script> window.location.assign('LandingPage.php'); </script>";
		}


		
	}
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
					echo "<td> <input type='text' name='dueDate' value = '".$row['DueDate']."''> </td>" ;
					echo '<td> <button type="submit" name="update" value="update">update</button> </td>' ;
					echo '<td> <button type="submit" name="done" value="done">done</button> </td>' ;
							echo '</tr>' ;
							echo '</form>';
						}
							echo '<form action="generateList.php" method="post">' ;
							echo '<tr>' ;
					echo '<td> <input type="hidden" name="listID1" value = "'.$listID.'""> </td>' ;
					echo '<td> <input type="text" name="newItem" placeholder = "Add a new item" > </td>' ;
					echo '<td> <input type="date" name="date"> </td>' ;
					echo '<td> <button type="submit" name="add" value="add">add</button> </td>' ;
							echo '</tr>' ;
							echo '</form>';

						echo '</table>' ;

								

				?>
			
		</div>
</div>

<?php include 'footer.php' ; ?>
</body>
