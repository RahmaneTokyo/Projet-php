<?php

    require_once('./data/connexiondb.php');

    if (isset($_POST['submit'])) {

        $score= 0;
        $target= "./public/image/".basename($_FILES['image']['name']);
        $images= $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        $pdoStat = $pdo->prepare("INSERT INTO utilisateur (login, pwd, nom, prenom, profil, score, image) VALUES (?,?,?,?,?,?,?)");
        $insert = $pdoStat -> execute(array($_POST['login'], $_POST['pwd'],strtoupper($_POST['lastname']), ucfirst($_POST['firstname']), 'joueur', $score, $images));
        $result = $pdoStat->fetch(PDO::FETCH_ASSOC);

        if($insert)  {
                header("location: index.php");
        }else {
            $message = "Echec de l'enregistrement. Le login existe déja !";
        }
    }

?>

<div class="row zone-connexion">
    <div class="container-fluid col-md-6 zone-texte">
        <div class="le_plaisir_de_jouer"> Le Plaisir de Jouer </div>
        <div class="bienvenu"> Bienvenue sur la plateforme d'inscription.<br>Creez un compte pour jouer </div>
        <div class="pt-2 inscription"> Si vous possedez déjà un compte<br> <a href="index.php"> Connectez-vous </a> </div>
        <div class="erreur">
            <?php
                if(isset($message)) {
                    echo $message;
                }
            ?>
        </div>
    </div>
    <div class="container col-xs-12 col-sm-12 col-md-6 zone-form">
        <img id="output" class="avatar">
        <form class="container form" id="form" method="post" enctype="multipart/form-data">
            <div class="form-group form-controller">
                <input type="text" name="firstname" id="firstname" placeholder="First Name">
                <small id="firstname_error"></small>
            </div>
            <div class="form-group form-controller">
                <input type="text" name="lastname" id="lastname" placeholder="Last Name">
                <small id="lastname_error"></small>
            </div>
            <div class="form-group form-controller">
                <input type="text" name="login" id="login" placeholder="Login">
                <small id="login_error"></small>
            </div>
            <div class="form-group form-controller">
                <input type="password" name="pwd" id="pwd" placeholder="Password">
                <small id="pwd_error"></small>
            </div>
            <div class="form-group form-controller">
                <input type="password" name="confirm" id="confirm" placeholder="Confirm Password">
                <small id="confirm_error"></small>
            </div>
            <div class="creer">
                <div class="fichier">
                    <label for="file" class="label-file">Choisir un fichier</label>
                    <input type="file" id="file" class="choisir" name="image" accept="image/*" onchange="loadFile(event)">
                </div>
                <button name="submit">Creer compte</button>
            </div>
        </form>
    </div>
</div>

<script src="./traitement/validation.js" ></script>