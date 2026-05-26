<?php
session_start();
//error_reporting(0);
include("include/config.php");

// Code pour la mise à jour du mot de passe
if(isset($_POST['change']))
{
    $cno=$_SESSION['cnumber'];
    $email=$_SESSION['email'];
    $newpassword=md5($_POST['password']);
    
    // Note : Cette requête cible la table 'doctors'. Si c'est bien pour les patients, modifiez 'doctors' par votre table patient (ex: 'users' ou 'tblpatient')
    $query=mysqli_query($con,"update doctors set password='$newpassword' where contactno='$cno' and docEmail='$email'");
    if ($query) {
        echo "<script>alert('Le mot de passe a été mis à jour avec succès.');</script>";
        echo "<script>window.location.href ='index.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Réinitialisation du mot de passe</title>
        
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

        <script type="text/javascript">
        function valid()
        {
            if(document.passwordreset.password.value != document.passwordreset.password_again.value)
            {
                alert("Le mot de passe et le champ de confirmation ne correspondent pas !");
                document.passwordreset.password_again.focus();
                return false;
            }
            return true;
        }
        </script>
    </head>
    <body class="login">
        <div class="row">
            <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                <div class="logo margin-top-30">
                    <a href="../index.php"><h2> SC | Réinitialisation Mot de Passe Patient</h2></a>
                </div>

                <div class="box-login">
                    <form class="form-login" name="passwordreset" method="post" onSubmit="return valid();">
                        <fieldset>
                            <legend>
                                Réinitialisation du mot de passe Patient
                            </legend>
                            <p>
                                Veuillez saisir votre nouveau mot de passe.<br />
                                <span style="color:red;"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg']="";?></span>
                            </p>

                            <div class="form-group">
                                <span class="input-icon">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Nouveau mot de passe" required>
                                    <i class="fa fa-lock"></i> 
                                </span>
                            </div>
        
                            <div class="form-group">
                                <span class="input-icon">
                                    <input type="password" class="form-control" id="password_again" name="password_again" placeholder="Confirmez le mot de passe" required>
                                    <i class="fa fa-lock"></i> 
                                </span>
                            </div>
                                        
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary pull-right" name="change">
                                    Modifier <i class="fa fa-arrow-circle-right"></i>
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
                        <span class="text-bold text-uppercase">Santé Connect - Système de Gestion Hospitalière</span>
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