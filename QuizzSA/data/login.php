<?php
    session_start();
    include("connexiondb.php");
    global $pdo;
    $message = "";   
        
    $query = "SELECT * FROM utilisateur WHERE login = :login AND pwd = :pwd";
    $statement = $pdo->prepare($query);

    $statement->execute(

        array(
        'login' => $_POST["login"],
        'pwd' => $_POST["pwd"]
        )

    );

    $count = $statement->rowCount();
    if($count > 0) {
        $result= $statement->fetch();

        $_SESSION["firstname"]  = $result['prenom'];
        $_SESSION["lastname"] = $result["nom"];
        $_SESSION["image"] = $result["image"];
        $_SESSION["login"] = $_POST["login"];
        
        if($result["profil"]=="admin"){
            echo "success_admin";
        }elseif ($result["profil"]=="joueur"){
            echo "success_player";
        }
    }else{
        echo 'failed';
        $message = "login ou pwd incorrect";
    }
?>