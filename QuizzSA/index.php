<!-- Partie PHP Partie PHP Partie PHP Partie PHP Partie PHP Partie PHP Partie PHP Partie PHP Partie PHP -->

<?php
    session_start();
?>

<!-- Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initiale-scale=1">
        <link rel="stylesheet" href="public/CSS/bootstrap.min.css">
        <link rel="stylesheet" href="public/CSS/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Kurale&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Kurale&family=Oswald:wght@500&display=swap" rel="stylesheet">
        <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>
    </head>
    <body class="d-flex align-items-center justify-content-center">
        <?php
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
    </body>
</html>