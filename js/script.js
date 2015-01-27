$("#data_fields_generate").click(function ()
{
     $("#data_fields").html("");
    var ticker_symbols = $("input[name='ticker_symbols']").val();

    for (i=0; i<=ticker_symbols-1; i++)
    {
        $("#data_fields").append("<div> hello world </div>");
    } 
});