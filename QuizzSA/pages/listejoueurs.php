
        <!-- <div class="modal text-center" id="myModal">
      <div class="modal-dialog">
          <div class="modal-content">


              <div class="modal-header">
                  <h4 class="modal-title">Modify</h4>
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




<div class="container d-flex align-items-center justify-content-center entete-joueur"> Liste des joueurs par score</div>
<div id="scrollzone" class="col">
    <table style="border:0px;" class="table table-bordered text-center">
    <div class=" menu-entete" scope="col">Prenom</div>
            <div class=" menu-entete" scope="col">Nom</div>
            <div class=" menu-score" scope="col">Score</div>
            <div class="text-center menu-action" scope="col" colspan="2">Actions</div>
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
                tbody.append(`<tr style="border:0px;">
                    <th class=" liste-joueur" style="border:0px;">${utilisateur.prenom}</th>
                    <th class=" liste-joueur" style="border:0px;">${utilisateur.nom}</th>
                    <th class=" liste-joueur" style="border:0px;">${utilisateur.score} Pts</th>
                    <th style="display:none;">${utilisateur.login}</th>
                    <th class="action-button" style="border:0px;"><button type="button" class="btn text-primary"id="mdf" data-toggle="modal" data-target="#myModal">Modify</button></th>
                    <th class="action-button" style="border:0px;"><button type="button" class="btn text-danger" id="dlt">Delete</button></th>
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
                let login= $(this).parents('tr').find('th').eq(3).html(); // supprime le td du tr parent selectionné comportant le login
               
                $.ajax({
                    type:'post',
                    url:'./data/delete_joueur.php',
                    dataType:'html',
                    data:{
                        login: login
                    },
                    success:function (data) {
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