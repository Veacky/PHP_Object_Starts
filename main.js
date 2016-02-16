$(document).ready(function() {
    $("body").append("<div id='bubbles'></div>");
 
 
    $("body").prepend("<button id='go'>Go</button>");
    $("body").prepend("<button id='pause'>Pause</button");
 
    var run = false;
 
    function nightmare() {
        //définition d'un variable qui permet que la fonction tourne seulement quand run == true;
        if (run) {
            $.get("position.php", {}, function(data) {
                var bubble = $("<div class='bubble'>");
                $("#bubbles").append(bubble);
                bubble
                    .hide(2000)
                    .click(function() {
                        $(this).css("background-color", "white");
                    })
                    .css({
                        "top": (Math.floor((($("#bubbles").height()) - 50) * Math.random())) + "px",
                        "left": (Math.floor((($("#bubbles").width()) - 50) * Math.random())) + "px",
                    });
            }, "json");
        }
    }
 
    $("#go").click(function() {
        //run = true, la fonction reprend
        run = true;
        setInterval(nightmare, 100);
    });
 
    $("#pause").click(function() {
        //t'avais oublié le each ici, il faut parcourir chaque bulle et arreter l'animation de chacune d'entre elle
        $('.bubble').each(function() {
            $(this).stop();
        });
        //run = false, la fonction s'arrette
        run = false;
    });
 
});