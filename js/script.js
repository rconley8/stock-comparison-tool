$("#data_container_generate").click(function ()
{
     $(".data_container").html("");
    //var ticker_symbols = $("input[name='ticker_symbols']").val();
	var array = $("input[name='ticker_symbols']").val().split(", ");

    for (i=0; i<array.length; i++)
    {
        //alert(array[i]);
        var symbol = array[i].toString();
        //run calculations on symbols here
        
        
        $(".data_container").append('<div class="data_child" id="stock_info'+i+'"> </div>');
        $('#stock_info'+i+'').text(symbol);
    } 
});