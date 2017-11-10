/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
       var link=$('.linkb')[0].id;
        
       
         link= link.replace(' ', '');
         link= link.replace('http://localhost', '');
         link= link.replace('/arenas/sight', '');
    var color = 'rgb(255, 0, 0)';
    function alertmessage() {
        $.ajax({
            url: ''+link+'/arenas/alertmessage/',
            type: 'GET',
            dataType: 'JSON',

            success: function (response) {

                var i = 0;
                if (response.tab.length >= 1) {
                    $('#pop').css('background-color', color);
                    for (i = 0; i < response.tab.length; i++) {
                        //  alert('vous avez ' + response.a + ' nouveaux messages');
                        //  var a=  '<a href=\'/webArena/messages/conversation/'+response.id1+'/'+response.id2+'\'>'+'vous avez '+response.a+' nouveau(x) message(s) de '+response.name+'</a>';
                        $('#canvas' + response.tab[i]).css('background-color', 'red');
                    }
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });
    }

    setInterval(
            function () {
                alertmessage();
                //    console.log("1");
            }, 5000);
  alertmessage();


  
});


