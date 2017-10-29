/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    function alertmessage() {
        $.ajax({
            url: '/webArena/arenas/alertmessage/',
            type: 'GET',
            dataType: 'JSON',

            success: function (response) {
                if (response.a >= 1) {
                  //  alert('vous avez ' + response.a + ' nouveaux messages');
                  var a=  '<a href=\'/webArena/messages/conversation/'+response.id1+'/'+response.id2+'\'>'+'vous avez '+response.a+' nouveau(x) message(s) de '+response.name+'</a>';
                   $('#newmessage').html(a);
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }

    setInterval(
            function () {
                alertmessage();
                  //console.log("1");
            }, 5000);

});
