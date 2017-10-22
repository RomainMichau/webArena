


$(document).ready(function () {

    
    function move(dir) {
                              


        // RÃ©cuperation de l'idServeur selectionnÃ©
        // var idServeur = $('#select_serveur').val();
        // Font icon de chargement, pendant la recherche
        //$('#site_id').html('<div class="col-md-1 col-md-offset-6 control-label"><i class="fa fa-spinner fa-spin"></i></div>');
        //$('#select_site').html('');

        // Requete ajax pour recuperer les sites ayant le serveur_id idServeur
        $.ajax({
            url: '/webArena/arenas/moveFighter/'+dir,
            type: 'GET',
            dataType: 'JSON',
            // En cas de succes, affichage des sites 
            
            success: function (response) {
             // var a= " <?php echo $x; ?> "; 
           //  alert(response.x);
            // alert(response.y);
            var a="#cid"+((response.x-1)*10+response.y);
            if(dir==1)
            var b="#cid"+((response.x-2)*10+response.y );
         if(dir==2)
            var b="#cid"+((response.x)*10+response.y );
         if(dir==3)
            var b=("#cid"+((response.x-1)*10+(response.y+1) ));
         if(dir==4)
            var b="#cid"+((response.x-1)*10+(response.y-1) );
        var c=$(a).html();
            console.log("a:"+b+"  b:"+a);
           $(a).html($(b).html());
           $(b).html(c);
            
          
        //   alert("oki");
            
            },
            // En cas d'erreur, afficher le statut et l'erreur
            error: function (jqXHR, textStatus, errorThrown) {
               
                alert(errorThrown);
            }
        });
         
    }

    $('#up').click(function () {
        move(2);
    });
    $('#down').click(function () {
        move(1);
    });
    $('#left').click(function () {
        move(3);
    });
    $('#right').click(function () {
        move(4);
    });

});