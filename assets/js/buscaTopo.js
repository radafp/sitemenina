$(document).ready(function()
{
    $("#btBusca").bind('click', function()
    {
        _url = new Array();
        _busca = $("#txtBusca").val();
        if(_busca != '')
        {
            //_url.push("b:"+escape(_busca));
            _url.push("b:"+urlencode(_busca));
        }
        
        _href = "/busca"+(_url.length > 0 ? "/"+_url.join("/") : '');
        document.location.replace(_href);
    });
    $('#txtBusca').focus(function()
    {
        $(this).keypress(function(e)
        {
            if(e.keyCode == '13')
            {
                $("#btBusca").trigger('click');
            }
        });
        $(this).blur(function()
        {
            $(this).unbind('keypress, focus');
        });
    });
});