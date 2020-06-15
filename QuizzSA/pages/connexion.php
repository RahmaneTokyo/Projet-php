<?php

    require_once('./data/connexiondb.php');
    /* $host = "mysql-tokyosan.alwaysdata.net";
    $username ="tokyosan";
    $password = "rahmane961";
    $database = "tokyosan_quizzsa";
    $message  = ""; */

    try {

        /* $connect = new PDO("mysql:host=$host; dbname=$database",$username,$password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); */

        if(isset($_POST["submit"])) {

            if(!empty($_POST["login"]) && !empty($_POST["pwd"])) {

                $query = "SELECT * FROM utilisateur WHERE login = :login AND pwd = :pwd";
                $statement = $pdo->prepare($query);

                $statement->execute(

                    array(
                    'login' => $_POST["login"],
                    'pwd' => $_POST["pwd"]
                    )

                );
        
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                if ($result['profil'] == 'admin') {
                    header("location:index.php?lien=admin");
                }elseif($result['profil'] == 'joueur') {
                    header("location:index.php?lien=jeux");
                }

                $count = $statement->rowCount();
                if($count > 0) {

                    $_SESSION["login"] = $_POST["login"];
                    $_SESSION["firstname"] = $result["prenom"];
                    $_SESSION["lastname"] = $result["nom"];
                    $_SESSION["profil"] = $result["profil"];
                    $_SESSION["image"] = $result["image"];
                    $_SESSION["score"] = $result["score"];

                }
                else {

                    $message = 'Username OR Password is wrong';

                }
            }
        }
    }

    catch (PDOException $error) {
        $message = $error->getMessage();
    }

?>

<!-- Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML Partie HTML -->

<div class="row zone-connexion">
    <div class="container-fluid col-md-6 azer">
        <div class="le_plaisir_de_jouer"> Le Plaisir de Jouer </div>
        <div class="bienvenu"> Bienvenue sur la plateforme de quizz<br>SA. Veuillez vous connecter pour jouer </div>
        <div class="pt-2 inscription"> Pas de compte ? <a href="index.php?lien=inscription"> Inscrivez-vous </a> </div>
    </div>
    <div class="container-fluid col-md-6 d-flex align-items-center zone-form">
        <form class="container form" id="form" method="post">
            <div class="container">
                    <?php
                    if(isset($message)){
                        echo '<small class="text-danger">'.$message.'</small>';
                    }
                ?>
            </div>
            <div class="form-group form-control">
                <span class="iconify" data-icon="ant-design:user-outlined" data-inline="false" style="color: #A44545;"></span>
                <input type="text" name="login" id="login" placeholder="Login">
                <small id="login_error"></small>
            </div>
            <div class="form-group form-control">
                <span class="iconify" data-icon="uil:padlock" data-inline="false" style="color: #A44545;"></span>
                <input type="password" name="pwd" id="pwd" placeholder="Password">
                <small id="pwd_error"></small>
            </div>
            <button name="submit" class="connect">Connectez-vous</button>
        </form>
    </div>
</div>

<script src="./traitement/validation.js"></script>