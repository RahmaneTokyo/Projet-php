<div class="container h-100">
    <form id="questions">
    <div class="row zone-question mb-3 ">
        <div class="col-lg-3 text-question">
            Questions
        </div>
        <div class="col-lg-9">
            <div class="form-group">
                <input id="nbrInput" type="hidden" name="nbrInput">
                <textarea class="form-control champ-question" name="question" id="area"></textarea>
            </div>
        </div>
    </div>
    <div class="row zone-point mb-3 ">
        <div class="col-lg-3 text-point">
            Nbr de Points
        </div>
        <div class="col-lg-9">
            <div class="form-group">
                <input class="champ-point text-center" type="number" name="point" min="1" id="nbr">
            </div>
        </div>
    </div>
    <div class="row type-reponse mb-2 mb-2 ">
        <div class="col-lg-3 text-type">
            Type de Response
        </div>
        <div class="col-lg-8 ">
            <div class="form-group">
                <select class="custom-select champ-type" name="type" id="select">
                    <option value="" selected>Donnez le type de réponse</option>
                    <option value="texte">Texte</option>
                    <option value="simple">Choix Simple</option>
                    <option value="multiple">Choix Multiple</option>
                </select>
            </div>
        </div>
        <div class=" col-lg-1">
            <button style="background: transparent; border:0px; " id="addInput" class="mt-4" type="button"><span class="iconify btn-select" data-icon="ant-design:plus-square-filled" data-inline="false" style="color: #A44545;"></span></button>
        </div>
    </div>
        <div class="align-items-center zone-reponse justify-content-between mb-4" id="inputadded">

        </div>
    <div class="float-right">
        <button type="button" id="enregistrer" class="btn-enregistrer">Enregistrer</button>
    </div>
    </form>
</div>





<script>

$('#enregistrer').on('click',function (e) {
        if ($('.form').val()==""){
            $('.form').css('borderColor','red');
            e.preventDefault();
        }
    });

    $(document).ready(function () {
        let nbr=0;
        $('#select').change(function () {
            $('#addInput').show();
            nbr=0;
        $('.add').remove();
        });

        $('#addInput').click(function () {
            nbr++;
            let choix = $('#select').val();
            var inputs = $('#inputadded');
            $('#nbrInput').attr('value',nbr);
            if (choix === "simple") {
                inputs.append(`<div class="add mb-2"><input class="text-center champ-reponse" type="text" name="response_${nbr}" class="form valeur"/><input type="radio" class="check" name="radio" value="response_${nbr}"/> <a href="#" class="remove_field text-delete">Delete</a></div>`); //add input box
            } else if (choix === "multiple") {
                inputs.append(`<div  class="add mb-2"><input class="text-center champ-reponse" type="text" name="response_${nbr}" class="form valeur"/> <input class="check" type="checkbox" name="checkbox_${nbr}"/> <a href="#" class="remove_field text-delete">Delete</a></div>`); //add input box
            } else if (choix === "texte") {
                $('#addInput').hide();
                inputs.append(`<div  class="add mb-2"><input class="text-center champ-reponse" type="text" name="response_${nbr}" class="form valeur"/><a href="#" class="remove_field text-delete">Delete</a></div>`); //add input box
            }
        });
        $(document).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            nbr=nbr-1;
        });
        $('#enregistrer').click(function () {
           let sr= $('#questions').serialize();
            $.ajax({
                type:'post',
                url:'./data/saveQuestion.php',
                dataType:'html',
                data:sr,
                success:function (data) {
                    console.log(sr);
                    alert(data);
                }
            })
        })
    });


</script>