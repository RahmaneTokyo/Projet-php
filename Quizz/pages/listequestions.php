<!-- Récupération des questions dans le fichier Json --> <!-- Récupération des questions dans le fichier Json -->

<?php
    $js = file_get_contents('./data/question.json');
    $js = json_decode($js, true);
    foreach($js as $value) {
        $tab[] = $value;
    }
    if (isset($_POST['ok'])){

        $nbr=$_POST['number'];
        if (empty($_POST['number'])){
            echo 'entrer une valeur';
        }elseif ($_POST['number']<= 0){
            echo 'entrer une valeur superieure a 0';
        }else{
            $_SESSION['nbr']=$nbr;
        }
    }
?>

<!-- Partie HTML --> <!-- Partie HTML --> <!-- Partie HTML --> <!-- Partie HTML --> <!-- Partie HTML --> <!-- Partie HTML --> <!-- Partie HTML -->

<div class="fond">
    <div class="haut">
        <form method="POST" action="">
            <div class="tete">Nombre de questions/jeu</div>
            <input class="field" type="text" name="number" id="">
            <input type="submit" value="OK" class="ok" name="ok" id="">
        </form>
    </div>
    <div class="encadre">

<!-- Pagination des questions --> <!-- Pagination des questions --> <!-- Pagination des questions --> <!-- Pagination des questions -->

        <?php
            if (!empty($_SESSION['nbr'])) {
                $nbr_questions = $_SESSION['nbr'];

                $nb_articles_total = count( $tab);
                $nb_per_page = $nbr_questions;
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
                                        <input class="zonerep1" type="text" value="<?= $key ?>">
                                    <?php
                                }
                            }
                            if  ($tab[$i]['type_reponse']=='simple'){
                                if (in_array($key, $tab[$i]['bonne_reponse'])) {
                                    ?>
                                        <input class="zonerep1" type="text" value="<?= $key ?>" disabled>
                                        <input class="zoneselect1" disabled type="radio" checked name="radio<?=$i?>">
                                    <?php
                                }else {
                                    ?>
                                        <input class="zonerep1" type="text" value="<?= $key ?>" disabled>
                                        <input class="zoneselect1" disabled type="radio" name="radio<?=$i?>">
                                    <?php
                                }
                            }
                            if ($tab[$i]['type_reponse']=='multiple') {
                                if (in_array($key, $tab[$i]['bonne_reponse'])) {
                                    ?>
                                        <input class="zonerep1" type="text" value="<?= $key ?>" disabled>
                                        <input class="zoneselect1" style="color: yellow" type="checkbox" disabled checked>
                                    <?php
                                }else{
                                    ?>
                                        <input class="zonerep1" type="text" value="<?= $key ?>" disabled>
                                        <input class="zoneselect1" type="checkbox" disabled>
                                    <?php
                                }
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
