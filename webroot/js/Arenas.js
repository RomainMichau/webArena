


$(document).ready(function () {
var a;
    
    function move(dir) {
        

        $.ajax({
            url: '/webArena/arenas/moveFighter/' + dir,
            type: 'GET',
            dataType: 'JSON',

            success: function (response) {
                console.log($($x));

              //   console.log(response.success);
                if (response.success == 1) {
                    //      alert("oki");
                    var a = "#cid" + ((response.x - 1) * 10 + response.y);
                    if (dir === 1)  {
                        var b = "#cid" + ((response.x - 2) * 10 + response.y);
                        }
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
                 ;
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
                //    console.log("r:"+response.r+" f:"+response.f);
                if (response.success == 1) {
                    $('#info').html('l attaque est un succes, vie restante de l\'ennemi' + response.health);
                    var a = 'cid' + (response.y + (response.x - 1) * 10);
                    // console.log(a);
                    var save = $('#' + a).html();
                    $('#' + a).html(' <img src="/webArena/img/attack.gif" alt="Not found" width="42" height="35"> ');
                    var i;
                    
                    setTimeout(function () {
                        $('#' + a).html(save);

                    }, 900);

                }        //      alert(response.en);
                else {
                    $('#info').html('l\'attaque est un echec');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

    }

    function detect(coord) {
        var x = parseInt(coord) % 10;
        if (x == 0)
            x = 10;
        var y = parseInt(coord) / 10;
        y = Math.trunc(y) + 1;
        // console.log('x'+x+'y'+y);
        $.ajax({
            url: '/webArena/arenas/detect/' + coord,
            type: 'GET',
            dataType: 'JSON',

            success: function (response) {
                if (response.success == 1 && response.type == 1) {
                    console.log("oki");
                    $('#info2').html('nom:' + response.obj.name + ' level:' + response.obj.level + ' xp:' + response.obj.xp);
                }

               else if (response.success == 1 && response.type == 2) {
                    console.log("oki");
                    $('#info2').html('nom:' + response.obj.type);
                }
                      else{
                           $('#info2').html('');
                      }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

    }

function supsst() {
       
        $.ajax({
            url: '/webArena/arenas/skillStrengthUp/',
            type: 'GET',
            dataType: 'JSON',

            success: function (response) {
              $('#psst').text(parseInt($('#psst').text())+1);
              $('#skil').text(parseInt($('#skil').text())-1);$(lvl).text(parseInt($('#lvl').text())+1);
               if( $('#skil').text()=='0'){
                //   console.log($('#bsh').html());
                    $('#bsh').html('');
                    $('#bssi').html('');
                    $('#bsst').html('');
                    
                 }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

    }
function supssi() {
       
        $.ajax({
            url: '/webArena/arenas/skillSightUp/',
            type: 'GET',
            dataType: 'JSON',

            success: function (response) {
              $(pssi).text(parseInt($('#pssi').text())+1); $('#lvl').text(parseInt($('#lvl').text())+1);
                            $('#skil').text(parseInt($('#skil').text())-1);
                 if( $('#skil').text()=='0'){
                //   console.log($('#bsh').html());
                    $('#bsh').html('');
                    $('#bssi').html('');
                    $('#bsst').html('');
                    
                 }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

    }
    
    function supsh() {
       
        $.ajax({
            url: '/webArena/arenas/skillHealthUp/',
            type: 'GET',
            dataType: 'JSON',

            success: function (response) {
              $('#psh').text(parseInt($('#psh').text())+1);$('#lvl').text(parseInt($('#lvl').text())+1);
                            $('#skil').text(parseInt($('#skil').text())-1);
                             if( $('#skil').text()=='0'){
                //   console.log($('#bsh').html());
                    $('#bsh').html('');
                    $('#bssi').html('');
                    $('#bsst').html('');
                    
                 }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

    }
    

    $('#up').click(function () {  if(a==1){
        
      
        a=0;
        //console.log(a);
        move(2);}
    });
    $('#down').click(function () {  if(a==1){
        move(1);  a=0;}
    });
    $('#left').click(function () {  if(a==1){
        move(3);  a=0;}
    });
    $('#right').click(function () {  if(a==1){
        move(4);  a=0;}
    });
    $('#aup').click(function () {  if(a==1){
        attack(2);
        a=0;}
    });
    $('#adown').click(function () {  if(a==1){
        attack(1);  a=0;}
    });
    $('#aleft').click(function () {  if(a==1){
        attack(3);  a=0;}
    });
    $('#aright').click(function () {  if(a==1){
        attack(4);  a=0;}
    });
    $('.case').click(function ()   {
        a = this.id;
        a = a.replace('cid', '');
        b = $('#' + this.id).html();
        b = b.replace(/\n|\r|(\n\r)/g, '');
        if (b !== '                 <div class="vide"></div>             ') {

            detect(a);
        } else {
            if ($('#info2').html !== '') {
                $('#info2').html('');
            }
        }
        
    });
    
    $('#sh').click(function () {
        supsh();
    });
     
     $('#ssi').click(function () {  
        supssi();
    });
     $('#sst').click(function () {
        
        supsst();
    });
    
    setInterval(function(){a=1},600);
    
});