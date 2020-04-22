
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
            $indiceD=($pageActuelle-1)*nbrParPage;
            $indiceF=$indiceD + nbrParPage - 1;
            for ($i=$indiceD; $i<=$indiceF; $i++){
                if (isset($joueur[$i])){
    ?>
    <div class="nom_prenom_top_score_joueur">
        <div class="nom_prenom_joueur"><?= $joueur[$i]['prenom']." ".$joueur[$i]['nom']." ".$joueur[$i]['score'].' pts';?> </div>
    &nbsp;
    </div>
    <?php
                }
            }
        }
    ?>
    
    </div>
    <div class="page">
    <?php
        for ($i=1; $i<=$nbreDePage; $i++){
            echo "<a href='index.php?lien=admin&block=ListeJoueurs&fenetre=$i'>" .$i. '&nbsp&nbsp&nbsp</a>';
        } 
    ?>
    </div>
</div>
