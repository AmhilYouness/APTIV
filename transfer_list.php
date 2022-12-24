<?php
require('include/sidebar.php');

$m=$_GET['m'];


$res_rej=$con->query("select * from job_request where (receiver_plant='$m' or giver_plant='$m') and reject!=0  ");

$res_app=$con->query("select * from job_request where (receiver_plant='$m' or giver_plant='$m') and reject=0 and approved_Level>=9 ");

$res_prog=$con->query("select * from job_request where (receiver_plant='$m' or giver_plant='$m') and reject=0 and approved_Level<11 ");

$pos=-2;
$case=0;


function fct($g_plant,$r_plant,$g_dept,$r_dept) { 
if($r_plant==$g_plant and $r_dept==$g_dept){
$case=1;
switch ($_SESSION['ROLE']) {
  case 'Dev Team':
    $pos=0;
    break;
  case 'Manager':
      $pos=1;
      break;
  case 'Country Manager':
      $pos=2;
    break;
  case 'HR Manager':
      $pos=3;
    break;
  case 'Plant Manager':
      $pos=4;
    break;
  case 'HR Director NA':
      $pos=5;
    break;
  case 'Operations Director NA':
      $pos=6;
    break;
}
    
}

if($r_plant==$g_plant and $r_dept!=$g_dept){

$case=2;
switch ($_SESSION['ROLE']) {
  case 'Dev Team':
    $pos=0;
    break;
  case 'HR Manager':
      $pos=5;
    break;
  case 'Plant Manager':
      $pos=6;
    break;
  case 'HR Director NA':
      $pos=7;
    break;
  case 'Operations Director NA':
      $pos=8;
    break;
}


if($_SESSION['DEPT']==$g_dept){
  switch ($_SESSION['ROLE']) {
      case 'Manager':
        $pos=1;
        break;
      case 'Country Manager':
          $pos=3;
        break;
  }   
}else{
  switch ($_SESSION['ROLE']) {
        case 'Manager':
          $pos=2;
          break;
      case 'Country Manager':
          $pos=4;
        break;
  }

}


    
}



if($r_plant!=$g_plant){
$case=3;

if($_SESSION['PLANT']==$g_plant){
  switch ($_SESSION['ROLE']) {
      case 'Dev Team':
        $pos=0;
        break;
      case 'Manager':
        $pos=1;
        break;
      case 'Country Manager':
          $pos=7;
        break;
      case 'HR Manager':
          $pos=3;
        break;
      case 'Plant Manager':
          $pos=5;
        break;
      case 'HR Director NA':
          $pos=9;
        break;
      case 'Operations Director NA':
          $pos=10;
        break;
  }

}
else{
  switch ($_SESSION['ROLE']) {
      case 'Dev Team':
        $pos=0;
        break;
        case 'Manager':
          $pos=2;
          break;
      case 'Country Manager':
          $pos=8;
        break;
      case 'HR Manager':
          $pos=4;
        break;
      case 'Plant Manager':
          $pos=6;
        break;
      case 'HR Director NA':
          $pos=9;
        break;
      case 'Operations Director NA':
          $pos=10;
        break;
  }

}
    
}


    return array($pos,$case);
  }


?>



<div class='ct' id=u4>
    <h1>Documents Transfer List</h1><br>
    <div style=display:flex;position:relative;margin-left:40px;>
    <div class='but act' id=a0 onclick=lsta(0)>In Progress</div>
    <div class=but id=a1 onclick=lsta(1) >Approved</div>
    <div class=but id=a2 onclick=lsta(2) >Rejected</div>
</div>



