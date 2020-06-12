<?php

require_once ("connexiondb.php");
global $pdo;
/* $objetPdo = getConnexion($database = "inscription_joueur_quizz"); */

    $limit = $_POST["limit"]; // 
    $offset = $_POST["offset"]; //
    /* $score = $_POST["score"]; */

    $sql ="
            SELECT (`prenom`), (`nom`), (`score`),(`login`) FROM utilisateur 
            WHERE `profil`='admin'
            ORDER BY `utilisateur`.`nom` ASC
            LIMIT {$limit}
            OFFSET {$offset}
    ";
        
    $req = $pdo->query($sql);
    $result = $req->fetchAll(2);

    echo json_encode($result);

?>