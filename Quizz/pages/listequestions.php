<!-- Récupération des questions dans le fichier Json --> <!-- Récupération des questions dans le fichier Json -->

<?php
    $js = file_get_contents('./data/question.json');
    $js = json_decode($js, true);
    foreach($js as $value) {
        $tab[] = $value;
    }

    $data = file_get_contents('./data/nombre.json');
    $data = json_decode($data, true);
    $_SESSION['nbr'] = $data['nbrquestion'];
    if (isset($_POST['submit'])){

        $nbr=$_POST['number'];
        if ($nbr < 5) {
            $message = "Saisir un nombre supérieur ou égal à 5";
        }else{
            $_SESSION['nbr']=$nbr;
            $data = file_get_contents('./data/nombre.json');
            $data = json_decode($data, true);
            $data = array (
                "nbrquestion" => $nbr
            );
            $datafinal = json_encode($data);
            file_put_contents('./data/nombre.json', $datafinal);
        }
    }
?>

<!-- Partie HTML --> <!-- Partie HTML --> <!-- Partie HTML --> <!-- Partie HTML --> <!-- Partie HTML --> <!-- Partie HTML --> <!-- Partie HTML -->

<div class="fond">
    <div class="haut">
        
    <span class="erreur"> <?php if (isset($message)) { echo $message; } ?> </span>
        <form method="POST" action="" id="form-connexion">
            <div class="tete">Nombre de questions/jeu</div>
            <input class="field" type="text" name="number" id="" value="<?= $_SESSION['nbr'] ?>" error="error-1">
            <input type="submit" value="OK" class="ok" name="submit" id="">
            <div class="erreur">    
                <div class="error" id="error-1"></div>
            </div>
        </form>
    </div>
    <div class="encadre">

<!-- Pagination des questions --> <!-- Pagination des questions --> <!-- Pagination des questions --> <!-- Pagination des questions -->

        <?php
                $nbr_questions = $_SESSION['nbr'];

                $nb_articles_total = count( $tab);
                $nb_per_page = 5;
                $nb_pages = ceil($nb_articles_total / $nb_per_page);
                if (isset($_GET['page'])) {
                    $num_page = $_GET['page'];
                }else{
                    $num_page=1;
                }
                $indideD = ($num_page - 1) * $nb_per_page;
                $indiceF = $indideD + $nb_per_page - 1;
                for ($i=$indideD; $i<=$indiceF; $i++){
                    if (array_key_exists($i, $tab)) {
                        ?>
                            <div class="zonequestion">
                                <div class="numero"> <?= ($i+1) ?> </div>
                                <div class="laquestion"><?= $tab[$i]['question'] ?></div>
                            </div>
                        <?php
                        foreach ($tab[$i]['reponse_possible'] as $key){
                            if ($tab[$i]['type_reponse']=='text'){
                                if(in_array($key, $tab[$i]['reponse_possible'])){
                                    ?>
                                        <div class="zonereponse1">
                                            <input class="zonerep1" type="text" value="<?= $key ?>">
                                        </div>
                                    <?php
                                }
                            }
                            if  ($tab[$i]['type_reponse']=='simple'){
                                if (in_array($key, $tab[$i]['bonne_reponse'])) {
                                    ?>
                                        <div class="zonereponse">
                                            <input class="zoneselect1" disabled type="radio" checked name="radio<?=$i?>">
                                            <input class="zonerep1" type="text" value="<?= $key ?>" disabled>
                                        </div>
                                    <?php
                                }else {
                                    ?>
                                        <div class="zonereponse">
                                            <input class="zoneselect1" disabled type="radio" name="radio<?=$i?>">
                                            <input class="zonerep1" type="text" value="<?= $key ?>" disabled>
                                        </div>
                                    <?php
                                }
                            }
                            if ($tab[$i]['type_reponse']=='multiple') {
                                if (in_array($key, $tab[$i]['bonne_reponse'])) {
                                    ?>
                                        <div class="zonereponse">
                                            <input class="zoneselect1" style="color: yellow" type="checkbox" disabled checked>
                                            <input class="zonerep1" type="text" value="<?= $key ?>" disabled>
                                        </div>
                                    <?php
                                }else{
                                    ?>
                                        <div class="zonereponse">
                                            <input class="zoneselect1" type="checkbox" disabled>
                                            <input class="zonerep1" type="text" value="<?= $key ?>" disabled>
                                        </div>
                                    <?php
                                }
                            }
                        }
                    }
                }
            ?>
    </div>
        <div class="pages">
        <?php
                if ($num_page > 1){
                    $precedent= $num_page - 1;
        ?>
                    <a class="previous" href="index.php?lien=admin&block=ListeQuestions&page=<?=$precedent?>">Précédent</a>
        <?php
                }
                if ($num_page != $nb_pages){
                    $suivant= $num_page + 1;
        ?>
                    <a class="next" href="index.php?lien=admin&block=ListeQuestions&page=<?=$suivant?>">Suivant</a>
        <?php
                }
        ?>
        </div>
</div>
<script src="./public/js/validation.js">

</script>
