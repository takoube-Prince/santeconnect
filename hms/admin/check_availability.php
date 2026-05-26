<?php 
require_once("include/config.php");
if(!empty($_POST["emailid"])) {
    $email= $_POST["emailid"];
    
        $result =mysqli_query($con,"SELECT docEmail FROM doctors WHERE docEmail='$email'");
        $count=mysqli_num_rows($result);
if($count>0)
{
echo "<span style='color:red'> Cet e-mail existe déjà.</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
    
    echo "<span style='color:green'> E-mail disponible pour l'inscription.</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}

?>