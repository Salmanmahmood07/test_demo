<!--Signup-->
<?php
include "db.php";

if (isset($_POST['signup'])) {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$password = $_POST['password'];

$check="SELECT * FROM registration WHERE email = '$email'";
$rs = mysqli_query($conn,$check);
if(mysqli_num_rows($rs) > 0) {
    echo "User Already Exists <br/>";
}
  	else{
           $query = "INSERT INTO registration (firstname, lastname, email, password) 
      	    	  VALUES ('$firstname', '$lastname', '$email','".md5($password)."')";
           if (mysqli_query($conn, $query)) {
               echo "New record created successfully";
                } else {
               echo "Error: " . $query . "<br>" . mysqli_error($conn);
                }

            mysqli_close($conn);
            header("location: login.php");
  	}
}
?>
<!--Log in-->
<?php
  if (isset($_POST['submit'])) {
      // username and password sent from form 
      
      $email = mysqli_real_escape_string($conn,$_POST['email']);
      $password = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $sql = "SELECT * FROM registration WHERE email = '$email' AND password = '".md5($password)."'";
     
      $result = mysqli_query($conn,$sql);

      if (mysqli_num_rows($result) == 1) {
       
         header("location: home.php");
      }else {
         echo "Your Login Name or Password is invalid";
      }
   }
?>