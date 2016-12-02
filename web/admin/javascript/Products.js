var Products = function () {
    var ajax = new Ajax();
    this.ajax = ajax;
};
Products.prototype.loadProductResults = function (data, elements) {
    var arr = JSON.parse(data);

    elements[0].value = arr.prod_name;
    elements[1].value = arr.prod_price;
    elements[2].value = arr.shopify_link;
    elements[3].setAttribute("id", arr.prod_id);
    elements[4].setData(arr.prod_desc);
    //elements[3].setAttribute("id", arr.prod_id);
};
Products.prototype.getProductsResultElemets = function () {
    var a = [];
    var doc = document;
    var name = doc.getElementById("prod_name");
    var price = doc.getElementById("prod_price");
    var shopify_link = doc.getElementById("prod_shopify_link");
    var cred = doc.getElementsByClassName("save-product-cred");
    var desc = CKEDITOR.instances["prod_text"];

    a.push(name);
    a.push(price);
    a.push(shopify_link);
    a.push(cred[0]);
    a.push(desc);

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
        async: true,
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
    this.ajax.Post("/admin/updateProduct", d, function (data) {
        if (typeof (callback) == "function") {
            callback();
        }
    }, function (error) {
        console.log(error);
    });
};
Products.prototype.showModal = function (prod_title, prod_text) {

    var title = $("#prod_title");
    var text = $("#prod_text");

    title.html(prod_title);
    text.html(prod_text);

    var m = $("#myModal");
    m.modal('show');
    setTimeout(function () {
        m.modal('hide');
    }, 2000);
};
Products.prototype.addFileToDb = function (parent_id, filename) {
    this.ajax.Post("/UploadFile/insertImage", {parent_id: parent_id, filename: filename}, function (data) {
        console.log(data);
    }, function (error) {
        console.log(error);
    });
};
Products.prototype.removeFileFromDb = function (file_id) {
    this.ajax.Post("/UploadFile/removeImage", {file_id: file_id}, function (data) {
        //var json = JSON.parse(data);
        console.log(data);
    }, function (error) {
        console.log(error);
    });
};

Products.prototype.progressHandling = function (e) {
    if (e.lengthComputable) {
        $('progress').attr({value: e.loaded, max: e.total});
        //$(".progress-bar").attr("aria-valuemax", e.total);
        //$(".progress-bar").attr("style", "width: " + e.loaded + "%");
    }
};
Products.prototype.tableAddInput = function (_this) {
    var that = this;
    //console.log(_this.target.innerHTML);
    var target = _this.target;
    if (target.innerHTML === "Null") {
        target.innerHTML = '<input type="text" id="testarnu" placeholder="Test" tabindex="1" />';
    } else {
        target.innerHTML = '<input type="text" id="testarnu" placeholder="Test" tabindex="1" value="' + target.innerHTML + '" />';
    }
    target.querySelector('#testarnu').focus();
    console.log(target.getAttribute("data"));
    target.addEventListener('keydown', function (e) {
        //console.log(e.which);
        switch (e.which) {
            case 27:
                target.innerHTML = 'Null';
                break;
            case 13:
                e.preventDefault();
                if (e.target.value == "") {
                    target.innerHTML = "Null";
                } else {
                    target.innerHTML = e.target.value;
                    var d = {};
                    var attr = target.getAttribute("data");
                    switch (attr) {
                        case "size":
                            d.size = e.target.value;
                            d.chest = $(this).parent().find("td[data=chest]").html();
                            d.length = $(this).parent().find("td[data=length]").html();
                            break;
                        case "chest":
                            d.chest = e.target.value;
                            d.size = $(this).parent().find("td[data=size]").html();
                            d.length = $(this).parent().find("td[data=length]").html();
                            break;
                        case "length":
                            d.chest = $(this).parent().find("td[data=chest]").html();
                            d.size = $(this).parent().find("td[data=size]").html();
                            d.length = e.target.value;
                            break;
                    }
                    d.parent_id = $(".save-product-cred").attr("id");
                    var data_id = $(this).parent().attr("data-id");
                    if (data_id == "" || data_id == null) {
                        that.saveNewProductSize(d, $(this));
                    } else {
                        d.size_id = data_id;
                        that.updateProductSize(d, $(this));
                    }
                }
                break;
        }
    });

    return;
};
Products.prototype.saveNewProductSize = function (d, _this) {
    this.ajax.Post("/Admin/addNewProductSize", d, function (data) {
        console.log(data);
        _this.parent().attr("data-id", data);
    }, function (error) {
        console.log(error);
    });
};
Products.prototype.updateProductSize = function (d, _this) {
    this.ajax.Post("/Admin/updateProductSize", d, function (data) {
        console.log(data);
    }, function (error) {
        console.log(error);
    });
};
Products.prototype.tableAddRow = function (e) {

    var table = $("#product_table");

    var hb = [];
    hb.push('<tr>');
    hb.push('<td data="size">Null</td>');
    hb.push('<td data="chest">Null</td>');
    hb.push('<td data="length">Null</td>');
    hb.push('</tr>');
    var html = hb.join("");

    table.append(html);
};
Products.prototype.loadProductSizes = function (data) {
    var json = JSON.parse(data);
    console.log(json);
    var table = $("#product_table");
    table.html("");

    var hb = [];
    if (json == "false") {
        hb.push('<thead>');
        hb.push('<tr>');
        hb.push('<th class="text-center">Size</th>');
        hb.push('<th class="text-center">Chest (Inches/cm)</th>');
        hb.push('<th class="text-center">Length (Inches/cm)</th>');
        hb.push('</tr>');
        hb.push('</thead>');
        hb.push('<tbody>');
        hb.push('</tbody>');
    } else {
        hb.push('<thead>');
        hb.push('<tr>');
        hb.push('<th class="text-center">Size</th>');
        hb.push('<th class="text-center">Chest (Inches/cm)</th>');
        hb.push('<th class="text-center">Length (Inches/cm)</th>');
        hb.push('</tr>');
        hb.push('</thead>');
        hb.push('<tbody>');
        for (var i = 0; i < json.length; i++) {
            hb.push('<tr data-id="' + json[i].size_id + '">');
            hb.push('<td data="size">' + json[i].size + '</td>');
            hb.push('<td data="chest">' + json[i].chest + '</td>');
            hb.push('<td data="length">' + json[i].length + '</td>');
            hb.push('</tr>');
        }
        hb.push('</tbody>');
    }
    var html = hb.join("");
    table.append(html);
};