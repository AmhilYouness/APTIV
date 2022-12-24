<?php
require('include/sidebar.php');
$id=$_GET['id'];
$res=mysqli_query($con,"select * from job_request where id='$id' ");
$row=mysqli_fetch_assoc($res);


$id_employee=$row['wd_id'];
$res1=mysqli_query($con,"select * from employees where wd_id='$id_employee' ");
$row1=mysqli_fetch_assoc($res1);

$id_oldJob=$row1['id_job'];
$res2=mysqli_query($con,"select * from jobs where id='$id_oldJob' ");
$row2=mysqli_fetch_assoc($res2);

$id_newJob=$row['id_job'];
$res3=mysqli_query($con,"select * from jobs where id='$id_newJob' ");
$row3=mysqli_fetch_assoc($res3);


$res4=mysqli_query($con,"select * from employees_functions where wd_id='$id_employee' ");
$row4=mysqli_fetch_assoc($res4);

$code_req=$row['code_job_req'];
$res5=mysqli_query($con,"select * from job_request_details where job_requisition='$code_req' ");
$row5=mysqli_fetch_assoc($res5);

$res_date=mysqli_query($con,"select * from dates where id_job_req='$id' ");
$row_date=mysqli_fetch_assoc($res_date);

$nxt=$row['approved_Level'];
$rej=$row['reject'];
$comment=$row['rejection_comment'];
$date=$row['date'];

$g_plant=$row['giver_plant'];
$r_plant=$row['receiver_plant'];

$old_dept=$row['old_dept'];
$new_dept=$row['new_dept'];

$pos=-1;


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




