<?php
    if(!isset($_SESSION['profile'])){
        header("Location: index.php");
        exit;
    }
?>


<div class="cadre">
    <div class="entete">
    <div class="title">CRÉER ET PARAMÉRTER VOS QUIZZ</div>
    <a href="deco.php"><button type="submit" class="button">Déconnexion</button></a>
    </div>
    <div class="menu">
        <div class="avatar">
            <div class="image"> <img src="<?= $_SESSION['avatar']?>" alt=""> </div>
            <div class="prenom"> <?= $_SESSION['prenom'] ?> </div>
            <div class="nom"> <?= $_SESSION['nom']?> </div>
        </div>
        <a href="index.php?lien=admin&block=ListeQuestions" class="onglet">
            <div class="texte">Liste Questions</div>
            <div class="icone"><img src="public/Icônes/ic-liste-active.png"></div>
        </a>
        <a href="index.php?lien=admin&block=CreerAdmin" class="onglet">
            <div class="texte">Créer Admin</div>
            <div class="icone"><img src="public/Icônes/ic-ajout.png"></div>
        </a>
        <a href="index.php?lien=admin&block=ListeJoueurs" class="onglet">
            <div class="texte">Liste joueurs</div>
            <div class="icone"><img src="public/Icônes/ic-liste.png"></div>
        </a>
        <a href="index.php?lien=admin&block=CreerQuestions" class="onglet">
            <div class="texte">Créer Questions</div>
            <div class="icone"><img src="public/Icônes/ic-ajout.png"></div>
        </a>
    </div>
    <div class="interface">
        <?php
            if (isset($_GET['block'])) {
                if ($_GET['block'] == "ListeQuestions") {
                    include ("listequestions.php");        
                }elseif ($_GET['block'] == "CreerAdmin") {
                    include ("creeradmin.php");
                }elseif($_GET['block'] == "ListeJoueurs") {
                    include ("listejoueurs.php");
                }elseif ($_GET['block'] == "CreerQuestions"){
                    include ("creerquestions.php");
                }
            }
        ?>
    </div>
</div>
