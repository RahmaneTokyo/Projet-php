<div class="fonde">
    <div class="teter">LISTE DES JOUEURS PAR SCORE</div>
    <div class="encadrer">
    
        <?php
            $js= file_get_contents('./data/utilisateur.json');
            $js= json_decode($js, true);
            foreach ($js as $value){
                if ($value["profile"]=="joueur"){
                    $joueur[] = $value;
                }
            }
            $score=[];
            foreach ($joueur as $key => $value){
                array_push($score, $value['score']);
            }
            array_multisort($score, SORT_DESC, $joueur);
            $total= count($joueur);
            define ('nbrParPage', 15);
            $nbreDePage=ceil($total/nbrParPage);
            if (isset($_GET['fenetre'])){
                $pageActuelle=$_GET['fenetre'];
                if ($pageActuelle<1){
                    $pageActuelle=1;
                }
                elseif ($pageActuelle>$nbreDePage){
                    $pageActuelle=$nbreDePage;
                }
        ?>
        <?php
            }else {
                $pageActuelle =1;
            }
            $indiceD=($pageActuelle-1)*nbrParPage;
            $indiceF=$indiceD + nbrParPage - 1;
        ?>

        <div class="colone">Prénom</div>
        <div class="colone">Nom</div>
        <div class="colone">Score</div>
        
        <?php
            for ($i=$indiceD; $i<=$indiceF; $i++){
                if (isset($joueur[$i])){
        ?>
        
        <div class="paginer"> <?= $joueur[$i]['prenom'] ?> </div>
        <div class="paginer"> <?=$joueur[$i]['nom']?> </div>
        <div class="paginerr"> <?=$joueur[$i]['score']?> pts</div>
        
        <?php
                }
            }
        ?>

    </div>
    <div class="page">
        <?php if ($pageActuelle <= 1) { ?>
            <div type="submit" class="suivant"> <a href="index.php?lien=admin&block=ListeJoueurs&fenetre=<?=$pageActuelle+1?>"> Suivant </a> </div>    
        <?php }else { ?>
            <div type="submit" class="suivant"> <a href="index.php?lien=admin&block=ListeJoueurs&fenetre=<?=$pageActuelle+1?>"> Suivant </a> </div>
            <div type="submit" class="precedent"> <a href="index.php?lien=admin&block=ListeJoueurs&fenetre=<?=$pageActuelle-1?>"> Précédent </a> </div>
        <?php } ?>
    </div>
</div>