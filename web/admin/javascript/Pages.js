var Pages = function () {};

Pages.prototype.loadPageResult = function (data, elements) {
    var arr = JSON.parse(data);
    elements[0].value = arr.page_title;
    elements[1].setData(arr.page_text);
    elements[2].value = arr.page_desc;
    elements[3].value = arr.page_keywords;
    elements[4].value = arr.page_id;
};
Pages.prototype.getPageResultElements = function () {
    var doc = document;
   
    var title = doc.getElementById("page_title");
    var text = CKEDITOR.instances["page_text"];
    var desc = doc.getElementById("page_description");
    var keyw = doc.getElementById("page_keywords");
    var newId = doc.getElementsByClassName("save-page-cred");

    var a = [];
    a.push(title);
    a.push(text);
    a.push(desc);
    a.push(keyw);
    a.push(newId[0]);

    return a;
}