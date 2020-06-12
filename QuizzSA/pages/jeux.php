<?php

    if(!isset($_SESSION['login'])){
        header("Location: index.php");
        exit;
    }

?>

<style>
    a:link { color: black; }
a:visited { color: black; }
</style>

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
        </div>
        <div class="container d-flex align-items-center justify-content-center zone-deconnexion">
            <a class="d-flex align-items-center justify-content-center" href="logout.php">Deconnexion</a>
        </div>
        <div class="col-md-4 ">
        <a href="#">Link 1</a>
<a href="#">Link 2</a>
        </div>
        <div class="col-md-4 zone-joueur"></div>
    </div>    
</div>
        
<script>
    $(document).ready(function(){
        $('a').click(function(){
            $('a').css('color', 'black');
            $(this).css('color', 'blue');
        });
    });
</script>
