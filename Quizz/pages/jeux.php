<?php

    // Partie informations utilisateur

    if(!isset($_SESSION['profile'])){
        header("Location: index.php");
        exit;
    }

if (empty($_SESSION['start'])){
    $_SESSION['start']=1;
}
//$avatar= $_SESSION['avatar'];
/* if (!isset($_SESSION['prenom'])){
    $_SESSION['msg']='Veuillez vous connecter d\'aboord';
    header('Location: player_login_page.php');
    exit;
} */

$json_data= file_get_contents('data/utilisateur.json');
$decode_flux= json_decode($json_data, true);

$players=[];
$best_score=0;

foreach ($decode_flux as $value) {
    if ($value['profile']== "joueur") {
        $players[] = $value;

    }
    }
$column= array_column($players,'score');
array_multisort($column, SORT_DESC, $players);


foreach ($players as $item){
    if ($_SESSION['prenom']== $item['prenom']){
        $best_score= $item['score'];
    }
}

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

//get random
//require_once "traitement/fonction.php";

if ($_SESSION['start'] == 1){
    $_SESSION['shuffle'] = getRandomStr($nbr, $tab_questions);
    $_SESSION['start'] = 2;
}

$score=0;
$nb_articles_total = count( $_SESSION['shuffle']);
$nb_per_page = 1;
$nb_pages = ceil($nb_articles_total / $nb_per_page);
if (isset($_GET['page'])) {
    $num_page = $_GET['page'];
}else{
    $num_page=1;
}
$_SESSION['page']=$num_page;
$_SESSION['nbr_page']=$nb_pages;

$debut = ($num_page - 1) * $nb_per_page;
$fin = $debut + $nb_per_page - 1;

?>

