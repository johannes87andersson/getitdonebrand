$(document).ready(function() {
    
    var show_me = $(".show-me");
    
    $(".thumb").on("click", function(e) {
        show_me.fadeOut(100);
        var that = $(this);
        setTimeout(function() {
            show_me.fadeIn(100);
            //console.log(that.attr("src"));
            show_me.attr("src", that.attr("src"));
            
        }, 100);
        
    });
    
});