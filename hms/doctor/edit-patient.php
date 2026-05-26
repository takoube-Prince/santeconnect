<?php
session_start();
error_reporting(0);
include('include/config.php');

if(strlen($_SESSION['id'])==0) {
    header('location:logout.php');
} else {
    if(isset($_POST['submit'])) { 
        $eid = intval($_GET['editid']);
        $patname = mysqli_real_escape_string($con, $_POST['patname']);
        $patcontact = mysqli_real_escape_string($con, $_POST['patcontact']);
        $patemail = mysqli_real_escape_string($con, $_POST['patemail']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $pataddress = mysqli_real_escape_string($con, $_POST['pataddress']);
        $patage = mysqli_real_escape_string($con, $_POST['patage']);
        $medhis = mysqli_real_escape_string($con, $_POST['medhis']);
        
        $sql = mysqli_query($con, "UPDATE tblpatient SET PatientName='$patname', PatientContno='$patcontact', PatientEmail='$patemail', PatientGender='$gender', PatientAdd='$pataddress', PatientAge='$patage', PatientMedhis='$medhis', UpdationDate=NOW() WHERE ID='$eid'");
        
        if($sql) {
            echo "<script>alert('Informations du patient mises à jour avec succès.');</script>";
            echo "<script>window.location.href='manage-patient.php'</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Médecin | Modifier Patient</title>
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
                <div class="main-content">
                    <div class="wrap-content container" id="container">
                        <section id="page-title">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h1 class="mainTitle">Patient | Modifier les informations</h1>
                                </div>
                                <ol class="breadcrumb">
                                    <li><span>Patient</span></li>
                                    <li class="active"><span>Modifier le patient</span></li>
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
                                                    <h5 class="panel-title">Modifier les détails du patient</h5>
                                                </div>
                                                <div class="panel-body">
                                                    <form role="form" method="post">
                                                        <?php
                                                        $eid = intval($_GET['editid']);
                                                        $ret = mysqli_query($con, "SELECT * FROM tblpatient WHERE ID='$eid'");
                                                        while ($row = mysqli_fetch_array($ret)) {
                                                        ?>
                                                        <div class="form-group">
                                                            <label>Nom du patient</label>
                                                            <input type="text" name="patname" class="form-control" value="<?php echo htmlentities($row['PatientName']);?>" required="true">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Numéro de contact</label>
                                                            <input type="text" name="patcontact" class="form-control" value="<?php echo htmlentities($row['PatientContno']);?>" required="true" maxlength="10" pattern="[0-9]+">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="email" name="patemail" class="form-control" value="<?php echo htmlentities($row['PatientEmail']);?>" readonly='true'>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Genre : </label>
                                                            <?php if($row['PatientGender']=="Female"){ ?>
                                                            <input type="radio" name="gender" value="Female" checked="true">Femme
                                                            <input type="radio" name="gender" value="Male">Homme
                                                            <?php } else { ?>
                                                            <input type="radio" name="gender" value="Male" checked="true">Homme
                                                            <input type="radio" name="gender" value="Female">Femme
                                                            <?php } ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Adresse du patient</label>
                                                            <textarea name="pataddress" class="form-control" required="true"><?php echo htmlentities($row['PatientAdd']);?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Âge</label>
                                                            <input type="text" name="patage" class="form-control" value="<?php echo htmlentities($row['PatientAge']);?>" required="true">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Antécédents médicaux</label>
                                                            <textarea name="medhis" class="form-control" required="true"><?php echo htmlentities($row['PatientMedhis']);?></textarea>
                                                        </div>  
                                                        <div class="form-group">
                                                            <label>Date de création</label>
                                                            <input type="text" class="form-control" value="<?php echo htmlentities($row['CreationDate']);?>" readonly='true'>
                                                        </div>
                                                        <?php } ?>
                                                        <button type="submit" name="submit" class="btn btn-o btn-primary">Mettre à jour</button>
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
        <script src="vendor/modernizr/modernizr.js"></script>
        <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
        <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="vendor/switchery/switchery.min.js"></script>
        <script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
        <script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="vendor/autosize/autosize.min.js"></script>
        <script src="vendor/selectFx/classie.js"></script>
        <script src="vendor/selectFx/selectFx.js"></script>
        <script src="vendor/select2/select2.min.js"></script>
        <script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
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