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