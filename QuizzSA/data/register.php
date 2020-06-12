<?php

    require_once('connexiondb.php');    

    $message="";

    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $login=$_POST['login'];
    $pwd=$_POST['pwd'];

    $target= "./public/image/".basename($_FILES['image']['name']);
    $images= $_FILES['image']['name'];
    $image='image'
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $data=$pdo->prepare("INSERT INTO `utilisateur` (`login`, `pwd`, `prenom`, `nom`, `profil`, `score`, `image`) VALUES (?, ?, ?, ?, ?, ?, ?) ");
    $ok= $data->execute(array($login,$pwd,$firstname,$lastname,$profil="admin",$score="NULL",$images));

    if($ok){
        header("location: ../pages/creeradmin.php");
        /* $result["redirection"]= "pages/creeradmin.php"; */
        echo "Admin ajouté avec succés";
    }else{
        echo "Error lors de l'insertion";

    }
/* } catch (PDOException $e) {
    die("Une erreur est survenue lors de la connexion à la base de données");
} */



?>