<div class="cadre">
    <div class="enteter">
        <div class="joueurr">
            
        </div>
        <div class="titler"> BIENVENUE SUR LA PLATEFORME DE JEU QUIZZ<br>JOUEZ ET TESTEZ VOTRE NIVEAU DE CULTURE GÉNÉRALE </div>
        <a href="deco.php"><button type="submit" class="buttonn">Déconnexion</button></a>
    </div>
    <div class="fonds">
        <form action="./traitement.php" method="post">
            <div class="question">
                <div class="champentete">
                <?php
                    echo '<div class="p">Question '.$num_page.'/'.$nb_pages. ':</div>';
                    for ($i=$debut; $i<=$fin; $i++) {
                        if (array_key_exists($i, $_SESSION['shuffle'])) {
                            echo '<div class="div">'.$_SESSION['shuffle'][$i]['question'].'</div>';
                            $score= $_SESSION['shuffle'][$i]['nbr_point'];
                        }
                    }
                ?>
                </div>
                    <input class="nbpoints" type="text" name="nbr_point" value="<?=$score?> pts" disabled>
                <div class="questionzone">
                    <?php
                        for ($i=$debut; $i<=$fin; $i++){
                            if (array_key_exists($i, $_SESSION['shuffle'])) {
                                foreach ($_SESSION['shuffle'][$i]['reponse_possible'] as $key){
                                    if ($_SESSION['shuffle'][$i]['type_reponse']=='text'){
                                        if (isset($_SESSION['result'][$i])){
                                            echo'<input class="champtexte" type="text" name="textResponse" value="'.$_SESSION['result'][$i].'" />';
                                        }else{
                                            echo'<input class="champtexte" type="text" name="textResponse" />';
                                        }
                                    } elseif ($_SESSION['shuffle'][$i]['type_reponse']=='simple'){
                                                    if (isset($_SESSION['result'][$i])){
                                                        if($_SESSION['result'][$i]==$key){
                                                            echo '<div class="champreps">';
                                                            echo '<input class="champsrep" type="radio" value="'.$key.'" name="radio" checked> <input type="text" class="champrep" value="'.$key.'">';
                                                            echo '</div>';
                                                        }else{
                                                            
                                                            echo '<div class="champreps">';
                                                            echo'<input type="radio" class="champsrep" value="'.$key.'" name="radio"> <input type="text" class="champrep" value="'.$key.'">';
                                                            echo '</div>';
                                                        }
                                                    }else{
                                                        echo '<div class="champreps">';
                                                        echo'<input type="radio" class="champsrep" value="'.$key.'" name="radio"> <input type="text" class="champrep" value="'.$key.'">';
                                                        echo '</div>';    
                                                    }
                                    }else{
                                        if (isset($_SESSION['result'][$i])) {
                                            
                                            for ($k=0;$k<count($_SESSION['result'][$i]); $k++){
                                                if ($k== $key) {
                                                    echo '<div class="champreps">';
                                                    echo '<input class="champsrep" type="checkbox" checked name="check[]" value="'.$key.'"> <input type="text" class="champrep" value="'.$key.'">';
                                                    echo '</div>';
                                                }else{
                                                    echo '<div class="champreps">';
                                                    echo '<input class="champsrep" type="checkbox"  name="check[]" value="'.$key.'"> <input type="text" class="champrep" value="'.$key.'">';
                                                    echo '</div>';
                                                }
                                            }
                                        }else{
                                            echo '<div class="champreps">';
                                            echo '<input class="champsrep" type="checkbox" name="check[]" value="'.$key.'"> <input type="text" class="champrep" value="'.$key.'">';
                                            echo '</div>';
                                        }
                                        
                                    }

                                }
                                if ($_SESSION['shuffle'][$i]['type_reponse']=='texte'){
                                    echo '<input type="hidden" name="choice" value="texte">';
                                }elseif ($_SESSION['shuffle'][$i]['type_reponse']=='simple'){
                                    echo '<input type="hidden" name="choice" value="simple">';
                                }else{
                                    echo '<input type="hidden" name="choice" value="multiple">';
                                }
                            }
                        }
                    ?>
                </div>
                <div class="pagers">
                <?php
                    if ($num_page > 1){ 
                        $precedent= $num_page - 1; ?>
                        <button type="submit" name="pre" class="previouss">Précédent</button>
                     <?php }
                    if ($num_page <= $nb_pages){ $suivant= $num_page + 1; ?>
                        <button type="submit" name="next" value="<?= $suivant ?>" class="nextt">Suivant</button>
                    <?php } ?>
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
                    }/* else {
                        header ("location: index.php?lien=jeux&bloc=topscores");
                    } */
                ?>
            </div>
        </div>
        </form>
    </div>
    
    
    
    
    
    <!-- <div class="scores">

                <ul>
                    <a href="#" id="tp" onclick="top_score();"><li class="tp_s">Top Scores</li></a>
                    <a href="#" id="best_score" onclick="best_score()"><li>Mon Meilleur Score</li></a>
                </ul>

                    <div id="top_players">
                    <table >
                        <tr>
                            <th>Noms</th>
                            <th>Score</th>
                        </tr>
                            <?php
                            for ($i=0; $i <5; $i++){
                                if (array_key_exists($i,$players)){
                                echo '<td>'.$players[$i]['prenom'].' '.$players[$i]['nom'].'</td>';
                                echo '<td>'.$players[$i]['score'].'</td>';
                                echo '</tr>';
                                }
                            }
                            ?>
                    </table>
                    </div>
                    <div id="best-score">
                        <?php
                        echo '</span>Meilleure Score: '.$best_score.' Pts</span>';
                        ?>
                    </div>

    </div> -->
</div>
    <script src="../Js/functions.js">

    </script>

