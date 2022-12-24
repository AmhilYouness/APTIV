<?php

require_once("include/db.php");
session_start();

if(isset($_POST['email']) && isset($_POST['password'])){
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	$res=mysqli_query($con,"select * from users where email='$email' and password='$password'");
	$count=mysqli_num_rows($res);
	if($count>0){
		$row=mysqli_fetch_assoc($res);
		$_SESSION['ROLE']=$row['role'];
		$_SESSION['USER_ID']=$row['id'];
		$_SESSION['NAME']=$row['full_name'];
		$_SESSION['PLANT']=$row['plant'];
		$_SESSION['DEPT']=$row['departement'];
		$_SESSION['IMG']=$row['img'];
		header('location:deshboard.php');
		}
	else{
		echo "<script> window.alert('Username Or Password incorrect');
		document.location.href = 'index.php';
	    </script>";
	}
}

?>