<div id='cnt_rej' class='h ln'>
<?php  if($res_rej->num_rows > 0){  ?>
<table style='width: 100% !important;'>
<tbody> 
    <tr>
        <th class=tet>Name</th>
        <th class=tet>WD ID</th>
        <th class=tet>Position actuel</th>
        <th class=tet>Location actuel</th>
        <th class=tet>Job Requesition</th>
        <th class=tet>New Position</th>
        <th class=tet>New Location</th>
        <th class=tet>Approvel Level</th>
        <th class=tet>rejecter</th>
        <th class=tet>Rejection Comment</th>
    </tr>
    <?php while($row_rej = $res_rej->fetch_object()){
        $res1=mysqli_query($con,"select * from employees where wd_id='$row_rej->wd_id' ");
        $row1=$res1->fetch_object();
        $res2=mysqli_query($con,"select * from jobs where id='$row_rej->id_job' ");
        $row2=$res2->fetch_object();
        $res3=mysqli_query($con,"select * from jobs where id='$row1->id_job' ");
        $row3=$res3->fetch_object();
        $res4=mysqli_query($con,"select * from users where id='$row_rej->reject' ");
        $row4=$res4->fetch_object();
    ?>
    <tr class='cr t'>
        <td class=ted><?php echo $row1->full_name ?></td>
        <td class=ted><?php echo $row1->wd_id ?></td>
        <td class=ted><?php echo $row3->position ?></td>
        <td class=ted><?php echo $row_rej->giver_plant ?></td>
        <td class=ted><?php echo $row_rej->code_job_req ?></td>
        <td class=ted><?php echo $row2->position ?></td>
        <td class=ted><?php echo $row_rej->receiver_plant ?></td>
        <td class=ted>
        <?php 
        if($row_rej->giver_plant==$row_rej->receiver_plant){
            echo $row_rej->approved_Level."/9";
        }
        else {echo $row_rej->approved_Level."/11";}
        ?>
        </td>
        <td>
            <?php echo $row4->full_name ?>
        </td>
        <td>
            <?php echo $row_rej->rejection_comment ?>
        </td>
    </tr>
    <?php } }else {echo "<h2> No data founds</h2>";} ?>
    </tbody>
    </table>
</div>


<div id='cnt_app' class='ln h'>
<?php if($res_app->num_rows > 0){  ?>
<table style='width: 100% !important;'>
<tbody> 
    <tr>
        <th class=tet>Name</th>
        <th class=tet>WD ID</th>
        <th class=tet>Position actuel</th>
        <th class=tet>Location actuel</th>
        <th class=tet>Job Requesition</th>
        <th class=tet>New Position</th>
        <th class=tet>New Location</th>
        <th class=tet>Approvel Level</th>

    </tr>
    <?php while($row_app = $res_app->fetch_object()){
 
        if( ($row_app->giver_plant==$row_app->receiver_plant and $row_app->approved_Level==9) or ($row_app->giver_plant!=$row_app->receiver_plant and $row_app->approved_Level==11) )
        {
        $res1=mysqli_query($con,"select * from employees where wd_id='$row_app->wd_id' ");
        $row1=$res1->fetch_object();
        $res2=mysqli_query($con,"select * from jobs where id='$row_app->id_job' ");
        $row2=$res2->fetch_object();
        $res3=mysqli_query($con,"select * from jobs where id='$row1->id_job' ");
        $row3=$res3->fetch_object();
        
    ?>
    <tr class='cr t'>
        <td class=ted><?php echo $row1->full_name ?></td>
        <td class=ted><?php echo $row1->wd_id ?></td>
        <td class=ted><?php echo $row3->position ?></td>
        <td class=ted><?php echo $row_app->giver_plant ?></td>
        <td class=ted><?php echo $row_app->code_job_req ?></td>
        <td class=ted><?php echo $row2->position ?></td>
        <td class=ted><?php echo $row_app->receiver_plant ?></td>
        <td class=ted>
        <?php 
        if($row_app->giver_plant==$row_app->receiver_plant){
            echo $row_app->approved_Level."/9";
        }
        else {echo $row_app->approved_Level."/11";}
        ?>
        </td>
    </tr>
    <?php } } }else {echo "<h2> No data founds</h2>";} ?>
    </tbody>
    </table>
