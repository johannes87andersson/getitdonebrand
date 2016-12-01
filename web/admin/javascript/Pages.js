var Pages = function () {};

Pages.prototype.loadPageResult = function (data, elements) {
    var arr = JSON.parse(data);
    elements[0].val(arr.page_title);
    elements[1].setData(arr.page_text);
    elements[2].val(arr.page_desc);
    elements[3].val(arr.page_keywords);
    elements[4].val(arr.page_id);
};
Pages.prototype.getPageResultElements = function () {
    var title = $("#page_title");
    var text = CKEDITOR.instances["page_text"];
    var desc = $("#page_description");
    var keyw = $("#page_keywords");
    var newId = $(".save-page-cred");

    var a = [];
    a.push(title);
    a.push(text);
    a.push(desc);
    a.push(keyw);
    a.push(newId);

    return a;
}