<?php
session_start();
if (isset($_SESSION['role'])){
    if ($_SESSION['role']== 'admin'){
        header("Location: pages/admin.php");
        exit;
    }else{
        header("Location: pages/jeux.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./public/css/quizz.css">
        <title>QUIZZ</title>
    </head>
    <body>
        <div class="header">
            <div class="logo"></div>
            <div class="header-text">Le Plaisir de jouer</div>
        </div>
        <div class="content">
            <?php
                require_once ("./traitement/fonction.php");

                if (isset($_GET['lien'])) {
                    switch($_GET['lien']) {
                        case  "admin":
                            require_once ("./pages/admin.php");
                        break;
                        case "jeux":
                            require_once ("./pages/jeux.php");
                        break;
                        case "inscription":
                            require_once ("./pages/inscription.php");
                        break;
                        default;
                    }
                }else {
                    if (isset($_GET['statut']) && $_GET['statut'] == "logout") {
                        deconnexion();    
                    }
                    require_once ("./pages/connexion.php");
                }
            ?>
        </div>
    </body>
</html>