<?php
    $js = file_get_contents('./data/question.json');
    $js = json_decode($js, true);
    foreach($js as $value) {
        $tab[] = $value;
    }
    if (isset($_POST['ok'])){

        $nbr=$_POST['number'];
        if (empty($_POST['number'])){
            echo 'entrer une valeur';
        }elseif ($_POST['number']<= 0){
            echo 'entrer une valeur superieure a 0';
        }else{
            $_SESSION['nbr']=$nbr;
        }

    }

?>
<div class="fond">
    <div class="haut">
        <form method="POST" action="">
            <div class="tete">Nombre de questions/jeu</div>
            <input class="field" type="text" name="number" id="">
            <input type="submit" value="OK" class="ok" name="ok" id="">
        </form>
    </div>
    <div class="encadre">
        <?php
            if (!empty($_SESSION['nbr'])) {
                paginate($tab, $_SESSION['nbr']);
            }
        ?>
    </div>
</div>
