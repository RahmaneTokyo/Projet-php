<?php
    if (isset($_POST['submit'])) {
        save_player_to_json($_POST['login']);
    }
?>

<div class="cadre">
        <div class="fond">
            <div class="fond1">
                <div class="fond2">
                    <div class="fond3">
                        <div class="fond4">
                            <div class="formulaire">
                                <div class="inscrit">S'INSCRIRE</div>
                                <div class="petit"> Pour tester votre niveau de culture générale </div>
                                <form method="post" action="" id="form-connexion">
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
    </div>

<script src="public/js/validation.js">
</script>
