Joueur
<?php

    if(!isset($_SESSION['profile'])){
        header("Location: index.php");
        exit;
    }

    echo $_SESSION['prenom']." ";
    echo $_SESSION['nom']." ";

?>
<br>
<a href="deco.php">Deconnexion</a>