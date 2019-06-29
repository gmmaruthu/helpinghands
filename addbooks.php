<?php
session_start();
if(isset($_SESSION["user_type"])) {
	require('php/DB.php');

  if(isset($_POST["book_title"])){
	$created_date = date('Y-m-d H:i:s');
   $sql = "INSERT INTO `books` (`book_title`, `book_author`, `book_description`, `created_date`, `created_user`) VALUES ('".$_POST["book_title"]."', '".$_POST["book_author"]."', '".$_POST["book_description"]."', '".$created_date."', '".$_SESSION['user_id']."')";
    if ($conn->query($sql) === TRUE) {
		$_SESSION['message'] = 'Success';
		header("Location:addbooks.php");
		exit;
	}
  }
?>
<!doctype html>
<html lang="en">
	<head>
		<?php include 'header.php';?>

		<title>Add new books</title>
	</head>
	<body>
		<?php 
		include 'navbar.php';
		?>
		<main role="main" class="container">

			<!-- Page Heading -->
			<div class="row conent-header">
				<div class="col-lg-12">
					<h1 class="page-header">Add Books</h1>
				</div>
			</div>

			<div class="row">
				<div class="col-md-8">
					<p>Add new books use following details.</p>
				</div>
			</div>

			<br>
				<?php if(isset($_SESSION["message"])){
					echo '<div class="alert alert-success">
					  <strong>Success!</strong> Your book successfully added.
					</div>';
					unset($_SESSION["message"]);
				} ?>
			<!-- Signup Form -->
			<div class="row">
				<div class="col-md-8">
					<form id="addbookForm" action="" method="post" enctype="multipart/form-data" novalidate>
						<div class="control-group form-group">
							<div class="controls">
								<label class="control-label">Book Name</label>
								<input type="text" class="form-control" name="book_title" id="book_title" required maxlength="255">
								<p class="book_title"></p>
							</div>
						</div>
						<div class="control-group form-group">
							<div class="controls">
								<label class="control-label">Book Author</label>
								<input type="text" class="form-control" name="book_author" id="book_author" placeholder="Separate multiple authors like Author1,Author2,Author3" required maxlength="255">
								<p class="book_author"></p>
							</div>
						</div>
						<div class="control-group form-group">
							<div class="controls">
								<label>Book Description</label>
								<textarea class="form-control" rows="6" name="book_description" id="book_description"  required maxlength="255"></textarea>
								<p class="help-block"></p>
							</div>
						</div>
						
						<br>
						<button type="submit" class="btn btn-success" name="submit" id="submit" value="submit">Add Book</button>
					</form>
				 </div>
			</div>
		</main>
	  <div>
	    <p class="spacer"></p>
	  </div>

		<?php include 'footer.php';?>
		<script src="js/chosen.jquery.js" type="text/javascript"></script>
	</body>
</html>
<?php
	}else{
		header("Location:login.php");
	}
?>