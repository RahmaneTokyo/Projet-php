<?php
    if (isset($_POST['submit'])) {
        save_admin_to_json($_POST['login']);
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
                        <form method="post" action="" class="form" id="form-connexion">
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
                                <input id="file" class="choisir" type="file" accept="image/*">
                            </div>
                            <div class="creer"> <button type="submit" name="submit" id="connexion"> Créer compte </button> </div>
                        </form>
                    </div>
                    <div class="avatarr"></div>
                    <div class="joueur">Avatar du joueur</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="public/js/validation.js">
</script>
