<?php
	require('DB.php');
  $name=$_POST["name"];
  $gender=$_POST["gender"];
  $phone=$_POST["phone"];
  $email=$_POST["email"];
  $password=$_POST["password"];

  $sql = "INSERT INTO users (Name, Password, Gender, Email, Phno, UserType)
  VALUES ('$name', '$password', '$gender', '$email', '$phone', 'User')";

  if ($conn->query($sql) === TRUE) {
      echo'<script>
              alert("signed up successfully!!");
              window.open("../index.php", "_self");
          </script>';
  }
  else {
      echo "Error: " . $sql . "<br>" . $conn->error;
      echo '<script>window.open("../index.php", "_self");</script>';
  }

  mysqli_close($conn);

?>