if($_SESSION['DEPT']==$old_dept){
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


if($nxt==3 and  $row4['country_manager']=='-' ){
    $sqlnxt="update job_request  set approved_Level=approved_Level+1 where id='$id' ";
    mysqli_query($con,$sqlnxt);
    $res=mysqli_query($con,"select * from job_request where id='$id' ");
    $row=mysqli_fetch_assoc($res);
    $nxt=$row['approved_Level'];
}

if($nxt==4 and  $row5['receiver_country_manager']=='-' ){
    $sqlnxt="update job_request  set approved_Level=approved_Level+1 where id='$id' ";
    mysqli_query($con,$sqlnxt);
    $res=mysqli_query($con,"select * from job_request where id='$id' ");
    $row=mysqli_fetch_assoc($res);
    $nxt=$row['approved_Level'];
}









?>

<div class='ct' id=u3>
    <div class=cnt><div>

    <table class=tinf>
            <tbody>
                <tr>
                    <td class=tp>Role</td>
                    <td class=inf><?php echo $_SESSION['ROLE']; ?></td>
                </tr>
                <tr>
                    <td class=tp>Seisure Name</td>
                    <td class=inf><?php echo $_SESSION['NAME']; ?></td>
                </tr>
                <tr>
                    <td class=tp>Departement</td>
                    <td class=inf><?php echo $_SESSION['DEPT']; ?></td>
                </tr>
                <tr>
                    <td class=tp>Plant</td>
                    <td class=inf><?php echo $_SESSION['PLANT']; ?></td>
                </tr>
            </tbody>
        </table><br>

        <!--

        <form class=frm action="find_transfer.php" method="POST" autocomplete=off>
            <input autofocus id=uname type=text name=code placeholder="code job request" class='tai' require><br>
            <input name=submit type=submit value=Find class=bnt>
        </form>

-->


<table class=tinf>
    <tbody>
        <tr>
            <td class=tp>WD ID</td>
            <td class=inf><?php echo $row1['wd_id'] ?></td>
        </tr>
        <tr>
            <td class=tp>Employee's Name</td>
            <td id=x0 class=inf><?php echo $row1['full_name'] ?></td>
        </tr>
        <tr>
            <td class=tp>Departement</td>
            <td id=x2 class=inf><?php echo $row2['departement'] ?></td>
        </tr>
        <tr>
            <td class=tp>Old Position</td>
            <td id=x3 class=inf><?php echo $row2['position'] ?></td>
        </tr>
    </tbody>
</table><br>



<table class=tinf>
    <tbody>
        <tr>
            <td class=tp>Giver Plant</td>
            <td class=inf id=giv><?php echo $row['giver_plant'] ?></td>
        </tr>
        <tr>
            <td class=tp>Giver Manager</td>
            <td id=x4 class=inf><?php echo $row4['manager'] ?></td>
        </tr>
        <tr>
            <td class=tp>Giver Country Manager</td>
            <td id=x5 class=inf><?php echo $row4['country_manager'] ?></td>
        </tr>
        <tr>
            <td class=tp>Giver HR Manager</td>
            <td id=x6 class=inf><?php echo $row4['hr_manager'] ?></td>
        </tr>
        <tr>
            <td class=tp>Giver Plant Manager</td>
            <td id=x7 class=inf><?php echo $row4['plant_manager'] ?></td>
        </tr>
    </tbody>
</table><br>

<table class=tinf>
    <tbody>
        <tr>
            <td class=tp>Job Requesition</td>
            <td class=inf><?php echo $row['code_job_req'] ?></td>
        </tr>
        <tr>
            <td class=tp>Departement</td>
            <td class=inf id=y1><?php echo $row3['departement'] ?></td>
        </tr>
        <tr>
            <td class=tp>New Position</td>
            <td class=inf id=y2><?php echo $row3['position'] ?></td>
        </tr>
    </tbody>
</table><br>


<table class=tinf>
    <tbody>
        <tr>
            <td class=tp>Receiver Plant</td>
            <td class=inf id=rec><?php echo $row['receiver_plant'] ?></td>
        </tr>
        <tr>
            <td class=tp>Receiver Manager</td>
            <td class=inf id=y5><?php echo $row5['receiver_manager'] ?></td>
        </tr>
        <tr>
            <td class=tp>Receiver Country Manager</td>
            <td class=inf id=y6><?php echo $row5['receiver_country_manager'] ?></td>
        </tr>
        <tr>
            <td class=tp>Receiver HR Manager</td>
            <td class=inf id=y7><?php echo $row5['receiver_hr_manager'] ?></td>
        </tr>
        <tr>
            <td class=tp>Receiver Plant Manager</td>
            <td class=inf id=y8><?php echo $row5['receiver_plant_manager'] ?></td>
        </tr>
    </tbody>
</table><br>

<table class=tinf>
    <tbody>
        <tr>
            <td class=tp>HR NA Director</td>
            <td class=inf id=y9><?php echo $row5['hr_na_director'] ?></td>
        </tr>
        <tr>
            <td class=tp>Ops NA Director</td>
            <td class=inf id=y10><?php echo $row5['ops_na_director'] ?></td>
        </tr>
    </tbody>
</table>

</div>

<div>
<?php if($pos==$nxt and $rej==0 ){ ?>
    <div class=apprvd>
        <input type=button value=APPROVED onclick=conferm() class=apprv />
        <input type=button value=REJECTED onclick=rend(0) class=rjct />
    </div>
    <?php }elseif($rej==0){ echo "<br><h2>Waiting for others to make their decisions</h2>";}
    else{
        $res6=mysqli_query($con,"select * from users where id='$rej' ");
        $row6=mysqli_fetch_assoc($res6);
        $rej_name=$row6['full_name'];
        $rej_role=$row6['role'];
        echo "<br><h2>Job Requesition Rejected By ".$rej_name."<br>( ".$rej_role." ) </h2><br>"."<h3>Comment : ".$comment."</h3>";
        }
    ?>
    <div class=h id=render>
        <form action="reject.php" method="POST">
        <textarea name=comment required></textarea><br>
        <input type="hidden" name="id_req" value="<?php echo $id ?>" />
        <input type="hidden" name="id_user" value="<?php echo $_SESSION['USER_ID'] ?>" />
        <div>
            <input onclick=rej() type=submit class=bnt value='Send Comment' />
        </form>
            <input onclick=ext() type=button class=bnt value='Cancel' />
        </div>
    </div><br><br>
    <div class=h id=conferm>
        <div style=background:white;height:150px;font-size:30pt;padding:32px; >Do you confirm?<br><br>
        <input onclick=rend(1) type=button class=bnt value='Yes' />
        <input onclick=cncl() type=button class=bnt value='No' />
    </div>

</div>
<div class=avnc id=met></div>
</div>
</div>
</div>

<script type="text/javascript">
const _MS_PER_DAY = 1000 * 60 * 60 * 24;
users=[
        ["Dev Team","<?php if(!$row_date['signature1'] ){echo "---/--/--";}else echo $row_date['signature1'] ?>"],
        ["Giver Manager","<?php if(!$row_date['signature2'] ){echo "---/--/--";}else echo $row_date['signature2'] ?>"],
        ["Receiver Manager","<?php if(!$row_date['signature3'] ){echo "---/--/--";}else echo $row_date['signature3'] ?>"],
        ["Giver Country Manager","<?php if(!$row_date['signature4'] ){echo "---/--/--";}else echo $row_date['signature4'] ?>"],
        ["Receiver Country Manager","<?php if(!$row_date['signature5'] ){echo "---/--/--";}else echo $row_date['signature5'] ?>"],
        ["HR Manager","<?php if(!$row_date['signature6'] ){echo "---/--/--";}else echo $row_date['signature6'] ?>"],
        ["Plant Manager","<?php if(!$row_date['signature7'] ){echo "---/--/--";}else echo $row_date['signature7'] ?>"],
        ["HR Director NA","<?php if(!$row_date['signature8'] ){echo "---/--/--";}else echo $row_date['signature8'] ?>"],
        ["Operations Director NA","<?php if(!$row_date['signature9'] ){echo "---/--/--";}else echo $row_date['signature9'] ?>"]
    ];

function meth()
{
    var nxt=<?php echo $nxt ?>,rej=<?php echo $rej; ?>,date="<?php echo $date; ?>";
    for(fum="",i=0;i<users.length;i++)
    {
        var a,n,s,x,y;
        if(i==0) {x=new Date(date)} else {x=new Date(users[i-1][1]) }
        y=new Date(users[i][1]);
        var difference = dateDiffInDays(x, y);
        i<nxt?(a="pv"):(i==nxt && rej!=0)?(a="rej"):(i==nxt && rej==0)?(a="pav"):(a=""),

        (i<nxt && difference<4 )?(n=""):
        (i<nxt && difference>4 )?(n="pn"):
        (i==nxt && difference<4 )?(n=""):
        (i==nxt && difference>4 )?(n="pn"):(n="pd"),
        s=0==i?"":"<div class='br "+a+"'></div>",fum+=s+"<div><div class='date "+n+"'>"+users[i][1]+" ("+difference+" Days late)"+"</div><div class='aprv "+a+"'>"+users[i][0]+"</div></div>"
    }
    document.getElementById("met").innerHTML=fum;
}
      
function rend(t)
{
    var e=document.getElementById("render");
    var id=<?php echo $id ?> 
    0==t&&e.classList.remove("h");
    1==t&&(document.location.href = 'approve.php?id='+id) ;
}
function conferm(){
    document.getElementById("conferm").classList.remove("h")
}
function ext(){
    document.getElementById("render").classList.add("h")
}
function cncl(){
    document.getElementById("conferm").classList.add("h")
}
function rej(){
    var e=document.getElementById("comment");   
}
function dateDiffInDays(a, b) {
  const utc1 = Date.UTC(a.getFullYear(), a.getMonth(), a.getDate());
  const utc2 = Date.UTC(b.getFullYear(), b.getMonth(), b.getDate());

  return Math.floor((utc2 - utc1) / _MS_PER_DAY);
}

function dt_now(){
    var currentDate = new Date()
var day = currentDate.getDate()
var month = currentDate.getMonth() + 1
var year = currentDate.getFullYear()
return  (year+"-"+month+"-" +day);
}

meth();

</script>