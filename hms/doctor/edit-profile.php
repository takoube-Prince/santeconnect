<?php
session_start();
error_reporting(0);
include('include/config.php');

if(strlen($_SESSION['id'])==0) {
    header('location:logout.php');
} else {
    if(isset($_POST['submit']))
    {
        $docspecialization = mysqli_real_escape_string($con, $_POST['Doctorspecialization']);
        $docname = mysqli_real_escape_string($con, $_POST['docname']);
        $docaddress = mysqli_real_escape_string($con, $_POST['clinicaddress']);
        $docfees = mysqli_real_escape_string($con, $_POST['docfees']);
        $doccontactno = mysqli_real_escape_string($con, $_POST['doccontact']);
        
        $sql = mysqli_query($con, "UPDATE doctors SET specilization='$docspecialization', doctorName='$docname', address='$docaddress', docFees='$docfees', contactno='$doccontactno', updationDate=NOW() WHERE id='".$_SESSION['id']."'");
        
        if($sql) {
            echo "<script>alert('Informations du médecin mises à jour avec succès.');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Médecin | Modifier le profil</title>
        
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
                                    <h1 class="mainTitle">Médecin | Modifier le profil</h1>
                                </div>
                                <ol class="breadcrumb">
                                    <li><span>Médecin</span></li>
                                    <li class="active"><span>Modifier le profil</span></li>
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
                                                    <h5 class="panel-title">Modifier mes informations</h5>
                                                </div>
                                                <div class="panel-body">
                                                    <?php 
                                                    $did = $_SESSION['dlogin'];
                                                    $sql = mysqli_query($con, "SELECT * FROM doctors WHERE docEmail='$did'");
                                                    while($data = mysqli_fetch_array($sql)) {
                                                    ?>
                                                    <h4>Profil de <?php echo htmlentities($data['doctorName']);?></h4>
                                                    <p><b>Date d'inscription : </b><?php echo htmlentities($data['creationDate']);?></p>
                                                    <?php if($data['updationDate']){?>
                                                    <p><b>Dernière mise à jour : </b><?php echo htmlentities($data['updationDate']);?></p>
                                                    <?php } ?>
                                                    <hr />
                                                    <form role="form" name="adddoc" method="post">
                                                        <div class="form-group">
                                                            <label for="DoctorSpecialization">Spécialisation</label>
                                                            <select name="Doctorspecialization" class="form-control" required="required">
                                                                <option value="<?php echo htmlentities($data['specilization']);?>"><?php echo htmlentities($data['specilization']);?></option>
                                                                <?php $ret = mysqli_query($con, "SELECT * FROM doctorspecilization");
                                                                while($row = mysqli_fetch_array($ret)) { ?>
                                                                <option value="<?php echo htmlentities($row['specilization']);?>"><?php echo htmlentities($row['specilization']);?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="doctorname">Nom du médecin</label>
                                                            <input type="text" name="docname" class="form-control" value="<?php echo htmlentities($data['doctorName']);?>" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="address">Adresse du cabinet</label>
                                                            <textarea name="clinicaddress" class="form-control"><?php echo htmlentities($data['address']);?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="fess">Honoraires de consultation</label>
                                                            <input type="text" name="docfees" class="form-control" required="required" value="<?php echo htmlentities($data['docFees']);?>" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="fess">Numéro de contact</label>
                                                            <input type="text" name="doccontact" class="form-control" required="required" value="<?php echo htmlentities($data['contactno']);?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="fess">Email (fixe)</label>
                                                            <input type="email" name="docemail" class="form-control" readonly="readonly" value="<?php echo htmlentities($data['docEmail']);?>">
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