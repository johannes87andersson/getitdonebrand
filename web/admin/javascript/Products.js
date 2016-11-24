var Products = {
    loadProductResults: function (data) {
        var arr = JSON.parse(data);
        $("#prod_name").val(arr.prod_name);
        $("#prod_price").val(arr.prod_price);
        $("#prod_shopify_link").val(arr.shopify_link);
        $(".save-product-cred").attr("id", arr.prod_id);
    },
    loadProductImageResults: function (data) {
        var arr = JSON.parse(data);
        var prod_img = $(".prod-img");
        if (prod_img.length < arr.length) {
            var prod_box = $(".prod-images");
            $(".prod-images").find(".clearfix").remove();
            for(var i = prod_img.length; i < arr.length; i++) {
                Products.createNewProdImgBox((i+1), "noname");
            }
            Products.createNewProdImgBox(arr.length+1);
            prod_box.append('<div class="clearfix"></div>');
        }
        
        for (var i = 0; i < arr.length; i++) {
            console.log(arr[i].filename);
            var currentPos = $("#file" + (i + 1));
            var currentPosBox = currentPos.parent();
            currentPosBox.children(".prod-text").remove();
            currentPosBox.append('<img style="position: absolute; top: 0; left: 0;" prod-img-id="' + arr[i].img_id + '" src="/web/uploads/thumbnail/' + arr[i].filename + '" />');
        }
    },
    uploadFile: function (e, object) {
        e.preventDefault();
        var that = $(object);
        var formData = new FormData(document.querySelector("form"));
        console.log(that);
        var name = object.files.item(0).name;
        formData.append("file", object.files[0], name);

        $.ajax({
            url: "/UploadFile/productUpload",
            type: "POST",
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    myXhr.upload.addEventListener('progress', progressHandling, false);
                }
                return myXhr;
            },
            success: completeHandler = function (data) {
                console.log(data);
                
                that.parent().html('<img src="/web/uploads/thumbnail/' + data + '" />');
                
                var parent_id = $(".load_product").attr("id");
                Products.addFileToDb(parent_id, data);

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
    },
    createNewProdImgBox: function (index) {
        var hb = [];
        hb.push('<div class="prod-img">');
        hb.push('<input id="file'+index+'" type="file">');
        hb.push('<div class="prod-text">Upload Image</div>');
        //hb.push('<img style="position: absolute; top: 0; left: 0;" prod-img-id="' + index + '" src="/web/uploads/thumbnail/' + image + '">');
        hb.push('</div>');
        var html = hb.join('');
        $(".prod-images").append(html);
    },
    addFileToDb: function (parent_id, filename) {
        $.post("/UploadFile/insertImage", {parent_id: parent_id, filename: filename}, function (data) {
            var json = JSON.parse(data);
            console.log(json);
        });
    }
};