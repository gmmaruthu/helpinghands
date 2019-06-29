<?php  require('php/DB.php'); 
$res2 = '';
session_start();
if(isset($_SESSION["user_type"])) {
	
if(isset($_POST['requeststatus'])){

		$requeststatus = $_POST['requeststatus'];
		$requestbookid = $_POST['requestbookid'];
		if($requeststatus == '1'){
		$sql1 = "UPDATE `book_request` SET `book_status` = 1, `accept_date` = '".$_POST['acceptdate']."', `accept_time` = '".$_POST['accepttime']."', `accept_location` = '".$_POST['acceptlocation']."',`accept_phone` = '".$_POST['acceptphone']."',`acceptreject_description` = '".$_POST['acceptdescription']."' WHERE `request_id` = '".$_POST['requestid']."'";
		}else{
			$sql1 = "UPDATE `book_request` SET `book_status` = 2, `acceptreject_description` = '".$_POST['rejectreason']."' WHERE `request_id` = '".$_POST['requestid']."'";
		}
		
		if ($conn->query($sql1) === TRUE) {
			$_SESSION['message'] = 'Success';
			
			header("Location:mypage.php");
			exit;
		}
}	


$sql = "SELECT BR.request_id,BR.request_description,B.book_title,B.book_author,B.book_description FROM `book_request` BR
inner join books B on B.book_id = BR.book_id
where BR.book_id='".$_GET['bid']."' and BR.user_id='".$_GET['ruid']."' and BR.book_status='0'";
$result = mysqli_query($conn,$sql);
$res = mysqli_fetch_array($result);
?>
<!doctype html>
<html lang="en">
	<head>
		<?php include 'header.php';?>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="css/chosen.css">
		<title>Accept/Reject book request</title>
	</head>
	<style>
	.navbar-nav.mr-auto{
		float: left;
		width: 92%;
	}
	.form-inline.mt-2.mt-md-0{
		margin-top: 15px !important;
		font-size: 15px;
	}
	.navbar {
		border-radius: 0;
		padding: 0;
	}
	.navbar-dark .navbar-brand{
		margin: 0;
		padding: 10px;
	}
	.card-box {
		padding: 15px;
	}
	
	.form-control{
		height: 34px !important;
	}
	textarea.form-control {
		height: auto !important;
	}
	</style>
	<body>
		<?php 
		include 'navbar.php';

		?>
		<main role="main" class="container">

			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Requested Book Details</h1>
				</div>
			</div>

			<div class="row">
				<div class="col-md-8">
					<p>You can select Accept/Reject to close this request.</p>
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
			<!-- Signup Form -->
			<div class="row card-box">
				<div class="col-md-12">
					<div class="form-group row">
						<label for="bookname" class="col-sm-4 col-form-label">Book Name</label>
						<label for="bookname" class="col-sm-8 col-form-label">
						  <?php echo $res['book_title']; ?>
						</label>
					  </div>
					  <div class="form-group row">
						<label for="bookauthor" class="col-sm-4 col-form-label">Book Author</label>
						<label for="bookname" class="col-sm-8 col-form-label">
						  <?php echo $res['book_author']; ?>
						</label>
					  </div>
					  <div class="form-group row">
						<label for="requestcomments" class="col-sm-4 col-form-label">Requested Comments</label>
						<label for="bookname" class="col-sm-8 col-form-label rudesc">
						  <?php echo $res['request_description']; ?>
						</label>
					  </div>
				 </div>
			</div>
			<br>
			<?php  if(count($res) > 0){ ?>
			<div class="row card-box acceptform">
				<div class="col-md-12">
					<form name="requestbookForm" id="requestbookForm" action="" method="post" enctype="multipart/form-data" novalidate>
					<input type="hidden" name="requestid" id="requestid" value="<?php echo $res['request_id']; ?>">
					  <div class="form-group row">
						<label for="requeststatus" class="col-sm-2 col-form-label control-label">Your Action</label>
						<div class="col-sm-10">
						 <select class="form-control" name="requeststatus" id="requeststatus" required>
							<option></option>
							<option value="1">Accept</option>
							<option value="2">Reject</option>
						  </select>
						  <p class="requeststatus"></p>
						</div>
					  </div>
					  <div id="accept_request" style="display:none;">
						  <div class="form-group row">
							<label for="acceptlocation" class="col-sm-2 col-form-label control-label">Delivery Location</label>
							<div class="col-sm-10">
								<select class="form-control" name="acceptlocation" id="acceptlocation" required>
									<option></option>
									<?php 
										$sqlloc = "SELECT * FROM `location` where location_status = 1";
										$resultloc = mysqli_query($conn,$sqlloc);
										while($res = mysqli_fetch_array($resultloc)){
											echo '<option value="'.$res['location_id'].'">'.$res['location_name'].'</option>';
										}
									
									?>
								</select>
								<p class="acceptlocation"></p>
							</div>
						  </div>
						  <div class="form-group row">
							<label for="acceptdate" class="col-sm-2 col-form-label control-label">Delivery Date</label>
							<div class="col-sm-10">
								<div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
									<input class="form-control" size="16" type="text" value="" readonly  name="acceptdate" id="acceptdate" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
									<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
								</div>
								
								<p class="acceptdate"></p>
							</div>
						  </div>
						  <div class="form-group row">
							<label for="accepttime" class="col-sm-2 col-form-label control-label">Delivery Time</label>
							<div class="col-sm-10">
								<div class="input-group date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
									<input class="form-control" size="16" type="text" value="" readonly name="accepttime" id="accepttime" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
								</div>
							
								<p class="accepttime"></p>
							</div>
						  </div>
						  <div class="form-group row">
							<label for="acceptphone" class="col-sm-2 col-form-label">Mobile</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="acceptphone" id="acceptphone" maxlength="12" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
								<p class="acceptphone"></p>
							</div>
						  </div>
						  <div class="form-group row">
							<label for="acceptdate" class="col-sm-2 col-form-label">Description</label>
							<div class="col-sm-10">
								<textarea class="form-control" rows="6" name="acceptdescription" id="acceptdescription"  required maxlength="255"></textarea>
								<p class="acceptdescription"></p>
							</div>
						  </div>
					  </div>
					  <div id="reject_request" style="display:none;">
						  <div class="form-group row">
							<label for="acceptdate" class="col-sm-2 col-form-label control-label">Reject Reason</label>
							<div class="col-sm-10">
								<textarea class="form-control" rows="6" name="rejectreason" id="rejectreason"  required maxlength="255"></textarea>
								<p class="rejectreason"></p>
							</div>
						  </div>
					  </div>
						<div class="form-group row submit" >
							<button type="submit" class="btn btn-success" name="submit" id="submit" value="submit">Submit</button>
						</div>
					  
					</form>
				 </div>
			</div>
			<?php } ?>
		</main>
		
		<br>
	  
		<?php include 'footer.php';?>
		<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
		<script src="js/chosen.jquery.js" type="text/javascript"></script>
		<script>
		$('.form_date').datetimepicker({
			// language:  'fr',
			startDate: new Date(),
			weekStart: 1,
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			minView: 2,
			forceParse: 0
		});
		$('.form_time').datetimepicker({
			// language:  'fr',
			startDate: new Date(),
			weekStart: 1,
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 1,
			minView: 0,
			maxView: 1,
			forceParse: 0
		});
		$(document).ready(function(){
			$(".chosen-select").chosen();
			$("#acceptphone").inputFilter(function(value) {
			  return /^\d*$/.test(value);
			});
		});
		</script>
	</body>
</html>
<?php
	}else{
		header("Location:login.php");
	}
?>