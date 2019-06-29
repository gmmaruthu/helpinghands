<?php  require('php/DB.php'); 
$res2 = '';
session_start();
if(isset($_SESSION["user_type"])) {
	
if(isset($_POST['searchbooks'])){
		$bookid = $_POST['searchbooks'];
		$sql0 = "SELECT * FROM `books` where book_id = '".$bookid."'";
		$result0 = mysqli_query($conn,$sql0);
		$res2 = mysqli_fetch_array($result0);
}	
if(isset($_POST['requestcomment'])){
		$requestcomment = $_POST['requestcomment'];
		$requestbookid = $_POST['requestbookid'];
		$date = date('Y-m-d H:i:s');
		$sql1 = "INSERT INTO `book_request`(`book_id`, `user_id`, `request_description`, `book_status`,`created_date` ) VALUES ('".$requestbookid."', '".$_SESSION['user_id']."', '".$requestcomment."', 0, '".$date."')";
		if ($conn->query($sql1) === TRUE) {
			$_SESSION['message'] = 'Success';
			
			header("Location:searchbooks.php");
			exit;
		}
}	


$sql = "SELECT B.* FROM `books` B where B.created_user not in ('".$_SESSION['user_id']."') and B.book_id not in (select book_id from book_request where book_status != 2)";
$result = mysqli_query($conn,$sql);
?>
<!doctype html>
<html lang="en">
	<head>
		<?php include 'header.php';?>
		<link rel="stylesheet" href="css/chosen.css">
		<title>Search Books</title>
	</head>
	<body>
		<?php 
		include 'navbar.php';
		?>
		<main role="main" class="container">

			<!-- Page Heading -->
			<div class="row conent-header">
				<div class="col-lg-12">
					<h1 class="page-header">Search Books</h1>
				</div>
			</div>

			<div class="row">
				<div class="col-md-8">
					<p>Search your books use following details.</p>
				</div>
			</div>

			<br>
				<?php if(isset($_SESSION["message"])){
					echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong>Success!</strong> Your book request has been sent.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>';
					unset($_SESSION["message"]);
				} ?>
			<!-- Signup Form -->
			<div class="row">
				<div class="col-md-8">
					<form name="searchbookForm" id="searchbookForm" action="" method="post" enctype="multipart/form-data" novalidate>
						<div class="control-group form-group">
							<div class="controls">
								<label class="control-label">Search Books</label>
								<select name="searchbooks" class="chosen-select form-control" id="searchbooks" required>
									<option></option>
									<?php 
									while($res = mysqli_fetch_array($result)){
										if($_POST['searchbooks'] == $res['book_id']){
											echo '<option value="'.$res['book_id'].'" selected>'.$res['book_title'].' - '.$res['book_author'].'</option>';
										}else{
											echo '<option value="'.$res['book_id'].'">'.$res['book_title'].' - '.$res['book_author'].'</option>';
										}
									}?>
								  </select>
								<p class="searchbooks"></p>
							</div>
						</div>
						
						
						<br>
						<button type="submit" class="btn btn-success" name="submit" id="submit" value="submit">Search</button>
					</form>
				 </div>
			</div>
		</main>
		<br>
	  <main role="main" class="container">
			<?php
				if($res2 != ''){
					echo '<table class="table border">
						<thead>
						  <tr>
							<th>Book Name</th>
							<th>Book Author</th>
							<th>Book Description</th>
							<th>Action</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td>'.$res2['book_title'].'</td>
							<td>'.$res2['book_author'].'</td>
							<td>'.$res2['book_description'].'</td>
							<td><a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal" >Make Request</a></td>
						  </tr>
						  
						</tbody>
					  </table>';
						
				}
			?>
	  </main>
		<!-- The Modal -->
		<div class="modal" id="myModal">
		  <div class="modal-dialog">
			<div class="modal-content">

			  <!-- Modal Header -->
			  <div class="modal-header">
				<h4 class="modal-title">Complete your request with comments</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>
				<form name="requestForm" id="requestForm" action="" method="post" enctype="multipart/form-data" novalidate>
				<input type="hidden" name="requestbookid" id="requestbookid">
			  <!-- Modal body -->
			  <div class="modal-body">
				
					 <div class="form-group">
						<label for="requestcomment" class="control-label">Comment</label>
						<textarea class="form-control" rows="5" name="requestcomment" id="requestcomment" maxlength="255"></textarea>
						<p class="requestcomment"></p>
					</div>
				
			  </div>

			  <!-- Modal footer -->
			  <div class="modal-footer">
				<button type="submit" class="btn btn-success" name="requestsubmit" id="requestsubmit" value="submit">Submit</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			  </div>
				</form>
			</div>
		  </div>
		</div>		<?php include 'footer.php';?>
		<script src="js/chosen.jquery.js" type="text/javascript"></script>
		<script>
		$(document).ready(function(){
			$(".chosen-select").chosen();
		});
		</script>
	</body>
</html>
<?php
	}else{
		header("Location:login.php");
	}
?>