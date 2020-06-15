<?php
    if(!isset($_SESSION['login'])){
        header("Location: index.php");
        exit;
    }

?>

<!-- Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML -->

        <div class="container zone-connexion">
            <div class="row">
                <div class="col-md-6 zone-creer">
                    <div class="container zone-entete">Creez et Parametrer votre Quizz</div>
                    <div class="container zone-user">
                        <div class="container zone-avatar"> <img src="./public/image/<?= $_SESSION['image']; ?>" alt="" srcset=""> </div>
                        <div class="container d-flex justify-content-center align-items-center zone-prenom"> <?= $_SESSION['firstname'] ?> </div>
                        <div class="container d-flex justify-content-center align-items-center zone-prenom"> <?= $_SESSION['lastname'] ?> </div>
                    </div>
                    <div class="container zone-deco"><a id="link" class="d-flex align-items-center justify-content-center" href="logout.php">Deconnexion</a></div>
                </div>
                <div id="content" class="col-md-6 mt-3 zone-inteface"></div>
            </div>
            <div class="zone-onglet">
                <div class="form-group onglet"><a href="#" id="listequestion" class="d-flex align-items-center justify-content-center" >Liste Questions</a></div>
                <div class="form-group onglet"><a href="#" id="creeradmin" class="d-flex align-items-center justify-content-center" >Creer Admin</a></div>
                <div class="form-group onglet"><a href="#" id="listejoueur" class="d-flex align-items-center justify-content-center" >Liste Joueurs</a></div>
                <div class="form-group onglet"><a href="#" id="listeadmin" class="d-flex align-items-center justify-content-center" >Liste Admins</a></div>
                <div class="form-group onglet"><a href="#" id="creerquestion" class="d-flex align-items-center justify-content-center" >Creer Question</a></div>
            </div>
        </div>

<script src="./traitement/validation.js"></script>