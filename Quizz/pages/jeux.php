<?php

    // Partie informations utilisateur

    if(!isset($_SESSION['profile'])){
        header("Location: index.php");
        exit;
    }

    // Lecture des fichiers contenant les questions et le nombre de questions à afficher

    $data = getData($file="question");
        foreach($data as $value) {
        $tab[] = $value;
    }
    $file = getData($file="nombre");
    $_SESSION['nombre'] = $file['nbrquestion'];

    //

    if (empty($_SESSION['start'])){
        $_SESSION['start']=1;
    }
    $avatar= $_SESSION['avatar'];

    //

    $json_nbr_q= file_get_contents('data/nombre.json');
    $dec= json_decode($json_nbr_q,true);
    $nbr=$dec['nbrquestion'];

    //

    $tab_questions=[];
    $json_data= file_get_contents('data/question.json');
    $decode_flux= json_decode($json_data, true);

    foreach ($decode_flux as $questions){
        $tab_questions[]= $questions;
    }

    // Mélange du tableau de question pour l'afficher aléatoirement

    if ($_SESSION['start']==1){
        $_SESSION['shuffle']= getRandomStr($nbr, $tab_questions);
        $_SESSION['start']=2;
    }

    $score=0;
    $nb_articles_total = count( $_SESSION['shuffle']);
    $nb_per_page = 1;
    $nb_pages = ceil($nb_articles_total / $nb_per_page);
    if (isset($_GET['pag'])) {
        $num_page = $_GET['pag'];
    }else{
        $num_page=1;
    }

    $debut = ($num_page - 1) * $nb_per_page;
    $fin = $debut + $nb_per_page - 1;

    // Récupération des données des réponses aux questions

    

?>

<div class="cadre">
    <div class="enteter">
        <div class="joueurr">
            <div class="images"> <img src="<?= $_SESSION['avatar']?>" alt=""> </div>
            <div class="prenomm"> <?= $_SESSION['prenom'] ?> </div>
            <div class="nomm"> <?= $_SESSION['nom']?> </div> 
        </div>
        <div class="titler"> BIENVENUE SUR LA PLATEFORME DE JEU QUIZZ<br>JOUEZ ET TESTEZ VOTRE NIVEAU DE CULTURE GÉNÉRALE </div>
        <a href="deco.php"><button type="submit" class="buttonn">Déconnexion</button></a>
    </div>
    <div class="fonds">
        <form method="POST">
        <div class="question">
            <?php
                echo '<div class="champentete">';
                echo '<div class="p">Question '.$num_page.'/'.$nb_pages. ':</div>';
                for ($i=$debut; $i<=$fin; $i++) {
                    if (array_key_exists($i, $_SESSION['shuffle'])) {
                        echo '<div class="div">'.$_SESSION['shuffle'][$i]['question'].'</div>';
                        $score= $_SESSION['shuffle'][$i]['nbr_point'];
                    }
                }
                echo '</div>';
            ?>
                <input class="nbpoints" type="text" name="nbr_point" value="<?=$score?> pts" disabled>
            <div class="questionzone">
            <?php
                for ($i=$debut; $i<=$fin; $i++){
                    if (array_key_exists($i, $_SESSION['shuffle'])) {
                        foreach ($_SESSION['shuffle'][$i]['reponse_possible'] as $key){
                            if ($_SESSION['shuffle'][$i]['type_reponse']=='text'){
                                    echo'<input class="champtexte" type="text" name="reponsetext" value="">';
                            } elseif  ($_SESSION['shuffle'][$i]['type_reponse']=='simple'){
                                echo '<div class="champreps">';
                                    echo'<input class="champsrep" type="radio" name="radio'.$i.'">'.'<input type="text" class="champrep" value="'.$key.'">';
                                echo '</div>';    
                            }else{
                                echo '<div class="champreps">';
                                    echo '<input class="champsrep" type="checkbox" name="checkbox"'.$i.'">'.'<input type="text" class="champrep" value="'.$key.'">';
                                echo '</div>';
                            }
                        }
                    }
                }
            ?>
            </div>
            <div class="pagers">
                <?php
                    if ($num_page > 1){
                        $precedent= $num_page - 1;
                        echo '<a class="previouss" href="index.php?lien=jeux&bloc=topscore&pag='.$precedent.'">PRECEDENT</a>';
                    }
    
                    if ($num_page != $nb_pages){
                        $suivant= $num_page + 1;
    
                        echo '<a class="nextt" href="index.php?lien=jeux&bloc=topscore&pag='.$suivant.'">SUIVANT</a>';
                    }
                ?>
            </div>
        </div>
        <div class="score">
            <a class="top" href="index.php?lien=jeux&bloc=topscore"> <div class="topp"> Top scores </div> </a>
            <a class="top" href="index.php?lien=jeux&bloc=monscore"> <div class="tope"> Mon meilleur score </div> </a>
            <div class="liste">
                <?php
                    if (isset($_GET['bloc'])) {
                        if ($_GET['bloc'] == "topscore") {
                            include ("topscore.php");
                        }elseif ($_GET['bloc'] == "monscore") {
                            include ("monscore.php");
                        }
                    }else {
                        header ("location: index.php?lien=jeux&bloc=topscore");
                    }
                ?>
            </div>
        </div>
        </form>
    </div>
</div>
