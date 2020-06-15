<?php
    require_once("connexiondb.php");
    global $pdo;

    $sql =$pdo->prepare("SELECT * FROM utilisateur WHERE profil='joueur' ORDER BY score DESC LIMIT 5");
    $sql->execute();

    while ($row= $sql->fetch()){
?>
            <div class="prenom text-left"><?= $row['prenom'] ?></div>
            <div class="prenom text-center"><?= $row['nom'] ?></div>
            <div class="prenom text-right"><?= $row['score'] ?> Pts</div>
<?php 
    }
     
?>