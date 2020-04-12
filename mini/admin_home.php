<?php
    session_start();
    $avatar= $_SESSION['avatar'];
    if (!isset($_SESSION['prenom'])){
        header('Location: conexion.php');
        exit;
    }
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <link rel="stylesheet" href="sample.css">
        <meta charset="UTF-8">
        <title>Admin</title>
    </head>
    <body>
        <div id="cadre">
            <div class="tete">
                <div class="logo"> <img src="Images/logo.jpeg"> </div>
                <div class="texte">Le plaisir de jouer</div>
            </div>
            <div class="fond">
                <div class="cadre">
                    <div class="entete">
                        <div class="imgnom">
                            <div class="image"> <img src="<?=$avatar?>" alt=""> </div>
                            <div class="nom"> <?=$_SESSION['prenom']?> <?=$_SESSION['nom']?> </div>
                        </div>
                        <div class="textee"> CREEZ VOTRE PROPRE QUIZZ</div>
                        <a href="deconexion.php"><button type="submit">Déconnexion</button></a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>