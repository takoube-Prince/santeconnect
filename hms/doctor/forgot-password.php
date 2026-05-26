<?php
session_start();
include("include/config.php");
error_reporting(0);

// Vérification des détails pour réinitialiser le mot de passe
if(isset($_POST['submit']))
{
    $contactno = mysqli_real_escape_string($con, $_POST['contactno']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    
    $query = mysqli_query($con, "select id from doctors where contactno='$contactno' and docEmail='$email'");
    $row = mysqli_num_rows($query);
    
    if($row > 0)
    {
        $_SESSION['cnumber'] = $contactno;
        $_SESSION['email'] = $email;
        header('location:reset-password.php');
        exit();
    } else {
        echo "<script>alert('Détails invalides. Veuillez réessayer avec des informations correctes.');</script>";
        echo "<script>window.location.href ='forgot-password.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Récupération de mot de passe</title>
        
        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
        <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
        <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
        <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/plugins.css">
        <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
    </head>
    <body class="login">
        <div class="row">
            <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                <div class="logo margin-top-30">
                    <a href="../../index.php"><h2> SC | Récupération Mot de Passe</h2></a>
                </div>

                <div class="box-login">
                    <form class="form-login" method="post">
                        <fieldset>
                            <legend>
                                Récupération du mot de passe Médecin
                            </legend>
                            <p>
                                Veuillez saisir votre numéro de contact et votre email pour réinitialiser votre mot de passe.<br />
                            </p>

                            <div class="form-group form-actions">
                                <span class="input-icon">
                                    <input type="text" class="form-control" name="contactno" placeholder="Numéro de contact enregistré" required>
                                    <i class="fa fa-phone"></i>
                                </span>
                            </div>

                            <div class="form-group">
                                <span class="input-icon">
                                    <input type="email" class="form-control" name="email" placeholder="Email enregistré" required>
                                    <i class="fa fa-envelope"></i> 
                                </span>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary pull-right" name="submit">
                                    Réinitialiser <i class="fa fa-arrow-circle-right"></i>
                                </button>
                            </div>
                            
                            <div class="new-account">
                                Vous avez déjà un compte ? 
                                <a href="index.php">
                                    Se connecter
                                </a>
                            </div>
                        </fieldset>
                    </form>

                    <div class="copyright">
                        <span class="text-bold text-uppercase"> Santé Connect - Système de Gestion Hospitalière</span>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="vendor/modernizr/modernizr.js"></script>
        <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
        <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="vendor/switchery/switchery.min.js"></script>
        <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/login.js"></script>
        <script>
            jQuery(document).ready(function() {
                Main.init();
                Login.init();
            });
        </script>
    </body>
</html>