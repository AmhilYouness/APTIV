<?php 

require_once("include/db.php");

if(isset($_POST['comment'])){
$comment=$_POST['comment'];
$id_req=$_POST['id_req'];
$id_user=$_POST['id_user'];
$sqlnxt="update job_request  set reject='$id_user',rejection_comment='$comment' where id='$id_req' ";
mysqli_query($con,$sqlnxt);

$res=mysqli_query($con,"select * from job_request where id='$id_req' ");
$row=mysqli_fetch_assoc($res);
$sign=$row['approved_Level']+1;

$d=date("Y-m-d");


$sqlnxt="update dates  set signature$sign='$d' where id_job_req='$id_req' ";
mysqli_query($con,$sqlnxt);


header('Location: ' . $_SERVER['HTTP_REFERER']);
}



?>