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

  /* Get books */
  $limit = 5;
  if (isset($_GET["page"])) {  
      $pn  = $_GET["page"];  
    }  
    else {  
      $pn=1;  
    };  
    $start_from = ($pn-1) * $limit;  
  $get_books_sql = "SELECT b.*, br.book_id as requested_book FROM `books` b
					LEFT JOIN book_request br on br.book_id = b.book_id and br.book_status IN (0,1)
					where `created_user` = '".$_SESSION['user_id']."' LIMIT $start_from, $limit";
  $get_books = mysqli_query($conn, $get_books_sql);

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
				} else if(isset($_SESSION["update_message"])){
					echo '<div class="alert alert-success">
					  <strong>Success!</strong> Your book successfully updated.
					</div>';
					unset($_SESSION["update_message"]);
				} else if($_SESSION["delete_message"]){
					echo '<div class="alert alert-success">
					  <strong>Success!</strong> Your book successfully deleted.
					</div>';
					unset($_SESSION["delete_message"]);
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

			<!-- Crud method for books -->
			<div class="mt-5 row">
				<div class="col-md-12 book-table">
					<table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Author</th>
						<th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                	<?php 
                	if ($get_books->num_rows > 0) { 
                			while($row = mysqli_fetch_array($get_books)) { ?>
			                	<tr id="<?php echo $row['book_id']; ?>">
			                        <td><?php echo $row['book_title']; ?></td>
			                        <td><?php echo $row['book_author']; ?></td>
									<td><?php echo $row['book_description']; ?></td>
			                        <td>
			                        	<?php if(empty($row['requested_book'])) { ?>
				                            <a href="editbook.php?book_id=<?php echo $row['book_id']; ?>" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
				                            <a href="deletebook.php?book_id=<?php echo $row['book_id']; ?>" class="delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
			                        	<?php } else{ ?>
											<button class="btn btn-sm btn-default">Book Requested</button>
			                        	<?php }?>
			                        </td>
			                    </tr>
                			<?php }
            		} else { ?>
                		<tr><td colspan="4"> No Books Found.</td></tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="clearfix">
            	<?php 
            		$sql = "SELECT COUNT(*) FROM `books` where `created_user` = ".$_SESSION['user_id'];   
			        $rs_result = mysqli_query($conn, $sql);
			        $row = mysqli_fetch_row($rs_result); 

			        $total_records = $row[0];
            	?>
                <div class="hint-text">Showing <b class="showing"><?php echo $get_books->num_rows; ?></b> out of <b class="entries"><?php echo $total_records; ?></b> entries</div>
                <ul class="pagination">
                	<?php 
			        // Number of pages required. 
			        $total_pages = ceil($total_records / $limit);   
			        $pagLink = "";                         
			        for ($i=1; $i<=$total_pages; $i++) { 
			          if ($i==$pn) { 
			              $pagLink .= "<li class='page-item active'><a class='page-link' href='addbooks.php?page="
			                                                .$i."'>".$i."</a></li>"; 
			          }             
			          else  { 
			              $pagLink .= "<li class='page-item'><a class='page-link' href='addbooks.php?page=".$i."'> 
			                                                ".$i."</a></li>";   
			          } 
			        };   
			        echo $pagLink;   
			      ?> 
                </ul>
            </div>
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
