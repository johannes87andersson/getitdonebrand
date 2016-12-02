$(document).ready(function () {

    var show_me = $(".show-me");

    $(".thumb").on("click", function (e) {
        var that = $(this);
        var newSrc = that.attr("src").replace("thumbnail/", "thumbnail/medium/");
        show_me.attr("src", newSrc);
    });

});