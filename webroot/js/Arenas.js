$(document).foundation();
$(document).ready(function () {
    var a, b;
   var link=$('.linkb')[0].id;
        
       
         link= link.replace(' ', '');
         link= link.replace('http://localhost', '');
         link= link.replace(':8888','');
         link= link.replace('/arenas/sight', '');
var sdcri = document.querySelector('#sdcri');
var sdpas = document.querySelector('#sdpas');
var sdfail= document.querySelector('#sdattack');
var sdblesse= document.querySelector('#sdblesse');
 var maxy = $('#tab').find("tr").length; 
 var maxx = $('#tab').find("td").length/maxy; 
    function tocoor(x, y) {
         //trouvé sur   https://stackoverflow.com/questions/3053503/javascript-to-get-rows-count-of-a-html-table
    //    var maxx = document.getElementById('tab').getElementsByTagName("tr").length;   //trouvé sur   https://stackoverflow.com/questions/3053503/javascript-to-get-rows-count-of-a-html-table
        //alert(maxx);
       // alert(maxy);
        if (x > maxx)
            return null;

        else if (x <= 0)
            return null;
        else if (y > maxy)
            return null;
        else if (y <= 0)
            return null;
        var a = (y - 1) * maxx + x;
        return a;
    }

    function tox(coor) {

        var x = coor % maxx;
        if (x === 0)
            x = maxx;
        return x;
    }

    function toy(coor) {
        var y = ((coor - (tox(coor))) / maxx) + 1;
        return y;
    }

    
    function cri() {
        var y = "";
        while (y == "") {
            y = prompt("entrer votre message");
        }
        if (y != null) {
            $.ajax({
                url: link+'/arenas/cri/' + y,
                type: 'GET',
                dataType: 'JSON',

                success: function (response) {
                    $('#info').html('votre cri à etait entendu');

                },
                error: function (jqXHR, textStatus, errorThrown) {
                //    alert(errorThrown);
                }
            });
        }
    }


    function move(dir) {
        var vx1, vx2, vy1, vy2, coor1, coor2;
        var b, a, i, c;
        var rx, rv, ry;
        var rnx, rny;
     
          console.log(link);
        $.ajax({
            url:  link +'/arenas/moveFighter/' + dir,
            type: 'GET',
            dataType: 'JSON',

            success: function (response) {

                if (response.success === 1) {
                    sdpas.play();

                    //      alert("oki");
                    rx = response.x;
                    ry = response.y;
                    rv = response.vue;
                    rny = response.ny;
                    rnx = response.nx;
                    a = "#cid" + tocoor(rnx, rny);
                    b = "#cid" + tocoor(rx, ry);
                    if (dir === 1) {  ///RIGHT                   

                        for (i = 1; i <= rv + 1; i++) {
                            vx1 = rx + i;   ///PARTIE CASE QUI APPARAISSE
                            vx2 = vx1;
                            vy1 = ry - rv + i - 1;
                            vy2 = ry + rv - i + 1;
                            coor1 = tocoor(vx1, vy1);
                            coor2 = tocoor(vx2, vy2);
                            $('#cid' + coor1).html(' <img src="'+link+'/img/case_vide_v.png" alt="Not found" width="42" height="35"> ');
                            $('#cid' + coor2).html(' <img src="'+link+'/img/case_vide_v.png" alt="Not found" width="42" height="35"> '); //FIN CASE QUI APPARAISSE

                            vx1 = rnx - i;   ///PARTIE CASE QUI disparaisse
                            vx2 = vx1;
                            vy1 = ry - rv + i - 1;
                            vy2 = ry + rv - i + 1;
                            coor1 = tocoor(vx1, vy1);
                            coor2 = tocoor(vx2, vy2);
                            $('#cid' + coor1).html(' <img src="'+link+'/img/case_vide_i.png" alt="Not found" width="42" height="35"> ');
                            $('#cid' + coor2).html(' <img src="'+link+'/img/case_vide_i.png" alt="Not found" width="42" height="35"> '); //FIN CASE QUI APPARAISSE
                        }



                    }
                    if (dir === 2)  ///LEFT
                        for (i = 1; i <= rv + 1; i++) {
                            vx1 = rnx + i;   ///PARTIE CASE QUI APPARAISSE
                            vx2 = vx1;
                            vy1 = ry - rv + i - 1;
                            vy2 = ry + rv - i + 1;
                            coor1 = tocoor(vx1, vy1);
                            coor2 = tocoor(vx2, vy2);
                            $('#cid' + coor1).html(' <img src="'+link+'/img/case_vide_i.png" alt="Not found" width="42" height="35"> ');
                            $('#cid' + coor2).html(' <img src="'+link+'/img/case_vide_i.png" alt="Not found" width="42" height="35"> '); //FIN CASE QUI APPARAISSE

                            vx1 = rx - i;   ///PARTIE CASE QUI disparaisse
                            vx2 = vx1;
                            vy1 = ry - rv + i - 1;
                            vy2 = ry + rv - i + 1;
                            coor1 = tocoor(vx1, vy1);
                            coor2 = tocoor(vx2, vy2);
                            $('#cid' + coor1).html(' <img src="'+link+'/img/case_vide_v.png" alt="Not found" width="42" height="35"> ');
                            $('#cid' + coor2).html(' <img src="'+link+'/img/case_vide_v.png" alt="Not found" width="42" height="35"> '); //FIN CASE QUI APPARAISSE
                        }
                    if (dir === 3)  ///UP
                        for (i = 1; i <= rv + 1; i++) {
                            vy1 = rny + i;   ///PARTIE CASE QUI APPARAISSE
                            vy2 = vy1;
                            vx1 = rx - rv + i - 1;
                            vx2 = rx + rv - i + 1;
                            coor1 = tocoor(vx1, vy1);
                            coor2 = tocoor(vx2, vy2);
                            $('#cid' + coor1).html(' <img src="'+link+'/img/case_vide_i.png" alt="Not found" width="42" height="35"> ');
                            $('#cid' + coor2).html(' <img src="'+link+'/img/case_vide_i.png" alt="Not found" width="42" height="35"> '); //FIN CASE QUI DISPARAISSE

                            vy1 = ry - i;   ///PARTIE CASE QUI apparaisse
                            vy2 = vy1;
                            vx1 = rx - rv + i - 1;
                            vx2 = rx + rv - i + 1;
                            coor1 = tocoor(vx1, vy1);
                            coor2 = tocoor(vx2, vy2);
                            $('#cid' + coor1).html(' <img src="'+link+'/img/case_vide_v.png" alt="Not found" width="42" height="35"> ');
                            $('#cid' + coor2).html(' <img src="'+link+'/img/case_vide_v.png" alt="Not found" width="42" height="35"> '); //FIN CASE QUI APPARAISSE
                        }
                    if (dir === 4)   ///DOWN
                        for (i = 1; i <= rv + 1; i++) {
                            vy1 = ry + i;   ///PARTIE CASE QUI APPARAISSE
                            vy2 = vy1;
                            vx1 = rx - rv + i - 1;
                            vx2 = rx + rv - i + 1;
                            coor1 = tocoor(vx1, vy1);
                            coor2 = tocoor(vx2, vy2);
                            $('#cid' + coor1).html(' <img src="'+link+'/img/case_vide_v.png" alt="Not found" width="42" height="35"> ');
                            $('#cid' + coor2).html(' <img src="'+link+'/img/case_vide_v.png" alt="Not found" width="42" height="35"> '); //FIN CASE QUI DISPARAISSE

                            vy1 = rny - i;   ///PARTIE CASE QUI apparaisse
                            vy2 = vy1;
                            vx1 = rx - rv + i - 1;
                            vx2 = rx + rv - i + 1;
                            coor1 = tocoor(vx1, vy1);
                            coor2 = tocoor(vx2, vy2);
                            $('#cid' + coor1).html(' <img src="'+link+'/img/case_vide_i.png" alt="Not found" width="42" height="35"> ');
                            $('#cid' + coor2).html(' <img src="'+link+'/img/case_vide_i.png" alt="Not found" width="42" height="35"> '); //FIN CASE QUI APPARAISSE
                        }

                    for (i = 0; i < response.tab.length; i++) {
                        coor1 = tocoor(response.tab[i][0], response.tab[i][1]);
                        $('#cid' + coor1).html(' <img src="'+link+'/img/' + response.tab[i][2] + '.png" alt="Not found" width="42" height="35"> ');

                    }


                    c = $(a).html();
                    $(a).html($(b).html());
                    $(b).html(c);
                    ;
                }
                if(response.action===0){
                                        $('#info').html('vous n\'avez plus de PA');

                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                 alert(errorThrown);
            }
        });

    }

    function attack(dir) {

        var save;
        var a;
        $.ajax({
            url: link+'/arenas/attack/' + dir,
            type: 'GET',
            dataType: 'JSON',

            success: function (response) {
                a = 'cid' + tocoor(response.x, response.y);
                //  alert("oki");
               

                if (response.success === 1) {

                    sdblesse.play();
                    if (response.death === 0) {

                        $('#info').html('l attaque est un succes, vie restante de ' + response.name + ':' + response.health);
                        save = $('#' + a).html();
                        $('#' + a).html(' <img src="'+link+'/img/attack.gif" alt="Not found" width="42" height="35"> ');


                        setTimeout(function () {
                            $('#' + a).html(save);
                        }, 900);
                    } else if (response.death === 1) {
                        $('#info').html('l attaque est un succes, et tue' + response.name);
                        save = ' <img src="'+link+'/img/case_vide_v.png" alt="Not found" width="42" height="35"> ';
                        $('#' + a).html(' <img src="'+link+'/img/mort.gif" alt="Not found" width="42" height="35"> ');
                        $('#canvas'+response.idennemy).html("");


                        setTimeout(function () {
                            $('#' + a).html(save);

                        }, 900);
                    }
                    if(response.cvoisin>0){
                         $('#info').html($('#info').html()+' avec l\'aide de '+response.cvoisin+' membre(s) de votre guilde');
                    }

                } else if (response.ennemy === 1) {
                        sdfail.play();
                    $('#info').html(response.name + ' esquive le coup');
                    save = $('#' + a).html();
                    $('#' + a).html(' <img src="'+link+'/img/stop.jpg" alt="Not found" width="42" height="35"> ');
                    setTimeout(function () {
                        $('#' + a).html(save);

                    }, 900);
                } else if (response.ennemy === 0) { sdfail.play();
                       
                    $('#info').html('vous attaquez dans le vent');
                }
                if (response.action === 0 &&response.ennemy!==0) {
                    $('#info').html('vous avez depensé tout vos PA');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });

    }

    function detect(coord) {
        var y = toy(coord);

        var x = tox(coord);


        //    $x = floor($coord / 10) + 1;
        $.ajax({
            url: ''+link+'/arenas/detect/' + coord,
            type: 'GET',
            dataType: 'JSON',

            success: function (response) {
                if (response.success === 1 && response.type === 1) {
                    $('#info2').html('x:'+x+' y:'+y+' nom:' + response.obj.name + ' level:' + response.obj.level + '  life:' + response.obj.current_health + '  xp:' + response.obj.xp+ '  shight:' + response.obj.skill_sight+ '  strenght:' + response.obj.skill_strength);
                        } else if (response.success === 1 && response.type === 2) {
                    $('#info2').html('x:'+x+' y:'+y+' nom:' + response.obj.type);
                } else {
                    $('#info2').html('x:'+x+' y:'+y);
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });

    }

    function supsst() {

        $.ajax({
            url: ''+link+'/arenas/skillStrengthUp/',
            type: 'GET',
            dataType: 'JSON',

            success: function (response) {
                $('#psst').text(parseInt($('#psst').text()) + 1);
                $('#skil').text(parseInt($('#skil').text()) - 1);
                $(lvl).text(parseInt($('#lvl').text()) + 1);
                if ($('#skil').text() == '0') {
                    $('#bsh').html('');
                    $('#bssi').html('');
                    $('#bsst').html('');

                }
            },
               error: function (jqXHR, textStatus, errorThrown) {
            }
        });

    }
    function supssi() {

        $.ajax({
            url: ''+link+'/arenas/skillSightUp/',
            type: 'GET',
            dataType: 'JSON',

            success: function (response) {
                $(pssi).text(parseInt($('#pssi').text()) + 1);
                $('#lvl').text(parseInt($('#lvl').text()) + 1);
                $('#skil').text(parseInt($('#skil').text()) - 1);
                if ($('#skil').text() == '0') {
                    $('#bsh').html('');
                    $('#bssi').html('');
                    $('#bsst').html('');

                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });

    }

    function supsh() {

        $.ajax({
            url: ''+link+'/arenas/skillHealthUp/',
            type: 'GET',
            dataType: 'JSON',

            success: function (response) {
                $('#psh').text(parseInt($('#psh').text()) + 1);
                $('#lvl').text(parseInt($('#lvl').text()) + 1);
                $('#skil').text(parseInt($('#skil').text()) - 1);
                $('#vie').text(parseInt($('#psh').text()));
                if ($('#skil').text() === '0') {
                    $('#bsh').html('');
                    $('#bssi').html('');
                    $('#bsst').html('');

                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });

    }


    $('#up').click(function () {
        if (a == 1) {

            a = 0;
            move(3);
        }
    });
    $('#down').click(function () {
        if (a == 1) {           

            move(4);
            a = 0;
        }
    });
    $('#left').click(function () {
        if (a == 1) {            
            move(2);
            a = 0;
        }
    });
    $('#right').click(function () {
        if (b == 1) {
            
            b = 0;
            move(1);
            a = 0;
        }
    });
    $('#aup').click(function () {
        if (b == 1) {           

            b = 0;
            attack(3);
        }
    });
    $('#adown').click(function () {
        if (b == 1) {      

            b = 0;
            attack(4);
        }
    });
    $('#aleft').click(function () {
        if (b == 1) {       

            b = 0;
            attack(2);
        }
    });
    $('#aright').click(function () {
        //var player = document.querySelector('#son');
        // audioElement.play();
        if (b == 1) {       

            b = 0;
            attack(1);

        }
    });
    $('#cri').click(function () {
        if (b === 1) {
             sdcri.play();
            b = 0;
            cri();

        }
    });
    $('.case').click(function () {
        var a = this.id;
        var a = a.replace('cid', '');
        b = $('#' + this.id).html();
        detect(a);
        b = b.replace(/\n|\r|(\n\r)/g, '');
        if (b !== '                 <div class="vide"></div>             ') {

            //   detect(a);
        } else {
            if ($('#info2').html !== '') {
                $('#info2').html('');
            }
        }

    });

    $('#sh').click(function () {
        if(a===1){
        supsh();
    a=0;}
    });

    $('#ssi').click(function () {
                if(a===1){

        supssi();    a=0;}
    });
    $('#sst').click(function () {
        if(a===1){

        supsst();    a=0;}
    });

    setInterval(function () {
        a = 1;
    }, 600);

    setInterval(function () {
        b = 1;
    }, 1300);
    
    
 

});