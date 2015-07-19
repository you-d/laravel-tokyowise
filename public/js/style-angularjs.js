// default state
var defaultThreshold = $(".show-fixed-navbar-marker").offset().top - 40;
var assignedThreshold = defaultThreshold;

$(window).load(function() {
    if ($("#main").width() > 768) {
        $('#angularjs-test-fixed-navbar').hide();
    }
});
$(window).resize(function() {
    if ($("#main").width() < 769) {
        $('#angularjs-test-fixed-navbar').show();
        assignedThreshold = 0;
    } else {
        $('#angularjs-test-fixed-navbar').hide();
        assignedThreshold = defaultThreshold;
    }
});
$(document).ready(function() {
    $("#main").scroll(function() {
        if ($("#main").width() > 768) {
            var top = $("#main").scrollTop();
            if (top >= assignedThreshold) {
                $('#angularjs-test-fixed-navbar').show();
            } else {
                $('#angularjs-test-fixed-navbar').hide();
            }
        }
    });
});
