<?php

    $host = "mysql-tokyosan.alwaysdata.net";
    $username ="tokyosan";
    $password = "rahmane961";
    $database = "tokyosan_quizzsa";

    /* $host = "localhost";
    $username ="root";
    $password = "";
    $database = "quizzsa"; */

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $e) {
        die("Une erreur est survenue lors de la connexion à la base de données");
    }

?>