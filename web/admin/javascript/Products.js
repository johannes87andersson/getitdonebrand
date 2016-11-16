var Products = {
    loadProductResults: function (data) {
        var arr = JSON.parse(data);
        $("#prod_name").val(arr.prod_name);
        $("#prod_price").val(arr.prod_price);
        $("#prod_shopify_link").val(arr.shopify_link);
        $(".save-product-cred").attr("id", arr.prod_id);
    },
    uploadFile: function (file) {

    },
    addFileToDb: function (parent_id, filename) {
        $.post("/uploadfile/insertimage", {parent_id: parent_id, filename: filename}, function (data) {
            var json = JSON.parse(data);
            console.log(json);
        });
    }
};