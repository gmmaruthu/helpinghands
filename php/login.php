<?php

require('../DB.php');

  // checking the user
  if(empty($_SESSION)) // if the session not yet started
     session_start();

  if(isset($_POST["login"])){

    $email = mysqli_real_escape_string($con,$_POST["Email"]);
    $pass = mysqli_real_escape_string($con,$_POST["Password"]);
    $sel_user = "select Name,UserType,Phno from customer where Email='$email' AND Password='$pass'";

    $run_user = mysqli_query($con, $sel_user);

    $check_user = mysqli_num_rows($run_user);
    $row = mysqli_fetch_assoc($run_user);

    if($check_user>0){
      $_SESSION["user_email"]=$email;
      $_SESSION["user_name"]=$row["Name"];
      $_SESSION["user_type"]=$row["UserType"];
      $_SESSION["Phone"]=$row["Phno"];
		$HeadTo=$_SERVER['HTTP_REFERER'];
		Header("Location: ".$HeadTo);
    }
    else {
      echo '<script>
              alert("Incorrect Password or Username!");
              window.history.go(-1);
            </script>';
    }
  }

?>
