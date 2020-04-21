<?php
    if (isset($_POST['submit'])) {

        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $login = $_POST['login'];
        $pwd = $_POST['password'];
        $confirm_pwd = $_POST['confirm'];

        //Image avatar
        $image = $_FILES["image"]["name"];
        $imagePath = 'Images/'.basename($image);
        $imageExtension = pathinfo($imagePath,PATHINFO_EXTENSION);
        $imageSize = $_FILES['image']['size'];

        validation_donnees($login,$pwd,$confirm_pwd,$prenom,$nom,$profil="admin",$image,$imagePath,$imageExtension,$imageSize);


         //validation_donnees($_POST['login'],);

       /* if (isset($_FILES['photo'])) {
        $dossier = 'image/';
        $fichier = basename($_FILES['photo']['name']);
        $taillemax = 1000000;
        $taille = filesize($_FILES['photo']['tmp_name']);
        $exts = array ('.PNG', ".jpeg");
        $ext = strrchr($_FILES['photo']['name'],'.');
        
        if ($taille > $taillemax) {
            $erreur = "L'image est trop volumineuse...";
        }
        if (!isset($erreur)) {
            if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossier.$fichier)) {
                echo 'Upload effectué avec succès !';
            }else {
                echo 'Echec de l\'upload !';
            }
        }else {
            echo $erreur;
        }
    }*/




    }
    var_dump($_POST);
?>
<div class="fond">
    <div class="fond1">
        <div class="fond2">
            <div class="fond3">
                <div class="fond4">
                    <div class="formulaire">
                        <div class="inscrit">S'INSCRIRE</div>
                        <div class="petit"> Pour tester votre niveau de culture générale </div>
                        <form method="post" action="" class="form" enctype="multipart/form-data" id="form-connexion">
                            <div class="label"> Prénom </div>
                            <div class="champ"> <input type="text" name="prenom" error="error-1" id="prenom"> </div>
                            <div class="errors" id="error-1"></div>
                            <div class="label"> Nom </div>
                            <div class="champ"> <input type="text" error="error-2" name="nom" id="nom"> </div>
                            <div class="errors" id="error-2"></div>
                            <div class="label"> Login </div>
                            <div class="champ"> <input type="text" error="error-3" name="login" id="login"> </div>
                            <div class="errors" id="error-3"></div>
                            <div class="label"> Password </div>
                            <div class="champs"> <input type="password" error="error-4" name="password" id="password" placeholder="********"> </div>
                            <div class="errors" id="error-4"></div>
                            <div class="label"> Confirmer Password </div>
                            <div class="champs"> <input type="password" name="confirm" error="error-5" id="confirm" placeholder="********"> </div>
                            <div class="errors" id="error-5"></div>
                            <div class="texteavatar">Avatar</div>
                            <div class="fichier">
                                <label for="file" class="label-file">Choisir un fichier</label>
                                <input type="hidden" value="1000000" name="MAX_FILE_SIZE">
                                <input type="file" id="file" class="choisir" name="image" accept="image/*" onchange="loadFile(event)">
                            </div>
                            <div class="creer"> <button type="submit" name="submit" id="connexion"> Créer compte </button> </div>
                        </form>
                    </div>
                    <img id="output" class="avatarr"></div>
                    <div class="joueur">Avatar du joueur</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src)
    }
  };
</script>
<script src="public/js/validation.js">
</script>
