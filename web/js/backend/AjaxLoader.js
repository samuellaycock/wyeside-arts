function AjaxLoader()
{
    this.actionUrl = '';
    this.method = 'POST';
    this.domElement = '';
    return this;
}

AjaxLoader.prototype.load = function(data)
{
    var me = this;
    $.ajax({
        url: this.actionUrl,
        method: this.method,
        data: data,
        success: function(result){
            $(me.domElement).html(result);
        }
    });
};
