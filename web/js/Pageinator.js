$pageinator = new Paginator();
$( document ).ready(function() {
    $pageinator.ready();
}


function Paginator()
{
    return this;
}

/**
 * Attach events to all .page-number elements
 * found on the page.
 */
Paginator.prototype.ready = function()
{
    var me = this;
    $('.page-number').click(function(){
        me.loadPage(this);
    });
});


/**
 * Perform the ajax request to load a new page
 * @param domElement
 */
Paginator.prototype.loadPage = function(domElement)
{
    var me = this;

    var pageNumber = $(domElement).data("page");
    var parent = $(domElement).parent();
    var refreshUrl = $(parent).data("refreshurl");
    var replaceDom = $(parent).data("domelement");

    $.ajax({
        url: refreshUrl + "?page=" + pageNumber,
        success: function(result){
            $("#" + replaceDom).html(result);
        }
    });
}