<!-- Partie PHP --> <!-- Partie PHP --> <!-- Partie PHP --> <!-- Partie PHP --> <!-- Partie PHP --> <!-- Partie PHP -->

<?php

    $reponses_possible=array(
        'multiple'=>array(),
        'simple'=>array(),
        'text'=>array()
    );

    $bonne_reponse=array(
        'multiple'=>array(),
        'simple'=>array(),
        'text'=>array(),
    );

    // VALIDATION BACK END AVEC PHP..................................................................

    $i=1;

    if (isset($_POST['question']) && !empty($_POST['question'])){
        $qusetion=  $_POST['question'];
        if (isset($_POST['nbr_point']) && !empty($_POST['nbr_point'])){
            $nbr_point= $_POST['nbr_point'];
            if (isset($_POST['type_reponse']) && !empty($_POST['type_reponse'])){
                $type_reponse= $_POST['type_reponse'];

    //ON MET LES TYPES DE REPONSES DANS UN TABLEAU ET LES BONNES REPONSES CHOISI DANS UN AUTRE TABLEAU....................................

                if ($type_reponse=== "multiple"){
                    while (isset($_POST['Reponse_'.$i]) && !empty($_POST['Reponse_'.$i])){
                        array_push($reponses_possible['multiple'], $_POST['Reponse_'.$i]);
                        if (!empty($_POST['radio_'.$i])){
                            array_push($bonne_reponse['multiple'], $_POST['Reponse_'.$i]);
                        }
                        $i++;
                    }
                }else
                    if ($type_reponse=== "simple"){
                        while (isset($_POST['Reponse_'.$i]) && !empty($_POST['Reponse_'.$i])){
                            array_push($reponses_possible['simple'], $_POST['Reponse_'.$i]);
                            if (!empty($_POST['checkbox_'.$i])){
                                array_push($bonne_reponse['simple'], $_POST['Reponse_'.$i]);
                            }
                            $i++;
                        }
                    }else
                        if ($type_reponse=== "text"){
                            if (!empty($_POST['Reponse_text'])){
                                array_push($reponses_possible['text'], $_POST['Reponse_text']);
                            }
                        }

    //ON MET LES DONNEES DANS UN FICHIER JSON..................................................................................

                if (isset($_POST['button-creer-question'])){
                    $creer_question= array();
            
                    $creer_question['question']= $_POST['question'];
                    $creer_question['nbr_point']= $_POST['nbr_point'];
                    $creer_question['type_reponse']= $_POST['type_reponse'];
            
                    if ($creer_question['type_reponse'] == "multiple"){
                        if (!empty($reponses_possible['multiple'])){
                            $creer_question['reponses_possible']= $reponses_possible['multiple'];
                            $creer_question['bonnes_reponses']= $bonne_reponse['multiple'];

                            $js= file_get_contents('./data/question.json');
                            $js= json_decode($js, true);
                    
                            $js[]= $creer_question;
                    
                            $js= json_encode($js);
                            file_put_contents('./data/question.json', $js);
                        }
                    }
                    if ($creer_question['type_reponse'] == "simple"){
                        if (!empty($reponses_possible['simple'])){
                            $creer_question['reponses_possible']= $reponses_possible['simple'];
                            $creer_question['bonnes_reponses']= $bonne_reponse['simple'];

                            $js= file_get_contents('./data/question.json');
                            $js= json_decode($js, true);
                    
                            $js[]= $creer_question;
                    
                            $js= json_encode($js);
                            file_put_contents('./data/question.json', $js);
                        }
                    }
                    if ($creer_question['type_reponse'] == "text"){
                        if (!empty($reponses_possible['text'])){
                            $creer_question['bonnes_reponses']= $reponses_possible['text'];

                            $js= file_get_contents('./data/question.json');
                            $js= json_decode($js, true);
                        
                            $js[]= $creer_question;
                        
                            $js= json_encode($js);
                            file_put_contents('./data/question.json', $js);
                        }
                    }
                }
            }
        }
    }
    
