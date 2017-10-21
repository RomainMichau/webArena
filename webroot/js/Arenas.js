/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
*/

$(document).ready(function() {

	/**
	 * Function selectSite
	 * Creation du select de sites en fonction du serveur selectionnÃ©
	 * @return string : select html avec sites si des sites existent pour ce serveur sinon message 
	 */
	function move() {
		
		// RÃ©cuperation de l'idServeur selectionnÃ©
	   // var idServeur = $('#select_serveur').val();
	    // Font icon de chargement, pendant la recherche
	   	//$('#site_id').html('<div class="col-md-1 col-md-offset-6 control-label"><i class="fa fa-spinner fa-spin"></i></div>');
	   	//$('#select_site').html('');
	   	
	   	// Requete ajax pour recuperer les sites ayant le serveur_id idServeur
	   	$.ajax({
		    url: varGlobaleRacine + 'Sites/getSites/' + idServeur,
		    type: 'GET',
		    dataType: 'JSON',
		    // En cas de succes, affichage des sites 
		    success: function (response) {
			    // RÃ©cuperation du site
		    	sites = response.sites;
		    	// Si aucun site  n'est recupÃ©rÃ©
		    	if(sites.length == 0){
		    		$('#site_id').html('<label class="col-md-9 col-md-offset-3">Aucun site crÃ©Ã© pour le moment</label>');
		    	// Sinon, select de tous les sites
		    	}else{
		    		$('#site_id').html(
		    			'<label class="control-label col-md-3" for="select_serveur">Site</label>' +
			    		'<div class="col-md-9">'+
			    			'<select name="site_id" id="select_site" class="form-control">' +
			    				'<option value="">--- Selectionner un site ---</option>');

					    		//Parcours de tous les sites recupÃ©rÃ©s
						    	$.each(sites, function( index, value ) {
						    		//option avec comme index l'id du site et comme value le name du site 
									$('#select_site').append('<option value="' + index + '" >' + value + '</option>');
								});

				    		// Fermeture du select, de la colonne et du form-group
				        	$('#site_id').append(
				        	'</select>' +
				        '</div>');
		    	}

		    },
		    // En cas d'erreur, afficher le statut et l'erreur
		    error:function(jqXHR, textStatus, errorThrown){
		            alert(textStatus);
					alert(errorThrown);
		    }
		});
	}

	$('#select_serveur').change(function(event) {
		selectSite();
	});
	
});