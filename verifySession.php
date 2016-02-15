<?php
	$user = $_SESSION[username];
	echo $user;
  if($user != NULL) {
  } else {
    //header('Location:index.php');
  }
?>
