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
      echo $message;
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







function paginate ($tab, $nbr_questions){

    $nb_articles_total = count( $tab);
    $nb_per_page = $nbr_questions;
    $nb_pages = ceil($nb_articles_total / $nb_per_page);
    if (isset($_GET['page'])) {
        $num_page = $_GET['page'];
    }else{
        $num_page=1;
    }
    echo 'Nombre de pages: ' . $nb_pages . '<br>';
    echo 'Page '.$num_page.'/'.$nb_pages. '<br>';
    echo '<hr>';


    $indideD = ($num_page - 1) * $nb_per_page;
    $indiceF = $indideD + $nb_per_page - 1;
    for ($i=$indideD; $i<=$indiceF; $i++){
        if (array_key_exists($i, $tab)) {
            echo ($i+1).' <span style="width:90%; color: #45b4d6; font-size:20px;"> '
                .$tab[$i]['question'].'</span> <br>';
            foreach ($tab[$i]['reponses_possible'] as $key){
                if ($tab[$i]['type_reponse']=='texte'){
                    echo'<input  type="text" name="" value="'.$key.'" disabled> <br>';
                } elseif  ($tab[$i]['type_reponse']=='simple'){
                    if (in_array($key, $tab[$i]['bonnes_reponses'])) {
                        echo'<input style="background-color: yellow" disabled type="radio" checked name="radio'.$i.'">'.' '.$key.'<br>';
                    }else{
                        echo'<input style="background-color: yellow" disabled type="radio" name="radio'.$i.'">'.' '.$key.'<br>';
                    }
                }else{
                    if (in_array($key, $tab[$i]['bonnes_reponses'])) {
                        echo '<input style="color: yellow" type="checkbox" disabled checked   name="">' . ' ' . $key.'<br>';
                    }else{
                        echo '<input style="color: yellow" type="checkbox" disabled   name="">' . ' ' . $key.'<br>';
                    }
                }


            }
            echo '<hr>';

        }

    }

    echo '<div class="pages">';
    if ($num_page > 1){
        $precedent= $num_page - 1;
        echo '<a class="previous"  href="index.php?lien=admin&block=ListeQuestions&page='.$precedent.'">Précédent</a>';
    }

    if ($num_page != $nb_pages){
        $suivant= $num_page + 1;
        echo '<a class="next" href="index.php?lien=admin&block=ListeQuestions&page='.$suivant.'">Suivant</a>';
    }

    echo '</div>';
}
