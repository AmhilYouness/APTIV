<?php
require_once("include/db.php");
session_start();

$email=$_SESSION['email'];

if(isset($_POST['password'])){
    $real_code=$_POST['real_code'];
    $c=$_POST['c'];
    $password=mysqli_real_escape_string($con,$_POST['password']);
    if($c==$real_code){
        $sql="update users  set password='$password' where email='$email' ";
        mysqli_query($con,$sql);
        echo "<script> window.alert('Password updated successfully');
		document.location.href = 'index.php';
	    </script>";
    }
    else{
        echo "<script> window.alert('Code incorrect');
        document.location.href = 'forgot_password.php';
        </script>";
    }
}



?>