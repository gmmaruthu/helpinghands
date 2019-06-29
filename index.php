<?php
session_start();
	if(isset($_SESSION["user_type"])) {
?>

<!doctype html>
<html lang="en">
	<head>
		<?php include 'header.php';?>

		<title>Welcome | Helping Hands</title>
	</head>
	<body>
		<?php include 'navbar.php';?>

		

    <!-- Begin page content -->
    <main role="main" class="container conent-header landing_page">
      <h1 class="mt-5 welcome">Welcome to Books request</h1>
	  
		<div class="box">
			<a href="addbooks.php"><h2>Add Books</h2></a>
		</div>

		<div class="box">
			<a href="searchbooks.php"><h2>Search Books</h2></a>
		</div>
		
		<div class="box">
			<a href="mypage.php"><h2>Your Page</h2></a>
		</div>
    </main>

		<?php include 'footer.php';?>

	</body>
</html>

<?php
	}else{
		header("Location:login.php");
	}
?>
