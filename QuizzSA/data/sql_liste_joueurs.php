<?php
require_once ("connexiondb.php");
global $pdo;
/* $objetPdo = getConnexion($database = "inscription_joueur_quizz"); */

    $limit = $_POST["limit"]; // 
    $offset = $_POST["offset"]; //
    /* $score = $_POST["score"]; */

    $sql ="
            SELECT (`prenom`), (`nom`), (`score`),(`login`) FROM utilisateur 
            WHERE `profil`='joueur'
            ORDER BY `utilisateur`.`score` DESC
            LIMIT {$limit}
            OFFSET {$offset}
    ";
        
    $req = $pdo->query($sql);
    $result = $req->fetchAll(2);

    echo json_encode($result);

    /* function onDelate(){
        $objetPdo = getConnexion($database = "inscription_joueur_quizz");
        $sql ="
        DELETE FROM `inscriptions_joueur` 
        WHERE `inscriptions_joueur`.`id_joueur` = $id_joueur
        ";
        $req = $objetPdo->query($sql);
    } */

?>