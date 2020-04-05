<?php
    require_once 'fonction.php';
    $tabMots = [];
    $errors = [];
    $motsAvecM = [];
    $nbrchamps = 0;
    $message = '';
    if (isset($_POST['valider'])) {
        $nbrchamps = $_POST['nbre'];
        if (is_empty($nbrchamps)) {
            $message = 'Champ obligatoire !';
        }else {
            if (!is_chaine_numeric($nbrchamps)) {
                $message = 'Veuillez saisir un entier positif !';
                $nbrchamps = 0;
            }
        }
    }
    if (isset($_POST['resultat'])){
        $nbrchamps = $_POST['nbre'];
        for ($i=0;$i<$nbrchamps;$i++){
            $mot = $_POST['mot_'.($i)];
            if (is_empty($mot)) {
                $errors[$i] = 'Saisir un mot svp !';
            }elseif (long_chaine($mot)> 20){
                $errors[$i] = 'Le mot ne doit pas dépasser 20 caractères !';
            }elseif(!is_chaine_alpha($mot)){
                $errors[$i] = 'Veuillez saisir un seul mot !';
            }else{
                $tabMots[$i]= $mot;
            }
            if(isset ($tabMots[$i])){
                if (is_car_present_in_chaine('m',$tabMots[$i])){
                    $motsAvecM[$i]= $tabMots[$i];
                }
                if (is_car_present_in_chaine('M',$tabMots[$i])){
                    $motsAvecM[$i]= $tabMots[$i];
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
        <link rel="stylesheet" href="style.css">
        <title>Exemple</title>
    </head>
    <body>
        <div id="cadre">
            <div class="form">
                <form method="post">
                    <label class="champ">Veuilez saisir le nombre de champs</label>
                    <input type="text" autocomplete="off" name="nbre" value="<?= $nbrchamps ?>">
                        <span> <?= $message ?> </span>
                    <button class="envoi" type="submit" name="valider">Envoyer</button>
                    <button class="annul" type="submit">Annuler</button>
                        <?php for($i=0; $i < $nbrchamps; $i++) { ?>
                    <label>Mot N°<?= $i+1 ?></label>
                        <?php if (isset($errors[$i])){ ?>
                        <span> <?= $errors[$i]?></span><br>
                        <?php }?>
                    <input type="text" autocomplete="off" name="mot_<?= $i ?>" value="<?php if (isset($_POST['mot_'.$i])){echo $_POST['mot_'.$i];}?>" >
                        <?php } ?>
                        <?php if ($nbrchamps>0) { ?>
                    <button class="result" type="submit" name="resultat">Résultats</button>
                        <?php } ?>
                </form>
            </div>
            <div class="affichage">
                <?php
                    if (isset($_POST['resultat'])) {
                        if (empty($errors)) {
                            echo 'Le(s) mot(s) saisis sont : ';
                            for ($i=0; $i < $nbrchamps; $i++) {
                                if(isset($tabMots[$i])) {
                                echo $tabMots[$i].' ';
                                }
                            }
                            echo '<br>Le(s) mot(s) contenant la lettre m ou M sont : ';
                            for ($i=0; $i < $nbrchamps; $i++) {
                                if(isset($motsAvecM[$i])) {
                                echo $motsAvecM[$i].' ';
                                }
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>