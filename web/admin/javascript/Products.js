var Products = function () {
    
};

Products.prototype.Init = function () {
    
};
Products.prototype.loadProductResults = function (data, elements) {
    var arr = JSON.parse(data);
    
    elements[0].val(arr.prod_name);
    elements[1].val(arr.prod_price);
    elements[2].val(arr.shopify_link);
    elements[3].attr("id", arr.prod_id);
};
Products.prototype.getProductsResultElemets = function() {
    var a = [];
    
    var name = $("#prod_name");
    var price = $("#prod_price");
    var shopify_link = $("#prod_shopify_link");
    var cred = $(".save-product-cred");
    
    a.push(name);
    a.push(price);
    a.push(shopify_link);
    a.push(cred);
    
    return a;
};
Products.prototype.loadProductImageResults = function (data) {
    var arr = JSON.parse(data);
    var prod_box = $(".prod-images");

    // always clean the images box first
    prod_box.html("");

    // stop if dont find any value
    if (arr === "false") {
        this.createNewProdImgBox(1);
        prod_box.append('<div class="clearfix"></div>');
        return;
    }

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
        currentPosBox.css("height", "149px");
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
    var _this = this;

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
            _this.addFileToDb(parent_id, data);

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
Products.prototype.SaveProductCred = function (d, callback) {
    $.post("/admin/updateProduct", d, function (data) {
        if(typeof(callback) == "function") {
            callback();
        } else {
            alert("error");
        }
    });
};
Products.prototype.showModal = function(prod_title, prod_text) {
    
    var title = $("#prod_title");
    var text = $("#prod_text");
    
    title.html(prod_title);
    text.html(prod_text);
    
    var m = $("#myModal");
    m.modal('show');
        setTimeout(function() {
            m.modal('hide');
        }, 2000);
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