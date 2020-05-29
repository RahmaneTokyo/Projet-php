<?php
    /* if (isset($_POST['submit'])) {
        // Ouverture d'une connexion à la base de données QuizzSA

        $objetPDO = new PDO ('mysql:host=localhost;dbname=quizzsa','root','');

        // Requete d'insertion

        $pdoStat = $objetPDO->prepare('INSERT INTO utilisateur VALUES ( :login, :pwd, :nom, :prenom, :profil)');

        // Associer chaque marqueur à une valeur

        $pdoStat->bindValue(':nom', strtoupper($_POST['lastname']), PDO::PARAM_STR);
        $pdoStat->bindValue(':prenom', ucfirst($_POST['firstname']), PDO::PARAM_STR);
        $pdoStat->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
        $pdoStat->bindValue(':pwd', $_POST['pwd'], PDO::PARAM_STR);
        $pdoStat->bindValue(':profil', 'joueur', PDO::PARAM_STR);

        // Execution de la requête préparée

        $insert = $pdoStat->execute();

        if ($insert) {
            $message = 'Inscription du joueur réussi';
        }else {
            $message = 'Echec réessayez';
        }
    }
    
    var_dump($_POST); */
    ?>

<div class="row zone-connexion">
    <div class="col-xs-12 col-sm-12 col-md-6 zone-texte">
        <div class="container le_plaisir_de_jouer"> Le Plaisir de Jouer </div>
        <div class="container bienvenu"> Bienvenue sur la plateforme de quizz<br>SA. Veuillez vous connecter pour jouer </div>
        <div class="container inscription"> Si vous possedez deja un compte <br> <a href="index.php"> Connectez-vous </a> </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 zone-form">
        <div class="container">
            <img id="output" class="avatar">
        </div>
        <form class="form" id="form" method="post">
            <div class="form-group formerr">
                <input type="text" name="firstname" id="firstname" placeholder="First Name">
                <small id="firstname_error"></small>
            </div>
            <div class="form-group">
                <input type="text" name="lastname" id="lastname" placeholder="Last Name">
                <small id="lastname_error"></small>
            </div>
            <div class="form-group">
                <input type="text" name="login" id="login" placeholder="Login">
                <small id="login_error"></small>
            </div>
            <div class="form-group">
                <input type="password" name="pwd" id="pwd" placeholder="Password">
                <small id="pwd_error"></small>
            </div>
            <div class="form-group">
                <input type="password" name="confirm" id="confirm" placeholder="Confirm Password">
                <small id="confirm_error"></small>
            </div>
            <div class="creer">
                <div class="fichier">
                    <label for="file" class="label-file">Choisir un fichier</label>
                    <input id="file" class="choisir" type="file" name="image" accept="image/*" onchange="loadFile(event)">
                </div>
                <button type="submit" name="submit">Creer compte</button>
            </div>
        </form>
    </div>
</div>

<script>

    // Hiding error message

    $("#firstname_error").hide();
    $("#lastname_error").hide();
    $("#login_error").hide();
    $("#pwd_error").hide();
    $("#confirm_error").hide();

    var error_firstname = false;
    var error_lastname = false;
    var error_login = false;
    var error_pwd = false;
    var error_confirm = false;

    // Functions

    function check_firstname() {
        var firstname_length = $("#firstname").val().length;
        if(firstname_length < 1) {
            $("#firstname_error").html("This field is required!");
            $("#firstname_error").show();
            error_firstname = true;
        }else {
            $("#firstname_error").hide();
        }
    }
    function check_lastname() {
        var lastname_length = $("#lastname").val().length;
        if(lastname_length < 1) {
            $("#lastname_error").html("This field is required!");
            $("#lastname_error").show();
            error_lastname = true;
        }else {
            $("#lastname_error").hide();
        }
    }
    function check_login() {
        var login_length = $("#login").val().length;
        if(login_length < 1) {
            $("#login_error").html("This field is required!");
            $("#login_error").show();
            error_login = true;
        }else {
            $("#login_error").hide();
        }
    }

    function check_pwd() {
        var pwd_length = $("#pwd").val().length;
        if(pwd_length < 1) {
            $("#pwd_error").html("This field is required!");
            $("#pwd_error").show();
            error_pwd = true;
        }else {
            $("#pwd_error").hide();
        }
    }
    function check_confirm() {
        var pwd = $("#pwd").val();
        var confirm = $("#confirm").val();

        if(pwd != confirm) {
            $("#confirm_error").html("Password doesn't match!");
            $("#confirm_error").show();
            error_confirm = true;
        }else {
            $("#confirm_error").hide();
        }
    }

    // Events

    $("#firstname").focusout(function() {
        check_firstname();
    });
    $("#lastname").focusout(function() {
        check_lastname();
    });
    $("#login").focusout(function() {
        check_login();
    });
    $("#pwd").focusout(function() {
        check_pwd();
    });
    $("#confirm").focusout(function() {
        check_confirm();
    });

</script>