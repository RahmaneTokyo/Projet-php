<?php
    if(!isset($_SESSION['profile'])){
        header("Location: index.php");
        exit;
    }
?>

<div class="cadre">
    <div class="enteter">
        <div class="joueurr">
            <div class="images"> <img src="<?= $_SESSION['avatar']?>" alt=""> </div>
            <div class="prenomm"> <?= $_SESSION['prenom'] ?> </div>
            <div class="nomm"> <?= $_SESSION['nom']?> </div> 
        </div>
        <div class="titler"> BIENVENUE SUR LA PLATEFORME DE JEU QUIZZ<br>JOUEZ ET TESTEZ VOTRE NIVEAU DE CULTURE GÉNÉRALE </div>
        <a href="deco.php"><button type="submit" class="buttonn">Déconnexion</button></a>
    </div>
    <div class="fonds">
        <div class="question"></div>
        <div class="score">
            <a class="top" href="index.php?lien=jeux&bloc=topscore"> <div class="topp"> Top scores </div> </a>
            <a class="top" href="index.php?lien=jeux&bloc=monscore"> <div class="tope"> Mon meilleur score </div> </a>
            <div class="liste">
                <?php
                    if (isset($_GET['bloc'])) {
                        if ($_GET['bloc'] == "topscore") {
                            include ("topscore.php");
                        }elseif ($_GET['bloc'] == "monscore") {
                            include ("monscore.php");
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>