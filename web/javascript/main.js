$(document).ready(function() {
    
    var show_me = $(".show-me");
    
    $(".thumb").on("click", function(e) {
        show_me.fadeOut(100);
        var that = $(this);
        setTimeout(function() {
            show_me.fadeIn(100);
            var newSrc = that.attr("src").replace("thumbnail/", "");
            show_me.attr("src", newSrc);
        }, 100);
    });
    
});