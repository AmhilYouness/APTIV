<?php

require_once("include/db.php");
require_once("send_email.php");
session_start();



$id=$_GET['id'];
$sqlnxt="update job_request  set approved_Level=approved_Level+1 where id='$id' ";
mysqli_query($con,$sqlnxt);

$res=mysqli_query($con,"select * from job_request where id='$id' ");
$row=mysqli_fetch_assoc($res);
$sign=$row['approved_Level'];

$d=date("Y-m-d");


$sqlnxt="update dates  set signature$sign='$d' where id_job_req='$id' ";
mysqli_query($con,$sqlnxt);



//----Send email 




$new_plant=$row['receiver_plant'];
$old_plant=$row['giver_plant'];
$new_dept=$row['new_dept'];
$old_dept=$row['old_dept'];


$r="n";



switch ($_SESSION['ROLE']) {
    case 'Dev Team':
      $r='Manager';
      break;
    case 'Manager':
        $r='Country Manager';
      break;
    case 'Country Manager':
        $r='HR Manager';
      break;
    case 'HR Manager':
        $r='Plant Manager';
      break;
    case 'Plant Manager':
        $r='HR Director NA';
      break;
    case 'HR Director NA':
        $r='Operations Director NA';
      break;
}

if($r=="Manager" or $r="Country Manager"){
$res=$con->query("select * from users where role='$r' and (plant='$new_plant' or plant='$old_plant') and (departement='$old_dept' or departement='$new_dept') ");
}
else{
  $res=$con->query("select * from users where role='$r' and (plant='$new_plant' or plant='$old_plant') ");
}
if($res->num_rows > 0){
    while($row = $res->fetch_object()){
        $email=$row->email;
        $msg="You have new job request";
        send($email,$msg);

    }

}







      
    







//header('Location: ' . $_SERVER['HTTP_REFERER']);

?>