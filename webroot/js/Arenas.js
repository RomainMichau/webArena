


$(document).ready(function () {

    
    function move() {
                            


        // RÃ©cuperation de l'idServeur selectionnÃ©
        // var idServeur = $('#select_serveur').val();
        // Font icon de chargement, pendant la recherche
        //$('#site_id').html('<div class="col-md-1 col-md-offset-6 control-label"><i class="fa fa-spinner fa-spin"></i></div>');
        //$('#select_site').html('');

        // Requete ajax pour recuperer les sites ayant le serveur_id idServeur
        $.ajax({
            url: "<?php echo $this->webroot . $this->params[Arenas]; ?>/testAjax",
           
            type: 'GET',
            dataType: 'JSON',
            // En cas de succes, affichage des sites 
            success: function (response) {
                // RÃ©cuperation du site
                jConfirm('Can you confirm this?', 'Confirmation Dialog', function (r) {
                    jAlert('Confirmed: ' + response, 'Confirmation Results');
                });
                // Si aucun site  n'est recupÃ©rÃ©
             

            },
            // En cas d'erreur, afficher le statut et l'erreur
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus);
                alert(errorThrown);
            }
        });
    }

    $('#up').click(function () {
        move();
    });

});