</div>



<div id='cnt_prog' class='ln h'>
<?php if($res_prog->num_rows > 0){  ?>
<table style='width: 100% !important;'>
<tbody> 
    <tr>
        <th class=tet>Name</th>
        <th class=tet>WD ID</th>
        <th class=tet>Position actuel</th>
        <th class=tet>Location actuel</th>
        <th class=tet>Job Requesition</th>
        <th class=tet>New Position</th>
        <th class=tet>New Location</th>
        <th class=tet>Approvel Level</th>
        <th class=tet>Action</th>

    </tr>
    <?php while($row_prog = $res_prog->fetch_object()){
        if( ($row_prog->giver_plant==$row_prog->receiver_plant and $row_prog->approved_Level<9) or ($row_prog->giver_plant!=$row_prog->receiver_plant and $row_prog->approved_Level<11) )
        {
        $res1=mysqli_query($con,"select * from employees where wd_id='$row_prog->wd_id' ");
        $row1=$res1->fetch_object();
        $res2=mysqli_query($con,"select * from jobs where id='$row_prog->id_job' ");
        $row2=$res2->fetch_object();
        $res3=mysqli_query($con,"select * from jobs where id='$row1->id_job' "); 
        $row3=$res3->fetch_object();
        $array=fct($row_prog->giver_plant,$row_prog->receiver_plant,$row_prog->old_dept,$row_prog->new_dept); 
        $pos=$array[0];
        $case=$array[1];
        
    ?>
    <tr class='cr t'>
        <td class=ted><?php echo $row1->full_name ?></td>
        <td class=ted><?php  echo "<a href='transfer_case$case.php?id=$row_prog->id' >".$row1->wd_id."</a>"; ?> </td>
        <td class=ted><?php echo $row3->position ?></td>
        <td class=ted><?php echo $row_prog->giver_plant ?></td>
        <td class=ted><?php echo $row_prog->code_job_req ?></td>
        <td class=ted><?php echo $row2->position ?></td>
        <td class=ted><?php echo $row_prog->receiver_plant ?></td>
        <td class=ted>
        <?php 
        if($row_prog->giver_plant==$row_prog->receiver_plant){
            echo $row_prog->approved_Level."/9";
        }
        else {echo $row_prog->approved_Level."/11";}
        ?>
        </td>
        <td>
            <?php
            if( ($pos)==$row_prog->approved_Level){
                echo "<a href='approve.php?id=$row_prog->id' >Aprrove</a> ";
            }
            ?>
        </td>
    </tr>
    <?php } } }else {echo "<h2> No data founds</h2>";} ?>
    </tbody>
    </table>
</div>

</div>


<script type="text/javascript">

function lsta(t)
{

    if(t==2){
    document.getElementById("cnt_rej").classList.remove("h"),
    document.getElementById("cnt_app").classList.add("h"),
    document.getElementById("cnt_prog").classList.add("h"),
    document.getElementById("a2").classList.add("act"),
    document.getElementById("a1").classList.remove("act"),
    document.getElementById("a0").classList.remove("act")
    }
    if(t==1){
    document.getElementById("cnt_app").classList.remove("h"),
    document.getElementById("cnt_rej").classList.add("h"),
    document.getElementById("cnt_prog").classList.add("h"),
    document.getElementById("a1").classList.add("act"),
    document.getElementById("a2").classList.remove("act"),
    document.getElementById("a0").classList.remove("act")
    }
    if(t==0){
    document.getElementById("cnt_prog").classList.remove("h"),
    document.getElementById("cnt_rej").classList.add("h"),
    document.getElementById("cnt_app").classList.add("h"),
    document.getElementById("a0").classList.add("act"),
    document.getElementById("a1").classList.remove("act"),
    document.getElementById("a2").classList.remove("act")
    }
     
}

lsta(0);


</script> 
