


$(document).ready(function () {


    function move(dir) {

        $.ajax({
            url: '/webArena/arenas/moveFighter/' + dir,
            type: 'GET',
            dataType: 'JSON',
            

            success: function (response) {
            
                console.log(response.success);
                if (response.success == 1) {
              //      alert("oki");
                    var a = "#cid" + ((response.x - 1) * 10 + response.y);
                    if (dir === 1)
                        var b = "#cid" + ((response.x - 2) * 10 + response.y);
                    if (dir === 2)
                        var b = "#cid" + ((response.x) * 10 + response.y);
                    if (dir === 3)
                        var b = ("#cid" + ((response.x - 1) * 10 + (response.y + 1)));
                    if (dir === 4)
                        var b = "#cid" + ((response.x - 1) * 10 + (response.y - 1));
                    var c = $(a).html();
                    console.log("a:" + b + "  b:" + a);
                    $(a).html($(b).html());
                    $(b).html(c);
                }
                      },           
            error: function (jqXHR, textStatus, errorThrown) {
               // alert(errorThrown);
            }
        });

    }
    
     function attack(dir) {

        $.ajax({
            url: '/webArena/arenas/attack/' + dir,
            type: 'GET',
            dataType: 'JSON',
            

            success: function (response) {
             //  alert("oki");
                if(response.success==1){
            $('#info').html('l attaque est un succes, vie restante'+response.health); }        //      alert(response.en);
                      },           
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

    }
    
    function detect(coord){
        var x=parseInt(coord) % 10;
        if(x==0)
            x=10;
        alert('coord: '+coord+'mod: '+x);
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
    $('#aup').click(function () {
        attack(2);
    });
    $('#adown').click(function () {
        attack(1);
    });
    $('#aleft').click(function () {
        attack(3);
    });
    $('#aright').click(function () {
        attack(4);
    });
        $('.case').hover(function () {
            
        a=this.id;
        a=a.replace('cid','');
     //   alert((parseInt(a)+1) );
        detect((parseInt(a)));
    });
    });