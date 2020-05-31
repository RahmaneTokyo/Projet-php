<?php

    if(!isset($_SESSION['profil'])){
        header("Location: index.php");
        exit;
    }
?>
<div class="container zone-connexion">
    <div class="row">
    <div class="container-fluid zone-onglet">
        <div class="form-group onglet">Liste Question</div>
        <div class="form-group onglet">Creer Admin</div>
        <div class="form-group onglet">Liste Joueur</div>
        <div class="form-group onglet">Creer Question</div>
    </div>
        <div class="col-md-6 zone-creer">
            <div class="container zone-entete">Creez et Parametrer votre Quizz</div>
            <div class="container zone-avatar"></div>
            <div class="container zone-deco"><a href="logout.php">Deconnexion</a></div>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-center zone-admin">Bonjour</div>

    </div>
</div>