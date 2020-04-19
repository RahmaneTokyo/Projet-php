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

// Fonction qui stocke les données dans le fichier json apres verification

function save_admin_to_json ($login){
  $json_data= file_get_contents('./data/utilisateur.json');

  $decode_flux= json_decode($json_data, true);
  $message='';
  $success='';
  foreach ($decode_flux as $value){
    if ($login == $value['login']){
        $message='le login existe deja' ;
        break;
    }else{
      if ($_POST['password']!= $_POST['confirm']){
        $message='Les mots de passe doivent etre identiques' ;
        break;
      }else{
          $nom = $_POST['nom'];
          $nom = strtoupper($nom);
          $prenom = $_POST['prenom'];
          $prenom = ucfirst($prenom);
          $data= array(
            "nom"=> $nom,
            "prenom"=>$prenom,
            "login"=> $_POST["login"],
            "password"=>$_POST["password"],
            "profile"=>"admin"
          );
        }
    }
  }
  if (!empty($message)){
    echo '<span id="msg" style="color: red">'.$message.'</span>';
  }
  if (!empty($data)){
    $decode_flux[]= $data;
    $decode_flux= json_encode($decode_flux);
    file_put_contents('./data/utilisateur.json', $decode_flux);
    //echo $success='<span id="msg" style="color: green">enregistrement effectués!</span>';

    $_POST["nom"]='';
    $_POST["prenom"]='';
    $_POST["login"]='';
    $_POST["password"]='';
    $_POST["confirm"]='';
  }


}


function save_player_to_json ($login){
  $json_data= file_get_contents('./data/utilisateur.json');

  $decode_flux= json_decode($json_data, true);
  $message='';
  $success='';
  foreach ($decode_flux as $value){
    if ($login == $value['login']){
        $message='Ce login existe deja' ;
        break;
    }else{
      if ($_POST['password']!= $_POST['confirm']){
        $message='Les mots de passe doivent etre identiques' ;
        break;
      }else{
          $nom = $_POST['nom'];
          $nom = strtoupper($nom);
          $prenom = $_POST['prenom'];
          $prenom = ucfirst($prenom);
          $data= array(
            "nom"=> $nom,
            "prenom"=>$prenom,
            "login"=> $_POST["login"],
            "password"=>$_POST["password"],
            "profile"=>"joueur"
          );
        }
    }
  }
  if (!empty($message)){
    echo '<span id="msg" style="color: red">'.$message.'</span>';
  }
  if (!empty($data)){
    $decode_flux[]= $data;
    $decode_flux= json_encode($decode_flux);
    file_put_contents('./data/utilisateur.json', $decode_flux);
    //echo $success='<span id="msg" style="color: green">enregistrement effectués!</span>';

    $_POST["nom"]='';
    $_POST["prenom"]='';
    $_POST["login"]='';
    $_POST["password"]='';
    $_POST["confirm"]='';
  }


}
