var Ajax = function () {};

Ajax.prototype.Post = function (url, d, callback, error) {
    $.ajax({
        type: "POST",
        url: url,
        data: d,
        success: function (data) {
            callback(data);
        },
        error: function (e) {
            error(e);
        },
        async: true
    });
};
Ajax.prototype.Get = function (url, d, callback, error) {
    $.ajax({
        type: "GET",
        url: url,
        data: d,
        success: function (data) {
            callback(data);
        },
        error: function (e) {
            error(e);
        },
        async: true
    });
};