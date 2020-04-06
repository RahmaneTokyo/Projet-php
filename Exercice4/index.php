<?php
    require_once'function.php';
    $ph='';
    $erreur = "";
    $phrase=[];
    if (isset($_POST['envoyer'])) {
        $ph=$_POST['phrase'];
        if (is_empty($ph)) {
            $erreur = 'Veuillez saisir une phrase svp!';
        }else {
            $ph = preg_replace('/\.\s+/','.',$ph);
            $phrase = cut($ph);
            for($i=0; $i<long_chaine($phrase) ;$i++) {
                if (is_sentence($phrase[$i])) {
                    if (long_chaine($phrase[$i])<=200) {
                        $phrase[$i] = delete_spc_into($phrase[$i]);
                    }
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Exercice 4</title>
    </head>
    <body>
        <div id="cadre">
            <form method="post">
                <Label>Saisir</Label>
                <textarea name="phrase"><?=$ph?></textarea>
                <input type="submit" name="envoyer" value="Envoyer">  
                <?php if (isset($_POST['envoyer'])) { ?>
                <span><?= $erreur ?></span>
                <textarea readonly="yes"><?php for ($i=0; $i < long_chaine($erreur) ; $i++) { ?>
                <?php } for ($i=0; $i <long_chaine($phrase) ; $i++) { if (is_sentence($phrase[$i])) { if (long_chaine($phrase[$i])<=200) {
                echo $phrase[$i].' '; } } } ?>
                </textarea><?php } ?>
            </form>
        </div>
    </body>
</html>