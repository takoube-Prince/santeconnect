<?php
session_start();
error_reporting(0);
include('include/config.php');

if(strlen($_SESSION['id']) == 0) {
    header('location:logout.php');
} else {
    if(isset($_POST['submit'])) {
        $docid = $_SESSION['id'];
        $patname = mysqli_real_escape_string($con, $_POST['patname']);
        $patcontact = mysqli_real_escape_string($con, $_POST['patcontact']);
        $patemail = mysqli_real_escape_string($con, $_POST['patemail']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $pataddress = mysqli_real_escape_string($con, $_POST['pataddress']);
        $patage = mysqli_real_escape_string($con, $_POST['patage']);
        $medhis = mysqli_real_escape_string($con, $_POST['medhis']);

        $sql = mysqli_query($con, "INSERT INTO tblpatient(Docid, PatientName, PatientContno, PatientEmail, PatientGender, PatientAdd, PatientAge, PatientMedhis) 
                                   VALUES('$docid', '$patname', '$patcontact', '$patemail', '$gender', '$pataddress', '$patage', '$medhis')");
        
        if($sql) {
            echo "<script>alert('Informations du patient ajoutées avec succès');</script>";
            echo "<script>window.location.href ='manage-patient.php'</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Médecin | Ajouter un patient</title>
        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
        <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
        <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/plugins.css">
        <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
        
        <script>
            function userAvailability() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "check_availability.php",
                    data:'email='+$("#patemail").val(),
                    type: "POST",
                    success:function(data){
                        $("#user-availability-status1").html(data);
                        $("#loaderIcon").hide();
                    },
                    error:function (){}
                });
            }
        </script>
    </head>
    <body>
        <div id="app">      
            <?php include('include/sidebar.php');?>
            <div class="app-content">
                <?php include('include/header.php');?>
                <div class="main-content">
                    <div class="wrap-content container" id="container">
                        <section id="page-title">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h1 class="mainTitle">Patient | Ajouter un patient</h1>
                                </div>
                                <ol class="breadcrumb">
                                    <li><span>Patient</span></li>
                                    <li class="active"><span>Ajouter un patient</span></li>
                                </ol>
                            </div>
                        </section>
                        
                        <div class="container-fluid container-fullw bg-white">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row margin-top-30">
                                        <div class="col-lg-8 col-md-12">
                                            <div class="panel panel-white">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title">Ajouter un patient</h5>
                                                </div>
                                                <div class="panel-body">
                                                    <form role="form" method="post">
                                                        <div class="form-group">
                                                            <label>Nom complet</label>
                                                            <input type="text" name="patname" class="form-control" placeholder="Entrez le nom du patient" required="true">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Numéro de contact</label>
                                                            <input type="text" name="patcontact" class="form-control" placeholder="Entrez le numéro de téléphone" required="true" maxlength="10" pattern="[0-9]+">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="email" id="patemail" name="patemail" class="form-control" placeholder="Entrez l'adresse email" required="true" onBlur="userAvailability()">
                                                            <span id="user-availability-status1" style="font-size:12px;"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="block">Genre</label>
                                                            <div class="clip-radio radio-primary">
                                                                <input type="radio" id="rg-female" name="gender" value="female">
                                                                <label for="rg-female">Femme</label>
                                                                <input type="radio" id="rg-male" name="gender" value="male">
                                                                <label for="rg-male">Homme</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Adresse</label>
                                                            <textarea name="pataddress" class="form-control" placeholder="Entrez l'adresse" required="true"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Âge</label>
                                                            <input type="text" name="patage" class="form-control" placeholder="Entrez l'âge" required="true">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Antécédents médicaux</label>
                                                            <textarea name="medhis" class="form-control" placeholder="Antécédents (le cas échéant)" required="true"></textarea>
                                                        </div>  
                                                        <button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">Ajouter</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('include/footer.php');?>
            <?php include('include/setting.php');?>
        </div>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/form-elements.js"></script>
        <script>
            jQuery(document).ready(function() {
                Main.init();
                FormElements.init();
            });
        </script>
    </body>
</html>
<?php } ?>