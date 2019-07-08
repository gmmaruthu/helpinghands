<?php 
session_start();
if(isset($_SESSION["user_type"])) {
require('php/DB.php');
	// delete comment fromd database
	if (isset($_GET['book_id'])) {
		$id = $_GET['book_id'];
		$sql = "DELETE FROM `books` WHERE book_id=" . $id;
		mysqli_query($conn, $sql);
		$_SESSION['delete_message'] = 'Success';
		header("Location:addbooks.php");
		exit;
	}
}
?>