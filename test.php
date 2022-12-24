<?php

$con=mysqli_connect('localhost','root','','aptiv2');

$code="j009";
$res=mysqli_query($con,"select * from job_request where  code_job_req='$code' ");	
	$count=mysqli_num_rows($res);
    echo "hello 1";
	if($count>0){
		$row=mysqli_fetch_assoc($res);
            $id=$row['id'];
            echo "heloo 2";
            if( strcmp($row['receiver_plant'],$row['giver_plant'])==0 ){
                echo "hello 3";
                //echo "<script> document.location.href = 'location:transfer_case3.php?id=$id'; </script>";
                echo "hello 6";
					header('location:transfer_case3.php?id='.$id);
            }
			elseif( strcmp($row['old_dept']!=$row['new_dept'])==0 ){
                echo "hello 4";
                echo "<script>document.location.href = 'location:transfer_case2.php?id=$id';</script>";
                //header('location:transfer_case2.php?id='.$id);
			}
			else{
                echo "hello 5";
                echo "<script>document.location.href = 'transfer_case1.php?id=$id';</script>" ;
                //header('location:transfer_case1.php?id='.$id);
            }  
	}


?>