<div class="row zone-connexion">
    <div class="col-xs-12 col-sm-12 col-md-6 zone-texte">
        <div class="container le_plaisir_de_jouer"> Le Plaisir de Jouer </div>
        <div class="container bienvenu"> Bienvenue sur la plateforme de quizz<br>SA. Veuillez vous connecter pour jouer </div>
        <div class="container inscription"> Si vous possedez deja un compte <br> <a href="index.php"> Connectez-vous </a> </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 zone-form">
        <img id="output" class="avatar">
        <form class="form" id="form" method="post">
            <div class="form-controller">
                <input type="text" name="prenom" id="prenom" placeholder="First Name">
                <small>Validation Error</small>
            </div>
            <div class="form-controller">
                <input type="text" name="nom" id="nom" placeholder="Last Name">
                <small>Validation Error</small>
            </div>
            <div class="form-controller">
                <input type="text" name="login" id="login" placeholder="Login">
                <small>Validation Error</small>
            </div>
            <div class="form-controller">
                <input type="text" name="pwd" id="pwd" placeholder="Password">
                <small>Validation Error</small>
            </div>
            <div class="form-controller">
                <input type="text" name="confirm" id="confirm" placeholder="Confirm Password">
                <small>Validation Error</small>
            </div>
            <div class="creer">
                <div class="fichier">
                    <label for="file" class="label-file">Choisir un fichier</label>
                    <input id="file" class="choisir" type="file" name="image" accept="image/*" onchange="loadFile(event)">
                </div>
                <button>Creer compte</button>
            </div>
        </form>
    </div>
</div>