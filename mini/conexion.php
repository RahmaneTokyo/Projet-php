<?php
    session_start();
    $js = file_get_contents("session.json");
    $js = json_decode($js,true);
    $message = "";
    $error = "";
    if (isset($_POST['connexion'])) {
        $login= $_POST['login'];
        $password= $_POST['password'];
        if (empty($login) && empty($password)){
            $message.='Veuillez entrer votre login et votre mot de passe';

        }
        elseif (empty($login)){
            $has_error=true;
            $message.='Veuillez entrer votre login';

        }
        elseif (empty($password)){

            $message.='Veuillez entrer votre mot de passe';

        }else{
            foreach($js as $value){
                if ($login== $value['login'] && $password== $value['password']){
                    $_SESSION['prenom']= $value['prenom'];
                    $_SESSION['nom']= $value['nom'];
                    $_SESSION['avatar']= $value['avatar'];
                    if ($value['role'] == "admin"){
                        header("Location: admin.php");
                    }else{
                        header("Location: admin.php");
                    }

                }elseif ($login == $value['login'] && $password != $value['password']){
                    $error='Mot de passe incorrect';
                }
                elseif ($login != $value['login'] && $password == $value['password']){
                    $error='Login incorrect';
                }elseif($login != $value['login'] && $password != $value['password']){
                    $error='Login et Mot de passe incorrecte ';
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="sample.css">
        <title>Connexion</title>
    </head>
    <body>
        <div id="cadre">
            <div class="tete">
                <div class="logo"> <img src="Images/logo.jpeg"> </div>
                <div class="texte">Le plaisir de jouer</div>
            </div>
            <div class="fond">
                <div class="connexion">
                    <div class="form">
                        <div class="text">Login Form</div>
                    </div>
                    <form method="post" action="">
                        <span> <?= $message ?> </span>
                        <span style="color: red"><?= $error?></span>
                        <div class="log">
                            <div class="login"> <input type="text" name="login" autocomplete="off" placeholder="Login"
                            value="<?php if(isset($login)) { echo $login; } ?>"> </div>
                            <div class="icone"> <img src="Images/icônes/ic-login.png"> </div>
                        </div>
                        <div class="log">
                            <div class="login"> <input type="password" name="password" placeholder="Password"
                            value="<?php if(isset($password)) { echo $password; } ?>"> </div>
                            <div class="icone"> <img src="Images/icônes/ic-password.png"> </div>
                        </div>
                        <button name="connexion">Connexion</button>
                        <div class="inscription"> <a href="inscription.php"> S'inscrire pour jouer ? </a> </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
