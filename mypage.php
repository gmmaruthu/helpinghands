<?php  
	require('php/DB.php');  
	
	session_start();
	if(isset($_SESSION["user_type"])) {

	$sql1 = "SELECT BR.request_id,BR.book_status,BR.request_description,B.book_title,B.book_author,B.book_description 
	FROM `book_request` BR
	inner join books B on B.book_id = BR.book_id
	where BR.user_id='".$_SESSION["user_id"]."'"; 
	$result = mysqli_query($conn,$sql1);
	$request_count = mysqli_num_rows($result);
	
	$sql2 = "SELECT * FROM `books` where created_user ='".$_SESSION["user_id"]."'"; 
	$result1 = mysqli_query($conn,$sql2);
	$posted_count = mysqli_num_rows($result1);
	
	$sql3 = "SELECT BR.request_id,BR.book_id,BR.user_id,BR.book_status,BR.request_description,B.book_title,B.book_author,B.book_description  FROM `books` B 
inner join `book_request` BR on BR.book_id = B.book_id
where created_user = '".$_SESSION["user_id"]."'"; 
	$result2 = mysqli_query($conn,$sql3);
	$received_count = mysqli_num_rows($result2);
?>
<!doctype html>
<html lang="en">
	<head>
		<?php include 'header.php';?>

		<title>Mypage</title>
	</head>
	<body>
		<?php include 'navbar.php';?>

		

    <!-- Begin page content -->
    <main role="main" class="container conent-header my_page">
        <!-- Page Heading -->
			<div class="row conent-header">
				<div class="col-lg-12">
					<h1 class="page-header">My page</h1>
				</div>
			</div>

			<div class="row">
				<div class="col-md-8">
					<p>Your activities.</p>
				</div>
			</div>

			<br>
				<?php if(isset($_SESSION["message"])){
					echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong>Success!</strong> Your response has been sent.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>';
					unset($_SESSION["message"]);
				} ?>
		<div class="container">
			<div class="row">
				<div class="col-sm">
					<div class="list-group">
					  <button type="button" class="list-group-item list-group-item-action active">
						Requested
					  </button>
					  <?php 
					  
						if($request_count == 0){
							echo '<a href="#" class="list-group-item list-group-item-action list-group-item-light">';
							echo "You don't have any open request";
							echo '</a>';
						}
						
						while($res = mysqli_fetch_array($result)){
						?>
						  <a href="#" class="list-group-item list-group-item-action list-group-item-light">
						  <?php echo $res['book_title'].' - '.$res['book_author']; ?>
						  
						  <?php 
							if($res['book_status'] == '0'){
								echo ' <span class="badge badge-primary badge-pill bookstatus pending"> pending </span>';
							}else if($res['book_status'] == '1'){
								echo '<span class="badge badge-success badge-pill bookstatus accept"> Accepted </span>';
							}else if($res['book_status'] == '2'){
								echo '<span class="badge badge-danger badge-pill bookstatus reject"> Rejected </span>';
							}
							?>
						  
						  </a>
						<?php } ?>
					</div>
				</div>
				<div class="col-sm">
					<div class="list-group">
					  <button type="button" class="list-group-item list-group-item-action active">
						Posted
					  </button>
					  <?php 
						if($posted_count == 0){
							echo '<a href="#" class="list-group-item list-group-item-action list-group-item-light">';
							echo "You don't have any open request";
							echo '</a>';
						}
						while($res = mysqli_fetch_array($result1)){
						?>
						  <a href="#" class="list-group-item list-group-item-action list-group-item-light">
						  <?php echo $res['book_title'].' - '.$res['book_author']; ?>
						  </a>
						<?php } ?>
					</div>
				</div>
				<div class="col-sm">
					<div class="list-group">
					  <button type="button" class="list-group-item list-group-item-action active">
						Received
					  </button>
						<?php 
							if($received_count == 0){
								echo '<a href="#" class="list-group-item list-group-item-action list-group-item-light">';
								echo "You don't have any open request";
								echo '</a>';
							}
							while($res = mysqli_fetch_array($result2)){
						?>
						  <a href="requestedbooks.php?bid=<?php echo $res['book_id']; ?>&ruid=<?php echo $res['user_id']; ?>" class="list-group-item list-group-item-action list-group-item-light">
						  <?php echo $res['book_title'].' - '.$res['book_author']; ?>
						  <?php 
							if($res['book_status'] == '0'){
								echo ' <span class="badge badge-primary badge-pill bookstatus pending"> pending </span>';
							}else if($res['book_status'] == '1'){
								echo '<span class="badge badge-success badge-pill bookstatus accept"> Accepted </span>';
							}else if($res['book_status'] == '2'){
								echo '<span class="badge badge-danger badge-pill bookstatus reject"> Rejected </span>';
							}
							?>
						  </a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
			<!-- /.container -->
    </main>

		<?php include 'footer.php';?>

	</body>
</html>
<?php
	}else{
		header("Location:login.php");
	}
?>
