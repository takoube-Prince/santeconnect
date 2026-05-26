<?php
session_start();
error_reporting(0);
include('include/config.php');

if(strlen($_SESSION['id'])==0) {
    header('location:logout.php');
} else {
    if(isset($_POST['submit'])) {
        $vid=$_GET['viewid'];
        $bp=$_POST['bp'];
        $bs=$_POST['bs'];
        $weight=$_POST['weight'];
        $temp=$_POST['temp'];
        $pres=$_POST['pres'];
        
        // Correction de la syntaxe : suppression du point de concaténation inutile (.=)
        $query=mysqli_query($con, "insert into tblmedicalhistory(PatientID,BloodPressure,BloodSugar,Weight,Temperature,MedicalPres) value('$vid','$bp','$bs','$weight','$temp','$pres')");
        
        if ($query) {
            echo '<script>alert("L\'historique médical a été ajouté avec succès.")</script>';
            echo "<script>window.location.href ='manage-patient.php'</script>";
        } else {
            echo '<script>alert("Une erreur est survenue. Veuillez réessayer.")</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Médecin | Gérer les Patients</title>
    
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
  </head>
  <body>
    <div id="app">    
<?php include('include/sidebar.php');?>
<div class="app-content">
<?php include('include/header.php');?>
<div class="main-content" >
<div class="wrap-content container" id="container">
            <!-- start: PAGE TITLE -->
<section id="page-title">
<div class="row">
<div class="col-sm-8">
<h1 class="mainTitle">Médecin | Gérer les Patients</h1>
</div>
<ol class="breadcrumb">
<li>
<span>Médecin</span>
</li>
<li class="active">
<span>Gérer les Patients</span>
</li>
</ol>
</div>
</section>
<div class="container-fluid container-fullw bg-white">
<div class="row">
<div class="col-md-12">
<h5 class="over-title margin-bottom-15">Gérer les <span class="text-bold">Patients</span></h5>
<?php
                               $vid=$_GET['viewid'];
                               $ret=mysqli_query($con,"select * from tblpatient where ID='$vid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
                               ?>
<table border="1" class="table table-bordered">
 <tr align="center">
<td colspan="4" style="font-size:20px;color:blue">
    Détails du Patient</td></tr>

    <tr>
    <th>Nom du Patient</th>
    <td><?php  echo $row['PatientName'];?></td>
    <th>Email du Patient</th>
    <td><?php  echo $row['PatientEmail'];?></td>
  </tr>
  <tr>
    <th>Numéro de Téléphone</th>
    <td><?php  echo $row['PatientContno'];?></td>
    <th>Adresse</th>
    <td><?php  echo $row['PatientAdd'];?></td>
  </tr>
    <tr>
    <th>Genre</th>
    <td><?php  echo $row['PatientGender'];?></td>
    <th>Âge</th>
    <td><?php  echo $row['PatientAge'];?></td>
  </tr>
  <tr>
    
    <th>Antécédents Médicaux</th>
    <td><?php  echo $row['PatientMedhis'];?></td>
    <th>Date d'Enregistrement</th>
    <td><?php  echo $row['CreationDate'];?></td>
  </tr>
 
<?php }?>
</table>
<?php  
$ret=mysqli_query($con,"select * from tblmedicalhistory where PatientID='$vid'");
 ?>
<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <tr align="center">
   <th colspan="8" >Historique Médical</th> 
  </tr>
  <tr>
    <th>#</th>
<th>Pression Artérielle</th>
<th>Poids</th>
<th>Glycémie</th>
<th>Température Corporelle</th>
<th>Ordonnance Médicale</th>
<th>Date de la Visite</th>
</tr>
<?php  
while ($row=mysqli_fetch_array($ret)) { 
  ?>
<tr>
  <td><?php echo $cnt;?></td>
 <td><?php  echo $row['BloodPressure'];?></td>
 <td><?php  echo $row['Weight'];?> kg</td>
 <td><?php  echo $row['BloodSugar'];?></td> 
  <td><?php  echo $row['Temperature'];?> °C</td>
  <td><?php  echo $row['MedicalPres'];?></td>
  <td><?php  echo $row['CreationDate'];?></td> 
</tr>
<?php $cnt=$cnt+1;} ?>
</table>

<p align="center">                            
 <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Ajouter un Historique Médical</button></p>  

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un Historique Médical</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <table class="table table-bordered table-hover data-tables">

                                                 <form method="post" name="submit">

      <tr>
    <th>Pression Artérielle :</th>
    <td>
    <input name="bp" placeholder="Ex: 12/8" class="form-control wd-450" required="true"></td>
  </tr>                          
     <tr>
    <th>Glycémie :</th>
    <td>
    <input name="bs" placeholder="Ex: 0.95 g/L" class="form-control wd-450" required="true"></td>
  </tr> 
  <tr>
    <th>Poids :</th>
    <td>
    <input name="weight" placeholder="En kg" class="form-control wd-450" required="true"></td>
  </tr>
  <tr>
    <th>Température Corporelle :</th>
    <td>
    <input name="temp" placeholder="En °C" class="form-control wd-450" required="true"></td>
  </tr>
                         
     <tr>
    <th>Ordonnance / Prescription :</th>
    <td>
    <textarea name="pres" placeholder="Détails du traitement ou recommandations" rows="12" cols="14" class="form-control wd-450" required="true"></textarea></td>
  </tr>  
   
</table>
</div>
<div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
 <button type="submit" name="submit" class="btn btn-primary">Soumettre</button>
  
  </form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
      <!-- start: FOOTER -->
  <?php include('include/footer.php');?>
      <!-- end: FOOTER -->
    
      <!-- start: SETTINGS -->
  <?php include('include/setting.php');?>
      
      <!-- end: SETTINGS -->
    </div>
    <!-- start: MAIN JAVASCRIPTS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/modernizr/modernizr.js"></script>
    <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vendor/switchery/switchery.min.js"></script>
    <!-- end: MAIN JAVASCRIPTS -->
    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
    <script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="vendor/autosize/autosize.min.js"></script>
    <script src="vendor/selectFx/classie.js"></script>
    <script src="vendor/selectFx/selectFx.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <!-- start: CLIP-TWO JAVASCRIPTS -->
    <script src="assets/js/main.js"></script>
    <!-- start: JavaScript Event Handlers for this page -->
    <script src="assets/js/form-elements.js"></script>
    <script>
      jQuery(document).ready(function() {
        Main.init();
        FormElements.init();
      });
    </script>
    <!-- end: JavaScript Event Handlers for this page -->
    <!-- end: CLIP-TWO JAVASCRIPTS -->
  </body>
</html>
<?php } ?>