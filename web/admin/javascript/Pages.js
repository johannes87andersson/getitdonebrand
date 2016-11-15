var Pages = {
    loadPageResult: function (data) {
        var arr = JSON.parse(data);
        $("#page_title").val(arr.page_title);
        CKEDITOR.instances["page_text"].setData(arr.page_text);
        $("#page_description").val(arr.page_desc);
        $("#page_keywords").val(arr.page_keywords);
        $(".save-page-cred").attr("id", arr.page_id);
    }
};