<?php

session_start();
require_once('include/db.php');


if(isset($_POST["submit_employee_fonctions"]))
{
    /*$filename = $_FILES["liste_employees"]["name"];
    $tempname = $_FILES["liste_employees"]["tmp_name"]; 
    $filename=substr($filename,0,-4)."csv";
    echo $filename;
    $folder = "images/".$filename;
    move_uploaded_file($tempname, $folder); */
    set_time_limit(0);


$file = $_FILES["employee_fonctions"]["tmp_name"];
 $file_open = fopen($file,"r");
 $csv = fgetcsv($file_open, 1000, ",");
 while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
 {
  print_r($csv);
  $mat = mysqli_real_escape_string($con,$csv[0]);
  $wd=mysqli_real_escape_string($con,$csv[1]);
  $nom=mysqli_real_escape_string($con,$csv[2]);
  $prenom=mysqli_real_escape_string($con,$csv[3]);
  $centre=mysqli_real_escape_string($con,$csv[4]);
  $dept=mysqli_real_escape_string($con,$csv[5]);
  $fonction=mysqli_real_escape_string($con,$csv[6]);
  $manager=mysqli_real_escape_string($con,$csv[7]);
  $hr_manager=mysqli_real_escape_string($con,$csv[8]);
  $plant_manager=mysqli_real_escape_string($con,$csv[9]);
  $country_manager=mysqli_real_escape_string($con,$csv[10]);
  $location=mysqli_real_escape_string($con,$csv[11]);
  $full_name=$nom." ".$prenom;


  

  $sql="INSERT INTO `employees_functions`(`matricule`, `wd_id`, `nom`, `prenom`, `centre_cout`, `departement`, `fonction`, `manager`, `hr_manager`, `plant_manager`, `country_manager`, `location`) VALUES ('$mat','$wd','$nom','$prenom','$centre','$dept','$fonction','$manager','$hr_manager','$plant_manager','$country_manager','$location')";
  mysqli_query($con,$sql);

  $res=mysqli_query($con,"select * from jobs where position='$fonction' and departement='$dept' and plant='$location' ");
  $count=mysqli_num_rows($res);
	if($count<=0){
        $sql="INSERT INTO `jobs`(`position`, `departement`, `manager`, `country_manager`,`plant`) VALUES ('$fonction','$dept','$manager','$country_manager','$location')";
        mysqli_query($con,$sql);
        $id_job=$con->insert_id;
    }
    else{
        $row=mysqli_fetch_assoc($res);
        $id_job=$row['id'];
    }
  

  $sql="INSERT INTO `employees`(`wd_id`, `full_name`, `plant`, `id_job`, `img`) VALUES ('$wd','$full_name','$location','$id_job','img')";
  mysqli_query($con,$sql);

  
  echo mysqli_error($con);

  //header("location:data_update.php");


 }
}




?>