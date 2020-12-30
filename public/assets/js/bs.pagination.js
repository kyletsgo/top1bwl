/*
    script to apply bootstrap pagination in asp.net gridview
    by Issam Ali 
    http://issamsoft.com

    Usage:
    ------
    set gridview property: PagerStyle-CssClass="bs-pagination" 
*/

$(document).ready(function () {
    $('.bs-pagination td table').each(function (index, obj) {
        convertToPagination(obj)
    });
    //複製Pageer Start
    var $pagerBar = $("#GridView1 tr[class='bs-pagination text-right']");
    if (!!$pagerBar.length) {
        $('#GridView1 tr:first').before('<tr class="bs-pagination text-right">' + $pagerBar.clone(true).html() + '</tr>');
    }
    //複製Pageer End
});

function convertToPagination(obj) {
    var liststring = '<ul class="pagination nomargin">';

    $(obj).find("tbody tr").each(function () {
        $(this).children().map(function () {
            //如果$(this).html()裡面有 aspNetDisabled || disabled，li就會改成別的
            liststring = liststring + "<li>" + $(this).html() + "</li>";
        });
    });
    liststring = liststring + "</ul>";
    var list = $(liststring);
    list.find('span').parent().addClass('active');

    $(obj).replaceWith(list);
}


