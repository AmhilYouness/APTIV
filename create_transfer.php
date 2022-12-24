<?php
require('include/sidebar.php');
$result = $con->query("select * from employees order by plant ");
$result1 = $con->query("SELECT DISTINCT * from jobs ");
$result2 = $con->query("select * from plant ");


if(isset($_POST['find'])){
	$wd=mysqli_real_escape_string($con,$_POST['wd']);
    $code=mysqli_real_escape_string($con,$_POST['code']);

    if(!empty($wd)){
        $result=mysqli_query($con,"select * from employees where  wd_id='$wd' ");
        $count=mysqli_num_rows($result);
    if($count>0){    
    }
    else{
        $result = $con->query("select * from employees order by plant ");
    }
    }
    $resultj=mysqli_query($con,"select * from new_job_request where code='$code' ");
    $countj=mysqli_num_rows($resultj);
    if($countj>0){  
        $row=mysqli_fetch_assoc($resultj); 
        $id_job=$row['id_job'];
        $plant=$row['plant'];
        $result1= $con->query("SELECT * from jobs where id='$id_job' ");
        $result2 = $con->query("select * from plant where plant_name='$plant' ");
    }
    

}


if(isset($_POST['create'])){
    $id_employee=$_POST['employee'];
    $id_job=$_POST['job'];
    $plant=$_POST['plant'];
    $res=mysqli_query($con,"select * from employees where id='$id_employee' ");
    $row=mysqli_fetch_assoc($res);
    $old_plant=$row['plant'];
    $old_job=$row['id_job'];
    $wd=$row['wd_id'];

    $res=mysqli_query($con,"select * from jobs where id='$old_job' ");
    $row=mysqli_fetch_assoc($res);
    $old_dept=$row['departement'];

    $code=$_POST['code'];

    $res=mysqli_query($con,"select * from job_request where code_job_req='$code' ");
	$count=mysqli_num_rows($res);
	if($count>0){
        echo "<script> window.alert('Job request code $code already exist');
		document.location.href = 'create_transfer.php';
	    </script>";
    }

    
    
    $res=mysqli_query($con,"select * from jobs where id='$id_job' ");
    $row=mysqli_fetch_assoc($res);
    $dept=$row['departement'];
    $pos=$row['position'];
    $rec_manager=$row['manager'];
    $rec_country=$row['country_manager'];
    
    
    $res=mysqli_query($con,"select * from plant where plant_name='$plant' ");
    $row=mysqli_fetch_assoc($res);
    $plant_manager=$row['plant_manager'];
    $hr_manager=$row['hr_manager'];


    $sqlnxt="insert into job_request (`code_job_req`, `wd_id`, `id_job`, `receiver_plant`
    ,`giver_plant`,`old_dept`,`new_dept`) VALUES ('$code','$wd','$id_job','$plant','$old_plant',
    '$old_dept','$dept') ";
    mysqli_query($con,$sqlnxt);
    

    $v=0;
    if($old_plant==$plant){$v=1;}
    $last_id = $con->insert_id;

    $sqlnxt="insert into dates (`id_job_req`, `same_plant`) VALUES ('$last_id','$v') ";
    mysqli_query($con,$sqlnxt);

  


    $sqlnxt="INSERT INTO `job_request_details`(`job_requisition`, `departement`, `position`,
     `receiver_manager`, `receiver_country_manager`, `receiver_hr_manager`, `receiver_plant_manager`,
    `hr_na_director`, `ops_na_director`, `wd_id`, `new_location`, `old_location`,`old_dept`) 
    VALUES ('$code','$dept','$pos','$rec_manager','$rec_country','$hr_manager','$plant_manager','Assid Houbane'
    ,'Mohammed Bahri Filali','$wd','$plant','$old_plant','$old_dept')";
    mysqli_query($con,$sqlnxt);
    

	$res=mysqli_query($con,"select * from job_request where  code_job_req='$code' ");	
	$count=mysqli_num_rows($res);
    echo "hello 1";
	if($count>0){
		$row=mysqli_fetch_assoc($res);
            $id=$row['id'];
            echo "heloo 2";
            if($row['receiver_plant']==$row['giver_plant']){
                echo("<script>location.href = 'transfer_case3.php?id=$id';</script>");
					//header('location:transfer_case3.php?id='.$id);
            }
			elseif($row['old_dept']!=$row['new_dept'] ){
                echo("<script>location.href = 'transfer_case2.php?id=$id';</script>");
                //header('location:transfer_case2.php?id='.$id);
			}
			else{
                echo("<script>location.href = 'transfer_case1.php?id=$id';</script>");
                //header('location:transfer_case1.php?id='.$id);
            }
           
	}

}


?>

<div class='ct' id=u3>

<h1>Find Employee By WD ID</h1>
<form class=frm action="" method="POST" autocomplete=off>
            <input autofocus  type=text name=wd placeholder="WD ID" class='tai' ><br>
            <input autofocus  type=text name=code placeholder="Code job_request" class='tai' ><br>
            <input name=find type=submit value=Find class=bnt>
</form>



   
    <div>
        

        <h1>Create new Transfer</h1>
        <form class=frm action="" method="POST" autocomplete=off>
        <table class=tinf>
            <tbody>
                <tr>
                    <td class=tp>Choose Employee</td>
                    <td class=inf>
                        <select id=giv  class=slc name=employee >
                        <?php
                            if($result->num_rows > 0){
                                while($row = $result->fetch_object()){
                                    echo "<option value=$row->id >$row->full_name    ( wd id : $row->wd_id -- plant : $row->plant )</option>";
                                }
                            }
                            ?>                          
                        </select>
                    </td>
                </tr>
                <tr>
                    <td  class=tp>Enter code Job Request </td>
                    <td class=inf><input class=slc id=cjob placeholder='Code Job Req' name='code' value='<?php if(isset($code)){echo $code;} ?>'></td>
                </tr>
                <tr>
                    <td class=tp>Choose New Postion</td>
                    <td class=inf>
                    <select id=giv  class=slc name=job >
                    <?php
                            if($result1->num_rows > 0){
                                while($row1 = $result1->fetch_object()){
                                    echo "<option value=$row1->id >$row1->position </option>";
                                }
                            }
                            ?>  
                     </select>
                    </td>
                </tr>
                <tr>
                    <td class=tp>Choose New Plant</td>
                    <td class=inf>
                    <select id=giv  class=slc name=plant >
                    <?php
                            if($result2->num_rows > 0){
                                while($row2 = $result2->fetch_object()){
                                    echo "<option value=$row2->plant_name >$row2->plant_name </option>";
                                }
                            }
                            ?>   
                 </select>
                    </td>
                </tr>
                <tr><td></td><td>
                <input name=create type=submit value=Create class=bnt></td>
                </tr>
                </tbody>
                </table>
  
        </form>
 