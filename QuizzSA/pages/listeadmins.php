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
            url:'./data/sql_liste_admins.php',
            type: 'post',
            dataType: 'json',
            data:{
                limit: 2,
                offset: offset
            },
            success: function (data) {
                showData(data, tbody);
                offset+=2;
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
                    url:'./data/sql_liste_admins.php',
                    data:{
                        limit: 2,
                        offset: offset
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        showData(data, tbody);
                        offset+=2;
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
                    url:'./data/delete_admin.php',
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



    });
</script>