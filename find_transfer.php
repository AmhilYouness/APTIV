<?php
require_once("include/db.php");
session_start();

if(isset($_POST['code'])){
	$code=mysqli_real_escape_string($con,$_POST['code']);
	$res=mysqli_query($con,"select * from job_request where  code_job_req='$code' ");	
	$count=mysqli_num_rows($res);
	if($count>0){
		$row=mysqli_fetch_assoc($res);
        if( ($_SESSION['PLANT']==NULL  or $row['receiver_plant']==$_SESSION['PLANT'] or $row['giver_plant']==$_SESSION['PLANT']) and ($_SESSION['DEPT']==null or $_SESSION['DEPT']==$row['old_dept'] or $_SESSION['DEPT']==$row['new_dept'] )  )
		{
            $id=$row['id'];
			if($row['receiver_plant']!=$row['giver_plant'] ){
				header('location:transfer_case1.php?id='.$id);
			}
			elseif( $row['old_dept']!=$row['new_dept'] ){
					header('location:transfer_case2.php?id='.$id);
				}
				else{
					header('location:transfer_case3.php?id='.$id);
				}
		}else{
            echo "<script> window.alert('You do not have access');
		    document.location.href = 'transfers.php';
	        </script>";
        }
	}
	else{
		echo "<script> window.alert('Code does not exist');
		document.location.href = 'transfers.php';
	    </script>";
	}
}


?>