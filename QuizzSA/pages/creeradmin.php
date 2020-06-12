<div class="container zone-form" id="red">
        <img id="output" class="avatar">
        <form class="container form" id="form" method="post" enctype="multipart/form-data">
            <div id="div">dvsdvds</div>
            <div class="form-group form-controller">
                <input type="text" name="firstname" id="firstname" placeholder="First Name">
                <small id="firstname_error"></small>
            </div>
            <div class="form-group form-controller">
                <input type="text" name="lastname" id="lastname" placeholder="Last Name">
                <small id="lastname_error"></small>
            </div>
            <div class="form-group form-controller">
                <input type="text" name="login" id="login" placeholder="Login">
                <small id="login_error"></small>
            </div>
            <div class="form-group form-controller">
                <input type="password" name="pwd" id="pwd" placeholder="Password">
                <small id="pwd_error"></small>
            </div>
            <div class="form-group form-controller">
                <input type="password" name="confirm" id="confirm" placeholder="Confirm Password">
                <small id="confirm_error"></small>
            </div>
            <div class="creer">
                <div class="fichier">
                    <label for="file" class="label-file">Choisir un fichier</label>
                    <input type="file" id="file" class="choisir" name="image" accept="image/*" onchange="loadFile(event)">
                </div>
                <button type="button" id="submit" name="submit">Creer compte</button>
            </div>
        </form>
    </div>
</div>

<script src="./traitement/jquery-3.5.1.js"></script>
<!-- <script src="./traitement/validation.js"></script> -->

<script>
    $('#submit').click(function(){
        var firstname= $('#firstname').val();
        var lastname= $('#lastname').val();
        var login= $('#login').val();
        var pwd= $('#pwd').val();
        var confirm= $('#confirm').val();

        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file',files); // key-name 'file' is use in AJAX file to retrieve data $_FILES['file']
        $.ajax({
            type: "POST",
            url: "./data/register.php",
            //data: $('form').serialize(),
            data: {firstname:firstname,lastname:lastname,login:login,pwd:pwd,confirm:confirm,fd},
            /* dataType: "JSON", */
            success: function (data) {
                if(data){
                    $('#red').load('pages/listejoueurs.php'); 
                    /* 
                    OU BIEN
                    $('#tbody').append(`
                    <tr class="text-center">
                        <td>nouvelleHeure</td>
                        <td>nouveauTel</td>
                        <td>nouveauMont</td>
                    </tr>
                `)*/
                }
            }
        });
        // var firstname= $('#firstname').val();
        // var lastname= $('#lastname').val();
        // var login= $('#login').val();
        // var pwd= $('#pwd').val();
        // var confirm= $('#confirm').val();
        // // var image= $('#file').val();
        // $.post("./data/register.php",{firstname:firstname,lastname:lastname,login:login,pwd:pwd,confirm:confirm},function(data){
        //     alert('ok')
        //     $('#firstname').val('');
        //     $('#lastname').val('');
        //     $('#login').val('');
        //     $('#pwd').val('');
        //     $('#confirm').val('');
        //     $("#div").text(data);

        // });
    });
</script>