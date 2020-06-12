<!-- <div id="scrollZone" class="container">
    <table class="table table-striped">
        <thead>
            <tr class="text-center">
                <th>Prenom</th>
                <th>Nom</th>
                <th>Score</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <tr class="text-center">
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
            </tr>
        </tbody>
    </table>
</div> -->

<!-- <script>
    $(document).ready(function(){
        
        let offset = 0;
        const tbody = $('#tbody');
        
        $.ajax({
                type: "POST",
                url: "http://localhost/QuizzSA/data/sql_liste_joueurs.php",
                data: {limit:2,offset:offset},
                dataType: "JSON",
                success: function (data) {
                    /* console.log(data); */
                    tbody.html(''); // Permet de vider les 3 points définis par defaut dans le code html
                    printData(data,tbody);
                    offset +=7;
                }
            });

        //  Scroll
        const scrollZone = $('#scrollZone')
        scrollZone.scroll(function(){
            //console.log(scrollZone[0].clientHeight)
            const st = scrollZone[0].scrollTop;
            const sh = scrollZone[0].scrollHeight;
            const ch = scrollZone[0].clientHeight;

            console.log(st,sh,ch);
            
            if(sh-st <= ch){
                $.ajax({
                    type: "POST",
                    url: "../data/sql_liste_joueurs.php",
                    data: {limit:2,offset:offset},
                    dataType: "JSON",
                    success: function (data) {
                        printData(data,tbody);
                        offset +=7;
                    }
                });
            }
            
        })
    });
    /* var id_joueur = 0; */
    function printData(data,tbody){
        /* id_joueur++; */
        $.each(data, function(indice,utilisateur){
            tbody.append(`
                <tr class="text-center">
                    <td>${utilisateur.prenom}</td>
                    <td>${utilisateur.nom}</td>
                    <td>${utilisateur.score}</td>
                </tr>
            `); // valeurs à ajouter à la place des 3 points
        });
    }
</script> -->

        <!-- <div class="modal text-center" id="myModal">
      <div class="modal-dialog">
          <div class="modal-content">


              <div class="modal-header">
                  <h7 class="modal-title">Modify</h7>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>


              <div class="modal-body">
                  <form>
                      <div class="form-group">
                          <input type="hidden" class="form-control" id="idU" name="idu">
                      </div>
                      <div class="form-group">
                          <label for="fn">Firstname</label>
                          <input type="text" class="form-control" id="firstname" name="firstname">
                      </div>
                      <div class="form-group">
                          <label for="ln">Lastname</label>
                          <input type="text" class="form-control" id="lastname" name="lastname">
                      </div>
                  </form>
              </div>


              <div class="modal-footer">
                  <button type="button"  class="btn btn-info" id="modif">Modify</button>

              </div>

          </div>
      </div>
  </div> -->





<div id="scrollzone" class="col">
    <table class="table table-bordered text-center">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col">Score</th>
            <th scope="col">login</th>
            <th scope="col"colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody id="tbody">

        </tbody>
    </table>
</div>



<script>
    $(document).ready(function() {

        let offset= 0;
        let tbody= $('#tbody');
        $.ajax({
            url:'./data/sql_liste_joueurs.php',
            type: 'post',
            dataType: 'json',
            data:{
                limit: 7,
                offset: offset
            },
            success: function (data) {
                showData(data, tbody);
                offset+=7;
            }
        });

        // Fonction qui affiche les joueurs dans la page

        function showData(data, tbody) {
            $.each(data, (indice, utilisateur)=> {
                tbody.append(`<tr>
                    <td>${utilisateur.prenom}</td>
                    <td>${utilisateur.nom}</td>
                    <td>${utilisateur.score}</td>
                    <td style="display:none;">${utilisateur.login}</td>
                    <td><button type="button" class="btn btn-outline-primary"id="mdf" data-toggle="modal" data-target="#myModal">Modify</button></td>
                    <td><button type="button" class="btn btn-outline-danger" id="dlt">Delete</button></td>
                </tr>`);
            })
        }

        // Fonction qui permet la pagination par scroll

        const scrollzone= $('#scrollzone');
        scrollzone.scroll(function () {
            const st= scrollzone[0].scrollTop;
            const sh= scrollzone[0].scrollHeight;
            const ch= scrollzone[0].clientHeight;
            if (sh-st<= ch){
                $.ajax({
                    type:'post',
                    url:'./data/sql_liste_joueurs.php',
                    data:{
                        limit: 7,
                        offset: offset
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        showData(data, tbody);
                        offset+=7;
                    }
                });
            }
        });

        // Fonction qui permet de supprimer un joueur

        $(document).on('click','#dlt',function () {
            if (confirm("Do you want to delete?")){ // demande une confirmation de suppression
                $(this).parents("tr").remove(); // récupère le div parent à supprimer
                let login= $(this).parents('tr').find('td').eq(3).html(); // supprime le td du tr parent selectionné comportant le login
               
                $.ajax({
                    type:'post',
                    url:'./data/delete_joueur.php',
                    dataType:'html',
                    data:{
                        login: login
                    },
                    success:function (data) {
                        alert(data);
                        if (data==="ok"){
                            alert('Successful deletion');
                        }
                    }
                });
            }
        });

        // Fonction qui modifie le joueur

        /* $(document).on("click","#modif", function() {
                let firstname=$('#firstname').val();
                let lastname=$('#lastname').val();
                let login=utilisateur.login;
                $.ajax({
                    url:'../Traitement/modifyPlayer.php',
                    type:'post',
                    data:{
                        firstname:firstname,
                        lastname:lastname,
                        idu:idu
                    },
                    dataType:'html',
                    success:function (data) {
                            alert('Modification carried out successfully');
                    }
                });
            }); */

    });
</script>