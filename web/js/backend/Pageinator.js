var pageinator = new Paginator();
$( document ).ready(function() {
    pageinator.ready();
});


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
};


/**
 * Perform the ajax request to load a new page
 * @param domElement
 */
Paginator.prototype.loadPage = function(domElement)
{
    var pageNumber = $(domElement).data("page");
    var parent = $(domElement).parent();
    var refreshUrl = $(parent).data("refreshurl");
    var replaceDom = $(parent).data("domelement");
    var qsMethod = $(parent).data("qsmethod");

    var queryParams = {};
    if(qsMethod.length >= 1){
        queryParams = window[qsMethod]();
    }
    queryParams.page = pageNumber;
    var queryString = "?" + $.param(queryParams);
    console.log(queryString);

    var me = this;
    $.ajax({
        url: refreshUrl + queryString,
        success: function(result){
            $("#" + replaceDom).html(result);
            me.ready();
        }
    });
};


/**
 * @param wrapperElementId
 */
Paginator.prototype.update = function(wrapperElementId)
{
    var activePage = $("#" + wrapperElementId + " .page-active:first-child");
    console.log(activePage);
    this.loadPage(activePage);
};