<?php
session_start();
error_reporting(E_ALL); // Pour voir les erreurs si elles persistent
include('include/config.php');

if(strlen($_SESSION['id']) == 0) {
    header('location:logout.php');
    exit();
} else {
    // Gestion de l'annulation
    if(isset($_GET['cancel'])) {
        $id = intval($_GET['id']);
        mysqli_query($con, "UPDATE appointment SET doctorStatus='0' WHERE id ='$id'");
        $_SESSION['msg'] = "Rendez-vous annulé avec succès !!";
        header("location:appointment-history.php"); // Redirection pour éviter le rechargement du GET
        exit();
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Médecin | Historique des rendez-vous</title>
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
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
                                <h1 class="mainTitle">Médecin | Historique des rendez-vous</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Médecin</span></li>
                                <li class="active"><span>Historique</span></li>
                            </ol>
                        </div>
                    </section>
                    
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != "") { ?>
                                    <p style="color:red;"><?php echo htmlentities($_SESSION['msg']);?></p>
                                    <?php $_SESSION['msg'] = ""; // Effacer le message après affichage ?>
                                <?php } ?>
                                
                                <table class="table table-hover" id="sample-table-1">
                                    <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th>Nom du patient</th>
                                            <th>Spécialisation</th>
                                            <th>Honoraires</th>
                                            <th>Date / Heure</th>
                                            <th>Date de création</th>
                                            <th>Statut</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $did = $_SESSION['id'];
                                        $sql = mysqli_query($con, "SELECT users.fullName as fname, appointment.* FROM appointment JOIN users ON users.id = appointment.userId WHERE appointment.doctorId='$did'");
                                        $cnt = 1;
                                        while($row = mysqli_fetch_array($sql)) {
                                        ?>
                                        <tr>
                                            <td class="center"><?php echo $cnt;?>.</td>
                                            <td><?php echo htmlentities($row['fname']);?></td>
                                            <td><?php echo htmlentities($row['doctorSpecialization']);?></td>
                                            <td><?php echo htmlentities($row['consultancyFees']);?></td>
                                            <td><?php echo htmlentities($row['appointmentDate'] . ' / ' . $row['appointmentTime']);?></td>
                                            <td><?php echo htmlentities($row['postingDate']);?></td>
                                            <td>
                                                <?php 
                                                if(($row['userStatus']==1) && ($row['doctorStatus']==1)) echo "Actif";
                                                elseif(($row['userStatus']==0) && ($row['doctorStatus']==1)) echo "Annulé par le patient";
                                                elseif(($row['userStatus']==1) && ($row['doctorStatus']==0)) echo "Annulé par vous";
                                                ?>
                                            </td>
                                            <td>
                                                <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1)) { ?>
                                                <a href="appointment-history.php?id=<?php echo $row['id']?>&cancel=update" onClick="return confirm('Êtes-vous sûr ?')" class="btn btn-danger btn-xs">Annuler</a>
                                                <?php } else { echo "Annulé"; } ?>
                                            </td>
                                        </tr>
                                        <?php $cnt++; } ?>
                                    </tbody>
                                </table>
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
    <script>
        jQuery(document).ready(function() {
            Main.init();
        });
    </script>
</body>
</html>
<?php } ?>