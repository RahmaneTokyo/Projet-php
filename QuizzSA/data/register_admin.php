<?php

    require_once('connexiondb.php');
    global $pdo ;

    $target= "../public/image/".basename($_FILES['file']['name']);
    $file= $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $target);

    if (isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['login'])
        && isset($_POST['pwd']) && isset($_FILES['file'])){
        $lastname= strtoupper($_POST['lastname']);
        $firstname= ucfirst($_POST['firstname']);
        $login= $_POST['login'];
        $pwd= $_POST['pwd'];
        $file=$_FILES['file']['name'];

        if (!empty($lastname) && !empty($firstname) && !empty($login) && !empty($pwd) && !empty($file)){

            $response= $pdo->prepare('INSERT INTO utilisateur (login, pwd, prenom, nom, profil, score, image) VALUES (:login, :pwd, :prenom, :nom, :profil, :score, :image)');
            $response->execute(array(
                'login'=>$login,
                'pwd'=>$pwd,
                'prenom'=>$firstname,
                'nom'=>$lastname,
                'profil'=>"admin",
                'score'=>NULL,
                'image'=>$file
            ));
            if($response->rowCount() > 0){
                header("location: ../index.php?lien=admin");
            }else {
                echo "nok";
            }
            $response->closeCursor();
        }

    }

?>