?>

    <!-- Partie HTML --> <!-- Partie HTML --> <!-- Partie HTML --> <!-- Partie HTML --> <!-- Partie HTML --> <!-- Partie HTML -->

    <div class="fond">
        <div class="head">PARAMÉTRER VOTRE QUESTION</div>
        <div class="encadrer">
            <form action="" method="POST" id="form-connexion">
                <div class="zone1">
                    <label class="q1">Question</label>
                    <input type="text" name="question" id="question" error="error-1" placeholder="Veuillez saisir une question sur ce champ" class="zoner1">
                    <div class="error" id="error-1"></div>
                </div>
                <div class="zone2">
                    <label class="q2">Nbre de Point</label>
                    <input type="number" class="point" name="nbr_point" error="error-2">
                    <div class="error" id="error-2"></div>
                </div>
                <div id="inputs">
                    <div class="zone3" id="row_0">
                        <label class="q3">Type de réponse</label>
                        <div class="select-style">
                            <select name="type_reponse" id="type_reponse" onchange="supprime()">
                                <option value="" selected>Choisir le type de reponse</option>
                                <option name="multiple" value="multiple" id="multiple">Multiple</option>
                                <option name="simple" value="simple" id="simple">Simple</option>
                                <option name="text" value="text" id="text">Texte</option>
                            </select>
                        </div>
                        <button type="button" name="button-plus" id="plus"  class="plus"><img src="./public/Icônes/ic-ajout-réponse.png"></button>
                        <div id="inputs2"></div>
                    </div>
                    <!-- Erreur sur id du button--> 
                    <button type="submit" name="button-creer-question" class="inside">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Partie Javascript --> <!-- Partie Javascript --> <!-- Partie Javascript --> <!-- Partie Javascript --> <!-- Partie Javascript -->

<script>
    var nbrRow= 0;

    document.getElementById("plus").addEventListener("click",function (){
        nbrRow++;
        var divInputs= document.getElementById('inputs2');
        var newInput= document.createElement('div');
        var deleteInput= document.getElementById('plus');
        var selectOptions= document.getElementById('type_reponse');
        newInput.setAttribute('class', 'zone-saisie');
        newInput.setAttribute('id', 'row_'+nbrRow);

        if (selectOptions.value==="multiple") {
            //Erreur:Fallait ajouter le <div class="error" id="error_${nbrRow}"></div> car c'est là oû on écrit l'erreur
            newInput.innerHTML= ` 
                <input type="text" name="Reponse_${nbrRow}" error="error_${nbrRow}" class="saisiee" placeholder="Reponse_${nbrRow}">
                <input type="checkbox" name="radio_${nbrRow}" class="checkbox">
                <button type="button" onclick="onDeleteInput(${nbrRow})" class="btn btn-supprimer"><img src="./public/Icônes/ic-supprimer.png"></button>
                <div class="error" id="error_${nbrRow}"></div>
                `;
            divInputs.appendChild(newInput);
        }

        if (selectOptions.value==="simple") {
            newInput.innerHTML= ` 
                <input type="text" name="Reponse_${nbrRow}" error="error_${nbrRow}" class="saisiee" placeholder="Reponse_${nbrRow}">
                <input type="radio" name="checkbox_${nbrRow}" class="radio">
                <button type="button" onclick="onDeleteInput(${nbrRow})" class="btn btn-supprimer"><img src="./public/Icônes/ic-supprimer.png"></button>
                <div class="error" id="error_${nbrRow}"></div>
                `;
        divInputs.appendChild(newInput);
        }

        if (selectOptions.value==="text") {
            deleteInput.remove();
            newInput.innerHTML= ` 
                <input type="text" name="Reponse_text" error="error_${nbrRow}" class="saisiee" placeholder="Reponse_text">
                <button type="button" onclick="onDeleteInput(${nbrRow})" class="btn btn-supprimer"><img src="./public/Icônes/ic-supprimer.png"></button>
                <div class="error" id="error_${nbrRow}"></div>
                `;
        divInputs.appendChild(newInput);
        }

    })

    function onDeleteInput(n){
        var target= document.getElementById('row_'+n);
        setTimeout(function (){
            target.remove();
        }, 1500)
        fadeOut('row_'+n);
    }
    function fadeOut(idTarget) {
        var target = document.getElementById(idTarget);
        var effet = setInterval(function() {
            if(!target.style.opacity) {
                target.style.opacity = 1;
            }
            if(target.style.opacity > 0){
                target.style.opacity -= 0.3;
            }else {
                clearInterval(effet);
            }
        }, 150);
    }
    function supprime() {
        var divInputs2 = document.getElementById('inputs2');
        divInputs2.innerHTML = ``;
    }

    // Toujours mettre la validation en dehors des fonctions

    const inputs= document.getElementsByTagName("input");
    for (input of inputs){
        input.addEventListener("keyup",function(e){
           if (e.target.hasAttribute("error")){
               var idDivError=e.target.getAttribute("error");
               document.getElementById(idDivError).innerText=""
           }
        })
    }
    document.getElementById("form-connexion").addEventListener("submit",function(e){
        const inputs= document.getElementsByTagName("input");
        var error=false;
        for (input of inputs){
            if (input.hasAttribute("error")){
                var idDivError=input.getAttribute("error");
                if (!input.value){
                    document.getElementById(idDivError).innerText="Ce champ est obligatoire !"
                    error=true
                }
            }
        }
        // Toujours mettre le if en dehors de la boucle for
        if(error){
            e.preventDefault();
            return false;
        }
           
    })
</script>
