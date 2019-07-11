<?php
session_start();
if(isset($_SESSION["user_type"])) {
	require('php/DB.php');

	/* Get book by book id */
	if(!empty($_GET['book_id'])){
		$get_book_sql = "SELECT * FROM `books` where `book_id` = ".$_GET['book_id'];
	    $get_book_res = mysqli_query($conn, $get_book_sql);
	    $get_book = mysqli_fetch_array($get_book_res);
	}


	if(isset($_POST["book_title"])){
	   $update_book = "UPDATE `books` SET `book_title` = '".$_POST['book_title']."', `book_author` = '".$_POST['book_author']."', `book_description` = '".$_POST['book_description']."', `category` = '".$_POST['book_category']."' WHERE `book_id` =  '".$_GET['book_id']."'";
	    if ($conn->query($update_book) === TRUE) {
			$_SESSION['update_message'] = 'Success';
			header("Location:addbooks.php");
			exit;
		}
	}
?>
<!doctype html>
<html lang="en">
	<head>
		<?php include 'header.php';?>

		<title>Update book</title>
	</head>
	<body>
		<?php 
		include 'navbar.php';
		?>
		<main role="main" class="container">

			<!-- Page Heading -->
			<div class="row conent-header">
				<div class="col-lg-12">
					<h1 class="page-header">Update Book</h1>
				</div>
			</div>
			<!-- Signup Form -->
			<div class="row">
				<div class="col-md-8">
					<form id="addbookForm" action="" method="post" enctype="multipart/form-data" novalidate>
						<div class="control-group form-group">
							<div class="controls">
								<label class="control-label">Book Name</label>
								<input type="text" class="form-control" name="book_title" id="book_title" required maxlength="255" value="<?php echo $get_book['book_title']; ?>">
								<p class="book_title"></p>
							</div>
						</div>
						<div class="control-group form-group">
							<div class="controls">
								<label class="control-label">Book Author</label>
								<input type="text" class="form-control" name="book_author" id="book_author" placeholder="Separate multiple authors like Author1,Author2,Author3" required maxlength="255" value="<?php echo $get_book['book_author']; ?>">
								<p class="book_author"></p>
							</div>
						</div>
						<div class="control-group form-group">
							<div class="controls">
								<label class="control-label">Category</label>
								<select class="form-control" name="book_category" id="book_category" required>
								<?php $get_categories_sql = "SELECT * FROM `category` where `status` = 0";
										$get_categories = mysqli_query($conn, $get_categories_sql);
										if(count($get_categories) > 0){
											while ($category = mysqli_fetch_array($get_categories)) { ?>
												<option value="<?php echo $category['id']; ?>" <?php if($get_book['category'] == $category['id']) echo "selected"; ?>><?php echo $category['name']; ?></option>
											<?php }
										}else{
											echo '<option value="">No Category Found</option>';
										}
								?>									
								</select>
								<p class="book_category"></p>
							</div>
						</div>
						<div class="control-group form-group">
							<div class="controls">
								<label>Book Description</label>
								<textarea class="form-control" rows="6" name="book_description" id="book_description"  required maxlength="255"><?php echo $get_book['book_description']; ?></textarea>
								<p class="help-block"></p>
							</div>
						</div>
						
						<br>
						<button type="submit" class="btn btn-success" name="submit" id="submit" value="submit">Update Book</button>
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