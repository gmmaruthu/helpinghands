<?php
error_reporting(0);
require('DB.php');

  if(isset($_POST["book_title"])){
	$created_date = date('Y-m-d H:i:s');
   $sql = "INSERT INTO `books` (`book_title`, `book_author`, `book_description`, `created_date`, `created_user`) VALUES ('".$_POST["book_title"]."', '".$_POST["book_author"]."', '".$_POST["book_description"]."', '".$created_date."', '".$_SESSION['user_id']."')";
    if ($conn->query($sql) === TRUE) {
		header("Location:".$_SERVER['HTTP_REFERER']);
		$_SESSION['message'] = 'Success';
	}
  }

?>
