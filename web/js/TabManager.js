$tabManager = new TabManager();
$( document ).ready(function() {
    $tabManager.ready();
});

function TabManager()
{
    return this;
}

TabManager.prototype.ready = function()
{
    var me = this;
    $('.tab-object').click(function(){
        me.loadPage(this);
    });
};


TabManager.prototype.changeTab = function(tabObject)
{

}