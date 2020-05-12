<?php
    session_start();
    if (isset($_POST['next'])){
        $index= $_SESSION['page'];
        $nbr_page= $_SESSION['nbr_page'];
        $i=$index-1;
        if ($_POST['choice']=="text"){
            if (isset($_POST['textReponse'])) {
                $_SESSION['result'][$i] = $_POST['textResponse'];
            }
        }elseif ($_POST['choice']=="simple"){
            if (isset($_POST['radio'])){
                $_SESSION['result'][$i] = $_POST['radio'];
            }
        }else{
            if (isset($_POST['check'])){
                $_SESSION['result'][$i]= $_POST['check'];
            }
        }

        if ($index<$nbr_page){
        $next=($index+1);
        header("Location:index.php?lien=jeux&block=topscore&page=$next");
        }
        echo 'Jeu Terminé <br>';
        print_r($_SESSION['result']);
    }
    if (isset($_POST['pre'])){
        $index= $_SESSION['page'];
        $nbr_page= $_SESSION['nbr_page'];
        if ($index<=$nbr_page){
            $previous=($index-1);
            header("Location:index.php?lien=jeux&block=topscore&page=$previous");
        }
    }