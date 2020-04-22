<?php
    if (isset($_POST['submit'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $users = getData();
        foreach ($users as $value) {
            if ($value["login"] === $login && $value["password"] === $password) {
                $_SESSION['profile'] = $value['profile'];
                $_SESSION['prenom'] = $value['prenom'];
                $_SESSION['nom'] = $value['nom'];
                $_SESSION['avatar'] = $value['avatar'];
                if ($value["profile"] === "admin") {
                header ("location: index.php?lien=admin");
                }else {
                    header ("location: index.php?lien=jeux");
                }
            }
        }
        $message = "Login ou mot de passe incorrecte !";
    }
?>

<div class="connexion">
    <div class="headerr">
        <div class="title">Login Form</div>
    </div>
    <form method="post" action="" id="form-connexion">
        <span><?php if (isset($message)) { echo $message; } ?></span>
        <div class="input-form">
            <div class="icone1"></div>
            <input type="text" class="control" name="login" id="login" error="error-1" autocomplete="off" placeholder="Login">
            <div class="error" id="error-1"></div>
        </div>
        <div class="input-form">
            <div class="icone2"></div>
            <input type="password" class="control" name="password" id="password" error="error-2" placeholder="Password">
            <div class="error" id="error-2"></div>
        </div>
        <button class="conex" type="submit" id="connexion" name="submit">Connexion</button>
        <div class="inscription"> <a href="index.php?lien=inscription"> S'inscrire pour jouer ? </a> </div>
    </form>
</div>

<script>
    document.getElementById("form-connexion").addEventListener("submit",function(e) {

        const inputs = document.getElementsByTagName("input");
        var error = false
        for (input of inputs) {
            if (input.hasAttribute("error")) {
                var idDivError = input.getAttribute("error")
                if(!input.value) {
                    document.getElementById(idDivError).innerText = "Champ obligatoire !"
                    error = true
                }
            }
        }
        if (error) {
            e.preventDefault();
            return false
        }
    })

    const inputs = document.getElementsByTagName("input");
    for (input of inputs) {
        input.addEventListener("keyup",function(e) {
            if (e.target.hasAttribute("error")) {
                var idDivError = e.target.getAttribute("error")
                document.getElementById(idDivError).innerText = ""
            }
        })
    }
</script>