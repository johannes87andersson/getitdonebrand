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
        var prod_name = $("#prod_name");
        var prod_price = $("#prod_price");
        var prod_shopify_link = $("#prod_shopify_link");

        var d = {
            prod_id: prod_id,
            prod_name: prod_name.val(),
            prod_price: prod_price.val(),
            prod_shopify_link: prod_shopify_link.val()
        };
        if (d.prod_id == null) {
            p.showModal("Error saving", "Could not save product because no ID found");
            return;
        }
        if (d.prod_name == "") {
            p.showModal("Error saving", "Could not save product because of empty name");
            prod_name.css({
                border: '1px solid red'
            });
            return;
        }
        prod_name.attr("style", "");
        p.SaveProductCred(d, function () {
            p.showModal("Product Saved", "Product is successfully saved");
        });

    });

    $(document).on("click", ".load-pages-link li a", function (e) {
        e.preventDefault();

        var page_id = $(this).attr("load_page");

        $.get("/admin/currentPage", {page_id: page_id}, function (data) {
            pages.loadPageResult(data, pages.getPageResultElements());
        });
    });

    // auto load first value
    switch (document.location.pathname) {
        case "/admin/pages":
            $.get("/admin/currentPage", {page_id: 1}, function (data) {
                pages.loadPageResult(data, pages.getPageResultElements());
            });
            break;
        case "/admin/pages/":
            $.get("/admin/currentPage", {page_id: 1}, function (data) {
                pages.loadPageResult(data, pages.getPageResultElements());
            });
            break;
        case "/admin/products":
            $.get("/admin/currentProduct", {prod_id: 1}, function (data) {
                //Pages.loadPageResult(data);
                p.loadProductResults(data, p.getProductsResultElemets());
            });
            $.get("/admin/getCurrentProductsImages", {parent_id: 1}, function (data) {
                p.loadProductImageResults(data);
            });
            break;
        case "/admin/products/":
            $.get("/admin/currentProduct", {prod_id: 1}, function (data) {
                //Pages.loadPageResult(data);
                p.loadProductResults(data, p.getProductsResultElemets());
            });
            $.get("/admin/getCurrentProductsImages", {parent_id: 1}, function (data) {
                p.loadProductImageResults(data);
            });
            break;
    }

    $(document).on("click", ".load_product", function (e) {
        e.preventDefault();

        var prod_id = $(this).attr("id");

        $.get("/admin/currentProduct", {prod_id: prod_id}, function (data) {
            p.loadProductResults(data, p.getProductsResultElemets());
        });
        $.get("/admin/getCurrentProductsImages", {parent_id: prod_id}, function (data) {
            p.loadProductImageResults(data);
        });
    });

    $(document).on("change", ".prod-img input[type=file]", function (e) {
        p.uploadFile(e, this);
    });

    $(document).on("click", ".del-img", function (e) {
        e.preventDefault();

        var id = $(this).attr("id");
        // remove image
        p.removeFileFromDb(id);
        $(this).parent().remove();
    });
});