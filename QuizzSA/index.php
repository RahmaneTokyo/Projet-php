<!-- Partie PHP Partie PHP Partie PHP Partie PHP Partie PHP Partie PHP Partie PHP Partie PHP Partie PHP -->

<?php
    session_start();
?>

<!-- Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="public/CSS/bootstrap.min.css"> -->
        <link rel="stylesheet" href="public/CSS/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Kurale&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Kurale&family=Oswald:wght@500&display=swap" rel="stylesheet">
        <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="traitement/jquery-3.5.1.js"></script>
    </head>
    <body class="d-flex align-items-center justify-content-center">
        <?php

            if(isset($_GET['lien'])){
                switch ($_GET['lien']) {
                    case "admin":
                        require_once('pages/admin.php');
                    break;
                    case "jeux":
                        require_once('pages/jeux.php');
                    break;
                    case "inscription":
                        require_once('./pages/inscription.php');
                    break;
                    default;
                }
            }else {
                require_once ("./pages/connexion.php");
            }
        ?>
    </body>
</html>

