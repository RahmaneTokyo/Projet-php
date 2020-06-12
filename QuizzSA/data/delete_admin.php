<?php
require_once "connexiondb.php";
global $pdo;
$login=$_POST['login'];
$req=$pdo->query("DELETE FROM utilisateur WHERE login='$login'");
if ($req->rowCount()>0){
    echo 'ok';
}