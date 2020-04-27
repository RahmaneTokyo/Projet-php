<div class="fond">
    <div class="head"> PARAMÉTREZ VOTRE QUESTION</div>
    <div class="encadrer">
        <form action="" method="post" id="form-connexion">
            <div class="zone1">
                <div class="error" id="error-1"></div>
                <label class="q1"> Questions </label>
                <input class="zoner1" type="text" name="question" error="error-1" id="question">
            </div>
            <div class="zone2">
                <label class="q2"> Nbre de Points </label>
                <input class="point" type="number" min="1" value="1">
            </div>
            <div id="inputs">
                <div class="zone3" id="row_0">
                    <label class="q3"> Type de réponse </label>
                    <div class="select-style">
                        <select id="plus" onchange="supprime()">
                            <option value="" selected>Choisir un type de réponse</option>
                            <option value="texte">Texte</option>
                            <option value="simple">Choix simple</option>
                            <option value="multiple">Choix multiple</option>
                        </select>
                    </div>
                    <button class="plus" type="button" onclick="addInput()" id="boutonplus"><img src="./public/Icônes/ic-ajout-réponse.png"></button>
                    <div id="inputs2"></div>
                </div>
                <button class="inside" type="submit" name="enregistrer" > Enregistrer </button>
            </div>
        </form>
    </div>
</div>

<script>
    var nbrRow = 0;
    function addInput() {
        nbrRow++;
        var divInputs = document.getElementById('inputs2');
        var newInput = document.createElement('div');
        var selectOptions = document.getElementById('plus');
        var boutonPlus = document.getElementById('boutonplus');
        newInput.setAttribute('class','zone-saisie');
        newInput.setAttribute('id','row_'+nbrRow);
        if (selectOptions.value==="multiple") {
            if (boutonPlus.style.display="none") {
                boutonPlus.style.display="block";
            }
            newInput.innerHTML = `
                <label class="reponse"> Réponse ${nbrRow} </label>
                <input type="text" class="saisiee">
                <input type="checkbox" class="checkbox">
                <button type="button" class="delete" onclick="deleteInput(${nbrRow})"><img src="./public/Icônes/ic-supprimer.png"></button>
            `;
            divInputs.appendChild(newInput);
            
        }
        if(selectOptions.value==="texte") {
            newInput.innerHTML = `
                <label class="reponse"> Réponse ${nbrRow} </label>
                <input type="text" class="saisiee">
                <button type="button" class="delete" onclick="deleteInput(${nbrRow})"><img src="./public/Icônes/ic-supprimer.png"></button>
            `;
            divInputs.appendChild(newInput);
            boutonPlus.style.display="none";
        }
        if(selectOptions.value==="simple") {
            newInput.innerHTML = `
                <label class="reponse"> Réponse ${nbrRow} </label>
                <input type="text" class="saisiee">
                <input type="radio" class="radio">
                <button type="button" class="delete" onclick="deleteInput(${nbrRow})"><img src="./public/Icônes/ic-supprimer.png"></button>
            `;
            divInputs.appendChild(newInput);
            boutonPlus.style.display="flex";
        }
    }
    function deleteInput(n) {
        var target = document.getElementById('row_'+n);
        setTimeout(function() {
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
</script>
    
<script src="public/js/validation.js">
</script>