<?php
/*
    // Partie informations utilisateur

    if(!isset($_SESSION['profile'])){
        header("Location: index.php");
        exit;
    }

    // Lecture des fichiers contenant les questions et le nombre de questions à afficher

//    $question = getData('question');

//    $nbrquestion = getData('nombre');

    $joueur = getData('utilisateur');

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
             
        </div>
        <div class="titler"> BIENVENUE SUR LA PLATEFORME DE JEU QUIZZ<br>JOUEZ ET TESTEZ VOTRE NIVEAU DE CULTURE GÉNÉRALE </div>
        <a href="deco.php"><button type="submit" class="buttonn">Déconnexion</button></a>
    </div>
    <div class="fonds">
        <form action="./traitement.php" method="post">
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
    
                        echo '<button class="nextt" type="submit" name="suivant">SUIVANT</button>';
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















<?php
/*    $quest = getData($file = "question");
    $nbqts= getData($file = "nombre");
    $exist = getData($file = "utilisateur");
    // echo $exist[1]['login'];
    $question= [];
   // echo count($quest);
    $j = 0;
    $lq = 0;
    $reps= '';
    $total_page=$nbqts['nbrquestion'];
    do{
       // if( $_SESSION['user']['login']!==$exist[$j]['login']){
       //     foreach($exist[$j]['question'] as $value){  
           //    if($quest[$j]['question'] !=$value){
                 $question[$j]= $quest[$j];
             //   }
            //}
       // }else  $_SESSION['in_json']=true;
        $j++;
    } while (count($question)<$total_page &&isset($exist[$j]));
?>
<?php  
    if(isset($question) ){
            if(!isset($_SESSION['str'])){$_SESSION['str']=1;}
            if($_SESSION['str']==1){shuffle($question); $_SESSION['str']=2;}
            $_SESSION['c'] =$question;
           if(isset($_POST['suivant']))
           {  
            
            $_SESSION['q'][] = $_POST['suivant'];
               $_SESSION['i'] = $_POST['suivant']+1;
                $lq = $_SESSION['i'] ;
              
           }if(isset($_POST['precedent'])){
              // unset($_SESSION['q'][$lq]);
                //$_SESSION['i']=$_POST['precedent'];
                //$lq = $_SESSION['i'];  
           }
           if(isset($_POST['suivant']) && $_POST['suivant']=="fin"){
                header('location: .php');
           }
           var_dump($_POST);
    ?>
        <form action="" method="post">
            <div class="_question">
                <h3>Questions <?= $lq+1,"/",$total_page?></h3>
                <p><?= $question[$lq]['question'] ?></p>
                <input type="hidden" name="num_q" value="<?= $question[$lq]['question']; ?>" >
            </div>
            <p class="nbre-points"><?= $question[$lq]['nbr_point'] ?> pts
            <input type="hidden" name="score" value="<?= $question[$lq]['nbr_point'] ?>" >
            <input type="hidden" name="choix" value="<?= $question[$lq]['type_reponse'] ?>" >
            </p>
            <?php
                 for($k = 0; $k<count($question[$lq]['reponse_possible']);$k++){
                    if($question[$lq]['type_reponse']=='multiple'){
                        
                       echo "<div><input type=checkbox name=box_$k value=on_$k><span>".$question[$lq]['reponse_possible'][$k]."</span></div>";
                    }
                    if($question[$lq]['type_reponse']=='simple'){
                        echo "<div><input type=radio name=on value=on_$k >"."<span>".$question[$lq]['reponse_possible'][$k]."</span></div>";
                    }
                    if($question[$lq]['type_reponse']=='text')
                      echo "<div><textarea name=reponse cols=\"35\" rows=\"2\"></textarea><br></div>";
                }
   
            ?>


            <div class="content-btn">
                <?php
                if($lq>0){
                    $precedent=$lq-1;
                    echo'<button type=submit class="btn-prec btn-suiv-j" name=precedent value='.$precedent.'>Precedent</button>';    
                        }  
                if($lq<$total_page-1){
                    $suivant= $lq;
                    echo '<button type=submit class="btn-suiv btn-suiv-j" name=suivant value='.$suivant.'>Suivant</button>';   
                        }else   
                   echo'<button class="btn-suiv btn-suiv-j"  name=suivant  value=fin >Terminer</button>';
                ?>
            </div>
        </form>
        <?php } */
        ?>
