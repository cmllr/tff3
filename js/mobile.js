$(document).ready(function () {
    $('.img_box').hover(
            function () {
                $(this).animate({'width': '110%', 'marginLeft': '-5%', 'opacity': '.7'}, 200);
            }
    ,
            function () {
                $(this).animate({'width': '100%', 'marginLeft': '0', 'opacity': '1'}, 200);
            }
    );

});


function likethis(data) {
    // Ajax-Aufruf, Daten abgleichen
    $.ajax({
        type: "POST",
        url: WEBROOT + 'likethis/',
        data: data,
        success: flckr,
        dataType: string
    });
}

function flckr() {
    $('#likethisbutton').show();
}