var Products = function () {

};

Products.prototype.Init = function () {

};
Products.prototype.loadProductResults = function (data) {
    var arr = JSON.parse(data);
    $("#prod_name").val(arr.prod_name);
    $("#prod_price").val(arr.prod_price);
    $("#prod_shopify_link").val(arr.shopify_link);
    $(".save-product-cred").attr("id", arr.prod_id);
};
Products.prototype.loadProductImageResults = function (data) {
    var arr = JSON.parse(data);
    var prod_box = $(".prod-images");

    // always clean the images box first
    prod_box.html("");

    // stop if dont find any value
    if (arr === "false") {
        console.log("test stop");
        this.createNewProdImgBox(1);
        prod_box.append('<div class="clearfix"></div>');
        return;
    }

    // console.log(arr.length);
    // console.log($(".prod-img").length);
    var prod_img = $(".prod-img");
    if (prod_img.length < arr.length) {
        prod_box.find(".clearfix").remove();
        for (var i = prod_img.length; i < arr.length; i++) {
            this.createNewProdImgBox((i + 1));
        }
        this.createNewProdImgBox(arr.length + 1);
        prod_box.append('<div class="clearfix"></div>');
    }

    for (var i = 0; i < arr.length; i++) {
        var currentPos = $("#file" + (i + 1));
        var currentPosBox = currentPos.parent();
        currentPosBox.hide(0);
        currentPosBox.children(".prod-text").remove();
        currentPosBox.prepend('<div id="' + arr[i].img_id + '" class="del-img"><span class="glyphicon glyphicon-remove" title="Ta bort bild"></span></div>');
        currentPosBox.append('<img style="position: absolute; top: 0; left: 0;" prod-img-id="' + arr[i].img_id + '" src="/web/uploads/thumbnail/' + arr[i].filename + '" />');
        (function (arr, i) {
            setTimeout(function () {
                $("#" + arr[i].img_id).parent().fadeIn("fast");
            }, i * 100);
        })(arr, i);
    }
};
Products.prototype.uploadFile = function (e, object) {
    e.preventDefault();
    var that = $(object);
    var formData = new FormData(document.querySelector("form"));
    var name = object.files.item(0).name;
    formData.append("file", object.files[0], name);

    $.ajax({
        url: "/UploadFile/productUpload",
        type: "POST",
        xhr: function () {
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) {
                myXhr.upload.addEventListener('progress', this.progressHandling, false);
            }
            return myXhr;
        },
        success: completeHandler = function (data) {
            console.log(data);
            that.parent().html('<img src="/web/uploads/thumbnail/' + data + '" />');

            var parent_id = $(".save-product-cred").attr("id");
            this.addFileToDb(parent_id, data);

        },
        error: errorHandler = function (error) {
            alert("Upload error message: " + error.statusText);
        },
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        timeout: 60000
    }, 'json');
};
Products.prototype.createNewProdImgBox = function (index) {
    var hb = [];
    hb.push('<div class="prod-img">');
    hb.push('<input id="file' + index + '" type="file">');
    hb.push('<div class="prod-text">Upload Image</div>');
    //hb.push('<img style="position: absolute; top: 0; left: 0;" prod-img-id="' + index + '" src="/web/uploads/thumbnail/' + image + '">');
    hb.push('</div>');
    var html = hb.join('');
    $(".prod-images").append(html);
};
Products.prototype.addFileToDb = function (parent_id, filename) {
    $.post("/UploadFile/insertImage", {parent_id: parent_id, filename: filename}, function (data) {
        var json = JSON.parse(data);
    });
};
Products.prototype.removeFileFromDb = function (file_id) {
    $.post("/UploadFile/removeImage", {file_id: file_id}, function (data) {
        var json = JSON.parse(data);
    });
};

Products.prototype.progressHandling = function (e) {
    if (e.lengthComputable) {
        $('progress').attr({value: e.loaded, max: e.total});
        //$(".progress-bar").attr("aria-valuemax", e.total);
        //$(".progress-bar").attr("style", "width: " + e.loaded + "%");
    }
};