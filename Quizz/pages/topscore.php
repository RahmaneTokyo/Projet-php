<?php

    $json_data = file_get_contents('./data/utilisateur.json');
    $decode_flux = json_decode($json_data, true);
    foreach ($decode_flux as $value) {
        if ($value["profile"] == "joueur") {
            $joueur[] = $value;
        }
    }

    $colonne = array_column($joueur, 'score');
    array_multisort($colonne, SORT_DESC, $joueur);

    foreach ($joueur as $key => $value) {
        if ($key < 5 ) {
            echo "<div class='ab'>".$value['prenom']." ".$value['nom']." ".$value['score']." pts</div>";
        }
    }

?>