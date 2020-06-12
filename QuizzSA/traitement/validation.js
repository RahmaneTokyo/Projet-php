// Login validation

    // Hiding error message

    $("#login_error").hide();
    $("#pwd_error").hide();

    var error_login = false;
    var error_pwd = false;

    // Functions

    function check_login() {
        var login_length = $("#login").val().length;
        if(login_length < 1) {
            $("#login_error").html("This field is required!");
            $("#login_error").show();
            error_login = true;
        }else {
            $("#login_error").hide();
        }
    }

    function check_pwd() {
        var pwd_length = $("#pwd").val().length;
        if(pwd_length < 1) {
            $("#pwd_error").html("This field is required!");
            $("#pwd_error").show();
            error_pwd = true;
        }else {
            $("#pwd_error").hide();
        }
    }

    // Events

    $("#login").focusout(function() {
        check_login();
    });

    $("#pwd").focusout(function() {
        check_pwd();
    });

    $("#form").submit(function() {
        error_login = false;
        error_pwd = false;

        check_login();
        check_pwd();

        if(error_login == false && error_pwd == false) {
            return true;
        }else {
            return false;
        }
    });

// Image output

var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src)
    }
}

// player register Validation

    // Hiding error message

    $("#firstname_error").hide();
    $("#lastname_error").hide();
    $("#login_error").hide();
    $("#pwd_error").hide();
    $("#confirm_error").hide();

    var error_firstname = false;
    var error_lastname = false;
    var error_login = false;
    var error_pwd = false;
    var error_confirm = false;

    // Functions

    function check_firstname() {
        var firstname_length = $("#firstname").val().length;
        if(firstname_length < 1) {
            $("#firstname_error").html("This field is required!");
            $("#firstname_error").show();
            error_firstname = true;
        }else {
            $("#firstname_error").hide();
        }
    }
    function check_lastname() {
        var lastname_length = $("#lastname").val().length;
        if(lastname_length < 1) {
            $("#lastname_error").html("This field is required!");
            $("#lastname_error").show();
            error_lastname = true;
        }else {
            $("#lastname_error").hide();
        }
    }
    function check_login() {
        var login_length = $("#login").val().length;
        if(login_length < 1) {
            $("#login_error").html("This field is required!");
            $("#login_error").show();
            error_login = true;
        }else {
            $("#login_error").hide();
        }
    }
    function check_pwd() {
        var pwd_length = $("#pwd").val().length;
        if(pwd_length < 1) {
            $("#pwd_error").html("This field is required!");
            $("#pwd_error").show();
            error_pwd = true;
        }else {
            $("#pwd_error").hide();
        }
    }
    function check_confirm() {
        var pwd = $("#pwd").val();
        var confirm = $("#confirm").val();

        if(pwd != confirm) {
            $("#confirm_error").html("Password doesn't match!");
            $("#confirm_error").show();
            error_confirm = true;
        }else {
            $("#confirm_error").hide();
        }
    }

    // Events

    $("#firstname").focusout(function() {
        check_firstname();
    });
    $("#lastname").focusout(function() {
        check_lastname();
    });
    $("#login").focusout(function() {
        check_login();
    });
    $("#pwd").focusout(function() {
        check_pwd();
    });
    $("#confirm").focusout(function() {
        check_confirm();
    });
    $("#submit").click(function() {

        error_firstname = false;
        error_lastname = false;
        error_login = false;
        error_pwd = false;
        error_confirm = false;

        check_firstname();
        check_lastname();
        check_login();
        check_pwd();
        check_confirm();

        if(error_firstname == false && error_lastname == false && error_login == false && error_pwd == false && error_confirm == false) {
            return true;
        }else {
            return false;
        }
    });

    // Change color on link when click on

    $(document).ready(function(){

        $('a').click(function(){
            $('a').css('color', '#A44545');
            $('a').css('background-color', 'rgba(196, 196, 196, 0.8)');

            $(this).css('color', 'white');
            $(this).css('background-color', '#A44545');

            $('#link').css('background-color', '#A44545');
            $('#link').css('color', 'white');
        });

    });

    // Load pages without refreshing page in admin

    $(document).ready(function() {
        $("#listequestion").on("click",function() {
            const listequestion = $("#content");

            listequestion.html("");
            listequestion.load("pages/listequestions.php");
        });
        $("#creeradmin").on("click",function() {
            const creeradmin = $("#content");

            creeradmin.html("");
            creeradmin.load("pages/creeradmin.php");
        });
        $("#listejoueur").on("click",function() {
            const listejoueur = $("#content");

            listejoueur.html("");
            listejoueur.load("pages/listejoueurs.php");
        });
        $("#creerquestion").on("click",function() {
            const creerquestion = $("#content");

            creerquestion.html("");
            creerquestion.load("pages/creerquestion.php");
        });
        $("#listeadmin").on("click",function() {
            const listeadmin = $("#content");

            listeadmin.html("");
            listeadmin.load("pages/listeadmins.php");
        });

    });