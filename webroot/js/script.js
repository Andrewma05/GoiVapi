/**
 * Created by a.mazepa on 27.08.16.
 */
$(document).ready(function () {

    $('#showresort01').click(function(){
        $('#showresort01').addClass("active");
        $('#showresort02').removeClass("active");
        $('#showresort03').removeClass("active");
        $('#showresort04').removeClass("active");
        $('#formpastresortcreate').show(1000);
    });

    $('#showresort02').click(function(){
        $('#showresort02').addClass("active");
        $('#showresort01').removeClass("active");
        $('#showresort03').removeClass("active");
        $('#showresort04').removeClass("active");
        $('#formpastresortcreate').show(1000);
    });

    $('#showresort03').click(function(){
        $('#showresort03').addClass("active");
        $('#showresort01').removeClass("active");
        $('#showresort02').removeClass("active");
        $('#showresort04').removeClass("active");
        $('#formpastresortcreate').show(1000);
    });
    $('#showresort04').click(function(){
        $('#showresort04').addClass("active");
        $('#showresort01').removeClass("active");
        $('#showresort02').removeClass("active");
        $('#showresort03').removeClass("active");
        $('#formpastresortcreate').show(1000);
    });

});