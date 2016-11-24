$(document).ready(function () {

    var p = new Products();
    var pages = new Pages();

    $(document).on("click", ".save-page-cred", function (e) {
        e.preventDefault();

        var page_id = $(".save-page-cred").attr("id");
        var page_title = $("#page_title").val();
        var page_text = CKEDITOR.instances["page_text"].getData();
        var page_keywords = $("#page_keywords").val();
        var page_desc = $("#page_description").val();

        var d = {
            page_id: page_id,
            page_title: page_title,
            page_text: page_text,
            page_desc: page_desc,
            page_keywords: page_keywords
        };
        $.post("/admin/updatePage", d, function (data) {
            console.log(data);
        });
    });

    $(document).on("click", ".save-product-cred", function (e) {
        e.preventDefault();

        var prod_id = $(this).attr("id");
        var prod_name = $("#prod_name").val();
        var prod_price = $("#prod_price").val();
        var prod_shopify_link = $("#prod_shopify_link").val();

        var d = {
            prod_id: prod_id,
            prod_name: prod_name,
            prod_price: prod_price,
            prod_shopify_link: prod_shopify_link
        };

        $.post("/admin/updateProduct", d, function (data) {
            console.log(data);
        });
    });

    $(document).on("click", ".load-pages-link li a", function (e) {
        e.preventDefault();

        var page_id = $(this).attr("load_page");

        $.get("/admin/currentPage", {page_id: page_id}, function (data) {
            pages.loadPageResult(data);
        });
    });
    
    // auto load first value
    switch (document.location.pathname) {
        case "/admin/pages":
            $.get("/admin/currentPage", {page_id: 1}, function (data) {
                pages.loadPageResult(data);
            });
            break;
        case "/admin/products":
            $.get("/admin/currentProduct", {prod_id: 1}, function (data) {
                //Pages.loadPageResult(data);
                p.loadProductResults(data);
            });
            $.get("/admin/getCurrentProductsImages", {parent_id: 1}, function(data) {
                p.loadProductImageResults(data);
            });
            break;
    }

    $(document).on("click", ".load_product", function (e) {
        e.preventDefault();

        var prod_id = $(this).attr("id");

        $.get("/admin/currentProduct", {prod_id: prod_id}, function (data) {
            //Pages.loadPageResult(data);
            p.loadProductResults(data);
        });
    });

    $(document).on("submit", "#upload_file", function (e) {
        e.preventDefault();

        var file_id = document.getElementById("file_id");
        var formData = new FormData(document.querySelector("form"));

        // append all files to FormData object
        for (var i = 0; i < file_id.files.length; ++i) {
            var name = file_id.files.item(i).name;
            formData.append("file", file_id.files[i], name);
        }

        $.ajax({
            url: "/uploadfile/doUpload",
            type: "POST",
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    myXhr.upload.addEventListener('progress', progressHandling, false);
                }
                return myXhr;
            },
            success: completeHandler = function (data) {
                //console.log(data);
                var json = JSON.parse(data);
                //console.log(json);
                var html = [];
                for (var i = 0; i < json.length; i++) {
                    console.log(json[i]);
                    html.push('<a href="#" class="thumbnail pull-left" style="margin-right: 10px; width: 171px; height: 180px;">');
                    html.push('<div style="background-image: url(\'/web/uploads/' + json[i] + '\') center center no-repeat;"></div>');
                    html.push('</a>');
                }
                var builder = html.join("");
                $("#tn-content").append(builder);
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
    });

    $(document).on("change", ".prod-img input[type=file]", function (e) {
        p.uploadFile(e, this);
    });
});

function progressHandling(e) {
    if (e.lengthComputable) {
        $('progress').attr({value: e.loaded, max: e.total});
        //$(".progress-bar").attr("aria-valuemax", e.total);
        //$(".progress-bar").attr("style", "width: " + e.loaded + "%");
    }
}