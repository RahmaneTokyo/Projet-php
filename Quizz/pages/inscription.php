<?php
    if (isset($_POST['submit'])) {
        $prenom = ucfirst($_POST['prenom']);
        $nom = strtoupper($_POST['nom']);
        $login = $_POST['login'];
        $pwd = $_POST['password'];
        $confirm_pwd = $_POST['confirm'];

        //Image avatar
        $image = $_FILES["image"]["name"];
        $imagePath = 'Images/'.basename($image);
        $imageExtension = pathinfo($imagePath,PATHINFO_EXTENSION);
        $imageSize = $_FILES['image']['size'];

        validation_donnees($login,$pwd,$confirm_pwd,$prenom,$nom,$profil="joueur",$image,$imagePath,$imageExtension,$imageSize);

        header("location:index.php");
    }
?>


        <div class="fond">
            <div class="fond1">
                <div class="fond2">
                    <div class="fond3">
                        <div class="fond4">
                            <div class="formulaire">
                                <div class="inscrit">S'INSCRIRE</div>
                                <div class="petit"> Pour tester votre niveau de culture générale </div>
                                <form method="post" action="" id="form-connexion" enctype="multipart/form-data">
                                    <div class="label"> Prénom </div>
                                    <div class="eror" id="error-1"></div> 
                                    <div class="champ"> <input type="text" name="prenom" id="prenom" error="error-1" > </div>
                                    <div class="label"> Nom </div>
                                    <div class="eror" id="error-2"></div>
                                    <div class="champ"> <input type="text" name="nom" id="nom" error="error-2" > </div>
                                    <div class="label"> Login </div>
                                    <div class="eror" id="error-3"></div>
                                    <div class="champ"> <input type="text" name="login" id="login" error="error-3" > </div>
                                    <div class="label"> Password </div>
                                    <div class="eror" id="error-4"></div>
                                    <div class="champs"> <input type="password" name="password" id="password" error="error-4" placeholder="********"> </div>
                                    <div class="label"> Confirmer Password </div>
                                    <div class="eror" id="error-5"></div>
                                    <div class="champs"> <input type="password" name="confirm" id="confirm" error="error-5" placeholder="********"> </div>
                                    <div class="texteavatar">Avatar</div>
                                    <div class="fichier">
                                        <label for="file" class="label-file">Choisir un fichier</label> 
                                        <input id="file" class="choisir" type="file" name="image" accept="image/*" onchange="loadFile(event)">
                                    </div>
                                    <div class="creer"> <button type="submit" name="submit" id="connexion"> Créer compte </button> </div>
                                </form>
                            </div>
                            <img id="output" class="avataarr">
                            <div class="joueurr">Avatar du joueur</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script src="public/js/validation.js">
</script>

<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src)
    }
  };
</script>