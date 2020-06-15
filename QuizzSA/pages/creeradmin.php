<div class="container zone-form" id="red">
        <img id="output" class="avatar">
        <small class="pl-4" id="aint"></small>
        <form class="container form" id="form" method="post" action="./data/register_admin.php" enctype="multipart/form-data">
            <div class="form-group form-controller">
                <input type="text" name="firstname" id="firstname" class="field" placeholder="First Name">
            </div>
            <div class="form-group form-controller">
                <input type="text" name="lastname" id="lastname" class="field" placeholder="Last Name">
            </div>
            <div class="form-group form-controller">
                <input type="text" name="login" id="login" class="field" placeholder="Login">
            </div>
            <div class="form-group form-controller">
                <input type="password" name="pwd" id="pwd" class="field" placeholder="Password">
            </div>
            <div class="form-group form-controller">
                <input type="password" name="confirm" id="confirm" class="field" placeholder="Confirm Password">
            </div>
            <div class="creer">
                <div class="fichier">
                    <label for="file" class="label-file">Choisir un fichier</label>
                    <input type="file" id="file" class="choisir" name="file" accept="image/*" onchange="loadFile(event)">
                </div>
                <button  id="submit" name="submit">Creer compte</button>
            </div>
        </form>
    </div>

<script>
    $(document).ready(function(){

        var $firstname = $('#firstname'),
            $lastname= $('#lastname'),
            $login= $('#login'),
            $pwd = $('#pwd'),
            $confirm = $('#confirm'),
            $file= $('#file');

            $(document).on('keyup','.field',function(){ // Lorsqu'on saisit sur un input
                if($(this).val().length < 1){ // si la chaîne de caractères est inférieure à 5
                    $(this).css({ // on rend le champ rouge
                        borderColor : 'red',
                        color : 'red'
                    });
                }
                else{
                    $(this).css({ // si tout est bon, on le rend vert
                        borderColor : 'green',
                        color : 'green'
                    });
                }
            });

            $(document).on('click','#submit',function(e){
                let arrayinput=[$firstname,$lastname,$login,$pwd,$confirm,$file];
                arrayinput.forEach(input=>{
                    if(input.val() === ""){ // Si le champ est vide
                        $("#aint").html("Fill all mandatory fields an upload an image !").css({color: 'red', display:'block'}); 
                        input.css({ // on rend le champ rouge
                            borderColor : 'red',
                            color : 'red'
                        });
                        e.preventDefault();
                    }
                });
                if($confirm.val()!== $pwd.val()){
                    $("#aint").html("password doesn't match !").css({color: 'red', display:'block'});
                    $("#confirm, #pwd").css({ // on rend le champ rouge
                        borderColor : 'red',
                        color : 'red'
                    });
                    e.preventDefault();
                }
            });

            $(document).on('keyup','#confirm',function(){
                $("#aint").css("display", "none");
            });

            $(document).on('keyup','#confirm',function(){
                $("#aint").css("display", "none");
            });

            $(document).on('click','#submit',function(){
                let form_data= new FormData(myForm);
                $.ajax({
                    url:'./data/register_admin.php',
                    processData:false,
                    dataType:false,
                    contentType:false,
                    type:'post',
                    data: form_data,
                    success: function (data) {
                        if(data === "ok"){
                            window.location.replace = "index.php?lien=admin";
                        }
                    }
                });
            });

    });
</script>