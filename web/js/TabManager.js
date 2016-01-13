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
        me.changeTab(this);
    });
};


TabManager.prototype.changeTab = function(selectedTab)
{
    var group = $(selectedTab).data('tabgroup');
    var controls = $('.tab-object[data-tabgroup="'+group+'"]');

    $.each(controls, function(i, tab){
        var page = ($(tab).data('element'));
        if(selectedTab == tab) {
            $(tab).addClass('tab-active');
            $("#" + page).addClass('tab-page-active');
        }else{
            $(tab).removeClass('tab-active');
            $("#" + page).removeClass('tab-page-active');
        }
    });
}