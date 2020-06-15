<?php

    if(!isset($_SESSION['login'])){
        header("Location: index.php");
        exit;
    }

?>

<div class="container zone-connexion">
    <div class="row">
        <div class="col-md-4 zone-joueur">
            <div class="joueur">
                <div class="container image-joueur"> <img src="./public/image/<?= $_SESSION['image'] ?>" alt="" srcset=""> </div>
                <div class=" d-flex justify-content-center  zone-nom"> <?= $_SESSION['firstname'] ?> </div>
                <div class=" d-flex justify-content-center  zone-nom"> <?= $_SESSION['lastname'] ?> </div>
            </div>
            <div class="container d-flex align-items-center justify-content-center zone-jeu-texte">
                Bienvenue sur la plateforme de jeu de Quizz<br>Jouez et testez votre niveau
            </div>
            <div class="container d-flex align-items-center justify-content-center zone-deconnexion">
                <a class="d-flex align-items-center justify-content-center" href="logout.php">Deconnexion</a>
            </div>
        </div>
        <div class="col-md-4 zone-quizz"></div>
        <div class="col-md-4 zone-score">
            <div class="topscore">
                <div class="zone-topscore d-flex align-items-center justify-content-center">Top scores</div>
                <div id="topbody" class="champ-topscore"></div>
            </div>
            <div class="monscore">
                <div class="zone-monscore d-flex align-items-center justify-content-center">Mon meilleur score</div>
                <div class="container d-flex align-items-center justify-content-center champ-monscore">
                    <?= $_SESSION["score"]; ?> Pts
                </div>
            </div>
        </div>
    </div>    
</div>

<script>
    $(document).ready(function() {
        $('#topbody').load("./data/topscore.php");
    });
</script>