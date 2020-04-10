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
                        <div class="log">
                            <div class="login"> <input type="text" name="login" autocomplete="off" placeholder="Login"> </div>
                            <div class="icone"> <img src="Images/icônes/ic-login.png"> </div>
                        </div>
                        <div class="log">
                            <div class="login"> <input type="password" name="pass" placeholder="Password"> </div>
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
