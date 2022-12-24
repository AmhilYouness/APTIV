<?php
require('include/sidebar.php');
$result1 = $con->query("SELECT DISTINCT * from jobs ");
$result2 = $con->query("select * from plant ");



if(isset($_POST['create'])){
    $job=$_POST['job'];
    $plant=$_POST['plant'];
    $code=$_POST['code'];

    $res=mysqli_query($con,"select * from new_job_request where code='$code' ");
	$count=mysqli_num_rows($res);
	if($count>0){
        echo "<script> window.alert('Job request code $code already exist');
		document.location.href = 'create_jobrequest.php';
	    </script>";
    }else{
    $sqlnxt="insert into new_job_request (`code`, `id_job`, `plant`) VALUES ('$code','$job','$plant') ";
    mysqli_query($con,$sqlnxt);

    echo "<script> window.alert('Job request created successfully code=$code');
	    </script>";
    }
    


}


?>

<div class='ct' id=u3>




   
    <div>
        

        <h1>Create new Job request</h1>
        <form class=frm action="" method="POST" autocomplete=off>
        <table class=tinf>
            <tbody>
                <tr>
                    <td  class=tp>Enter code Job Request </td>
                    <td class=inf><input class=slc id=cjob placeholder='Code Job Req' name='code' required></td>
                </tr>
                <tr>
                    <td class=tp>Choose New Postion</td>
                    <td class=inf>
                    <select id=giv  class=slc name=job  >
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
                    <select id=giv  class=slc name=plant  >
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
 