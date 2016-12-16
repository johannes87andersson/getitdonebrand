$(document).ready(function () {

    var show_me = $(".show-me");

    $(document).on("click", ".thumb", function (e) {
        var that = $(this);
        var newSrc = that.attr("src").replace("thumbnail/", "thumbnail/medium/");
        show_me.attr("src", newSrc);
    });
    console.log(findBootstrapEnvironment());
    
    var navbar = $(".navbar-brand");
    if(findBootstrapEnvironment() == "xs") {
        navbar.addClass("navbar-brand-override");
        
        
    } else {
        if(navbar.hasClass("navbar-brand-override")) {
            navbar.removeClass("navbar-brand-override");
        }
    }
});

function findBootstrapEnvironment() {
    var envs = ['xs', 'sm', 'md', 'lg'];

    var $el = $('<div>');
    $el.appendTo($('body'));

    for (var i = envs.length - 1; i >= 0; i--) {
        var env = envs[i];

        $el.addClass('hidden-'+env);
        if ($el.is(':hidden')) {
            $el.remove();
            return env;
        }
    }
}