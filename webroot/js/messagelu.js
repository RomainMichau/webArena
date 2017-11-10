/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    
    
    

      // 
        //  alert($(this).css("background-color"));
                //alert($('.autre')[0].id);
                if($('.autre').length>0){
                var i=$('.autre')[0].id;
                
// alert("oki");
          
             $.ajax({
            url: ''+link+'/arenas/messagelu/'+i,
            type: 'GET',
            dataType: 'JSON',

            success: function (response) {
   //alert("ok");
             
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        
        });

                }



});


