<?php

  // Fonction qui permet de verifier la validité du compte de l'utilisateur et le rediriger vers la page correspondante
    
    function connexion($login,$password) {
    
      $users = getData();
      foreach ($users as $value) {
        if ($value["login"] === $login && $value["password"] === $password) {
          if ($value["profile"] === "admin") {
            return "admin";
          }else {
            return "jeux";
          }
        }
      }
      return "error";
    }

  //Foction qui permet de se deconnecter

  function deconnexion() {
    unset($_SESSION['user']);
    unset($_SESSION['statut']);
    session_destroy();
  }

  // Fonction qui érifie si l'utilisateur est connecé

  function is_connect() {
    if (!isset($_SESSION['statut'])) {
      header("location:index.php");
    }
  }

  //Fonction qui permet de parcourir un fichier json sous forme de tableau
    function getData($file="utilisateur") {
      $data = file_get_contents("./data/".$file.".json");
      $data = json_decode($data,true);
      return $data;
    }

  // Fonction qui teste si tous les caractères d'une chaine sont alphabetiques

  function is_chaine_alpha($chaine){
    for($i=0; $i<long_chaine($chaine); $i++){
      if (!is_car_alpha($chaine[$i])){
        return false;
      }
    }
    return true;
  }

  // Fonction qui compte le nombre d'éléments d'une chaine ou d'un tableau
    
  function long_chaine($car) {
    if (isset($car)) {
        $i=0;
        for ($j=0; isset($car[$i]); $j++) {
            $i++;
        }
        return $i;
    }
}

// Fonction qui teste si un caractère est alphabétique

function is_car_alpha ($car) {
  if( long_chaine($car) == 1 && ( ($car >= "a" && $car <= "z" ) || ($car >= "A" && $car <= "Z" ) ) ){
      return true;
  }
  return false;
}

// Fonction permettant d'uploader une image dans un dossier

function validation_donnees($login,$pwd,$confirm_pwd,$prenom,$nom,$profil,$image,$imagePath,$imageExtension,$imageSize){
  $json_data = file_get_contents('./data/utilisateur.json');
  $decode_flux = json_decode($json_data, true);
  $message = "";
  $success = "";
  //On contrôle les mots de pass
  if ($pwd != $confirm_pwd) 
  {
    $message = "Le mot de passe doit etre identique";
  }
    //On vérifie le login
    foreach ($decode_flux as $value) 
    {

      if ($login == $value['login']) {
        $message = "Le login existe deja";
      break;
      }
    }  
    
    //On contrôle si le user à envoyer une photo
    if(empty($image))
    {
        $message = "L'image de l'avatar obligatoire";
    }else{
        //On contrôle les extensions
        if($imageExtension != "jpg" && $imageExtension != "jpeg" && $imageExtension != "png")
        {
          $message = "Seuls les extensions JPG ou JPEG OU PNG sont autorisées";
        }
        //On contrôle la taille (elle ne doit pas dépasser 5 000 000) indice : on utilise $imageSize
        if ($imageSize > 5000000) 
        {
          $message = "L'image ne doit pas dépasser 500MB";
        }
        //On envoi l'image en testant l'upload (si true on envoi si false on affiche un message d'erreur)
        if(!move_uploaded_file($_FILES['image']['tmp_name'],$imagePath))
        {
           $message = "Erreur au niveau de l'envoi de l'image";
        }

    }

    if (!empty($message)) {
      echo '<span id="msg" style = "color: blue">'.$message.'</span>';
    }else{
        //On récupère les données du JSON
        $array_data = getData($file="utilisateur");
        //On crée la structure du nouveau admin
        $data = array(
          "prenom" => $prenom,
          "nom" => $nom,
          "login" => $login,
          "password" => $pwd,
          "profile" => $profil,
          "score" => " ",
          "avatar"  => $imagePath
        );
        //On implémente les données du nouveau user dans notre tableau JSON
        $array_data[] = $data;
        //On encode le tableau JSON  en file JSON
        $finally_array = json_encode($array_data);
        //Le lien de notre fichier JSON
        $lien_file_json = "data/utilisateur.json";
        //On ajoute le tout dans notre fichier JSON tout en controlant l'envoi
        file_put_contents($lien_file_json,$finally_array);
    }
  }

/* Fonction de tri pagination */

function array_sort($array,$on,$order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) { 
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
  }