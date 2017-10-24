


$(document).ready(function () {
    var a;


    function tocoor(x, y) {
        if (y > 15)
            return null;

        else if (x <= 0)
            return null;
        else if (x > 10)
            return null;
        else if (y <= 0)
            return null;
        var a = (y - 1) * 10 + x;
        return a;
    }

    function tox(coor) {

        var x = coor % 10;
        if (x == 0)
            x = 10;
        return x;
    }

    function toy(coor) {
        var y = ((coor - (tox(coor))) / 10) + 1;
        return y;
    }


    function move(dir) {
        var vx1, vx2, vy1, vy2, coor1, coor2;
        var b, a, i, c;
        var rx, rv, ry;
        var rnx, rny;

        $.ajax({
            url: '/webArena/arenas/moveFighter/' + dir,
            type: 'GET',
            dataType: 'JSON',

            success: function (response) {


                if (response.success == 1) {
                    //      alert("oki");
                    rx = response.x;
                    ry = response.y;
                    rv = response.vue;
                    rny = response.ny;
                    rnx = response.nx;
                    a = "#cid" + tocoor(rny, rnx);
                    b = "#cid" + tocoor(ry, rx);
                    if (dir === 1) {  ///DOWN                            

                        for (i = 1; i <= rv + 1; i++) {
                            vy1 = rx + i;   ///PARTIE CASE QUI APPARAISSE
                            vy2 = vy1;
                            vx1 = ry - rv + i - 1;
                            vx2 = ry + rv - i + 1;
                            coor1 = tocoor(vx1, vy1);
                            coor2 = tocoor(vx2, vy2);
                            $('#cid' + coor1).html(' <img src="/webArena/img/case_vide_v.png" alt="Not found" width="42" height="35"> ');
                            $('#cid' + coor2).html(' <img src="/webArena/img/case_vide_v.png" alt="Not found" width="42" height="35"> '); //FIN CASE QUI APPARAISSE

                            vy1 = rnx - i;   ///PARTIE CASE QUI disparaisse
                            vy2 = vy1;
                            vx1 = ry - rv + i - 1;
                            vx2 = ry + rv - i + 1;
                            coor1 = tocoor(vx1, vy1);
                            coor2 = tocoor(vx2, vy2);
                            $('#cid' + coor1).html(' <img src="/webArena/img/case_vide_i.png" alt="Not found" width="42" height="35"> ');
                            $('#cid' + coor2).html(' <img src="/webArena/img/case_vide_i.png" alt="Not found" width="42" height="35"> '); //FIN CASE QUI APPARAISSE
                        }



                    }
                    if (dir === 2)  ///UP
                        for (i = 1; i <= rv + 1; i++) {
                            vy1 = rnx + i;   ///PARTIE CASE QUI APPARAISSE
                            vy2 = vy1;
                            vx1 = ry - rv + i - 1;
                            vx2 = ry + rv - i + 1;
                            coor1 = tocoor(vx1, vy1);
                            coor2 = tocoor(vx2, vy2);
                            $('#cid' + coor1).html(' <img src="/webArena/img/case_vide_i.png" alt="Not found" width="42" height="35"> ');
                            $('#cid' + coor2).html(' <img src="/webArena/img/case_vide_i.png" alt="Not found" width="42" height="35"> '); //FIN CASE QUI APPARAISSE

                            vy1 = rx - i;   ///PARTIE CASE QUI disparaisse
                            vy2 = vy1;
                            vx1 = ry - rv + i - 1;
                            vx2 = ry + rv - i + 1;
                            coor1 = tocoor(vx1, vy1);
                            coor2 = tocoor(vx2, vy2);
                            $('#cid' + coor1).html(' <img src="/webArena/img/case_vide_v.png" alt="Not found" width="42" height="35"> ');
                            $('#cid' + coor2).html(' <img src="/webArena/img/case_vide_v.png" alt="Not found" width="42" height="35"> '); //FIN CASE QUI APPARAISSE
                        }
                    if (dir === 3)
                        for (i = 1; i <= rv + 1; i++) {
                            vx1 = rny + i;   ///PARTIE CASE QUI APPARAISSE
                            vx2 = vx1;
                            vy1 = rx - rv + i - 1;
                            vy2 = rx + rv - i + 1;
                            coor1 = tocoor(vx1, vy1);
                            coor2 = tocoor(vx2, vy2);
                            $('#cid' + coor1).html(' <img src="/webArena/img/case_vide_i.png" alt="Not found" width="42" height="35"> ');
                            $('#cid' + coor2).html(' <img src="/webArena/img/case_vide_i.png" alt="Not found" width="42" height="35"> '); //FIN CASE QUI DISPARAISSE

                            vx1 = ry - i;   ///PARTIE CASE QUI apparaisse
                            vx2 = vx1;
                            vy1 = rx - rv + i - 1;
                            vy2 = rx + rv - i + 1;
                            coor1 = tocoor(vx1, vy1);
                            coor2 = tocoor(vx2, vy2);
                            $('#cid' + coor1).html(' <img src="/webArena/img/case_vide_v.png" alt="Not found" width="42" height="35"> ');
                            $('#cid' + coor2).html(' <img src="/webArena/img/case_vide_v.png" alt="Not found" width="42" height="35"> '); //FIN CASE QUI APPARAISSE
                        }
                    if (dir === 4)
                        for (i = 1; i <= rv + 1; i++) {
                            vx1 = ry + i;   ///PARTIE CASE QUI APPARAISSE
                            vx2 = vx1;
                            vy1 = rx - rv + i - 1;
                            vy2 = rx + rv - i + 1;
                            coor1 = tocoor(vx1, vy1);
                            coor2 = tocoor(vx2, vy2);
                            $('#cid' + coor1).html(' <img src="/webArena/img/case_vide_v.png" alt="Not found" width="42" height="35"> ');
                            $('#cid' + coor2).html(' <img src="/webArena/img/case_vide_v.png" alt="Not found" width="42" height="35"> '); //FIN CASE QUI DISPARAISSE

                            vx1 = rny - i;   ///PARTIE CASE QUI apparaisse
                            vx2 = vx1;
                            vy1 = rx - rv + i - 1;
                            vy2 = rx + rv - i + 1;
                            coor1 = tocoor(vx1, vy1);
                            coor2 = tocoor(vx2, vy2);
                            $('#cid' + coor1).html(' <img src="/webArena/img/case_vide_i.png" alt="Not found" width="42" height="35"> ');
                            $('#cid' + coor2).html(' <img src="/webArena/img/case_vide_i.png" alt="Not found" width="42" height="35"> '); //FIN CASE QUI APPARAISSE
                        }
                    //  console.log(response.tab.length);

                    for (i = 0; i < response.tab.length; i++) {
                        coor1 = tocoor(response.tab[i][1], response.tab[i][0]);
                        $('#cid' + coor1).html(' <img src="/webArena/img/' + response.tab[i][2] + '.png" alt="Not found" width="42" height="35"> ');
                        console.log(response.tab[i][2]);

                    }


                    c = $(a).html();
                    //  console.log("a:" + b + "  b:" + a);
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

        var save;
        var a;
        $.ajax({
            url: '/webArena/arenas/attack/' + dir,
            type: 'GET',
            dataType: 'JSON',

            success: function (response) {
                //  alert("oki");
                //    console.log("r:"+response.r+" f:"+response.f);
                if (response.success === 1) {

                    a = 'cid' + tocoor(response.y, response.x);
                    if (response.death === 0) {
                        
                        $('#info').html('l attaque est un succes, vie restante de' + response.name + ':' + response.health);
                        save = $('#' + a).html();
                        $('#' + a).html(' <img src="/webArena/img/attack.gif" alt="Not found" width="42" height="35"> ');


                        setTimeout(function () {
                            $('#' + a).html(save);
                        }, 900);
                    } else if (response.death === 1) {
                        $('#info').html('l attaque est un succes, et tue' + response.name);
                        save = ' <img src="/webArena/img/case_vide_v.png" alt="Not found" width="42" height="35"> ';
                        $('#' + a).html(' <img src="/webArena/img/mort.gif" alt="Not found" width="42" height="35"> ');


                        setTimeout(function () {
                            $('#' + a).html(save);

                        }, 1500);
                    }

                } else if (response.ennemy === 1) {
                    $('#info').html(response.name + ' esquive le coup, il est CHOOOOOO');
                    save = ' <img src="/webArena/img/case_vide_v.png" alt="Not found" width="42" height="35"> ';
                        $('#' + a).html(' <img src="/webArena/img/stop.png" alt="Not found" width="42" height="35"> ');


                        setTimeout(function () {
                            $('#' + a).html(save);

                        }, 900);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

    }

    function detect(coord) {
        var y = toy(coord);

        var x = tox(coord);


        //    $x = floor($coord / 10) + 1;
        console.log('x' + x + 'y' + (y));
        console.log(' coor:' + tocoor(x, y));
        $.ajax({
            url: '/webArena/arenas/detect/' + coord,
            type: 'GET',
            dataType: 'JSON',

            success: function (response) {
                if (response.success == 1 && response.type == 1) {
                    $('#info2').html('nom:' + response.obj.name + ' level:' + response.obj.level + ' xp:' + response.obj.xp);
                } else if (response.success == 1 && response.type == 2) {
                    $('#info2').html('nom:' + response.obj.type);
                } else {
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
                $('#psh').text(parseInt($('#psh').text()) + 1);
                $('#lvl').text(parseInt($('#lvl').text()) + 1);
                $('#skil').text(parseInt($('#skil').text()) - 1);
                $('#vie').text(parseInt($('#psh').text()));
                if ($('#skil').text() == '0') {
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


    $('#up').click(function () {
        if (a == 1) {


            a = 0;
            move(2);
        }
    });
    $('#down').click(function () {
        if (a == 1) {
            move(1);
            a = 0;
        }
    });
    $('#left').click(function () {
        if (a == 1) {
            move(3);
            a = 0;
        }
    });
    $('#right').click(function () {
        if (a == 1) {
            move(4);
            a = 0;
        }
    });
    $('#aup').click(function () {
        if (a == 1) {
            attack(2);
            a = 0;
        }
    });
    $('#adown').click(function () {
        if (a == 1) {
            attack(1);
            a = 0;
        }
    });
    $('#aleft').click(function () {
        if (a == 1) {
            attack(3);
            a = 0;
        }
    });
    $('#aright').click(function () {
        if (a == 1) {
            attack(4);
            a = 0;
        }
    });
    $('.case').click(function () {
        a = this.id;
        a = a.replace('cid', '');
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
        supsh();
    });

    $('#ssi').click(function () {
        supssi();
    });
    $('#sst').click(function () {

        supsst();
    });

    setInterval(function () {
        a = 1
    }, 600);

});