$("#data_container_generate").click(function ()
{
    $(".data_container").html("");
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	var arr = $("input[name='ticker_symbols']").val().split(", ");

    for (i=0; i<arr.length; i++)
    {
        var symbol = arr[i].toString();
        //run calculations on symbols here
        
        
        $(".data_container").append('<div class="data_child" id="stock_info'+i+'"> </div>');
		
		xmlhttp.open("GET","http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22" + symbol + "%22)&env=store://datatables.org/alltableswithkeys",false);
		xmlhttp.send();
		xmlDoc=xmlhttp.responseXML;
		x=xmlDoc.getElementsByTagName('quote');
		
		for (t=0;t<x.length;t++)
		{
			$('#stock_info'+i+'').append(x[t].getElementsByTagName("Name")[0].childNodes[0].nodeValue);
			$('#stock_info'+i+'').append(" (" + x[t].getAttribute('symbol') + ")");
			$('#stock_info'+i+'').append("<br>");
			$('#stock_info'+i+'').append("<p>");
			$('#stock_info'+i+'').append("Days Low: " + x[t].getElementsByTagName("DaysLow")[0].childNodes[0].nodeValue);
			$('#stock_info'+i+'').append("<br>");
			$('#stock_info'+i+'').append("Days High: " + x[t].getElementsByTagName("DaysHigh")[0].childNodes[0].nodeValue);
			$('#stock_info'+i+'').append("<br>");
			$('#stock_info'+i+'').append("Day Change: <span id='change" + i + "'>" + x[t].getElementsByTagName("Change")[0].childNodes[0].nodeValue + "</span> ");
			$('#stock_info'+i+'').append("<span id='percentchange" + i + "'>(" + x[t].getElementsByTagName("PercentChange")[0].childNodes[0].nodeValue + ")</span>");
			$('#stock_info'+i+'').append("<br>");
			$('#stock_info'+i+'').append("Stock Price: " + x[t].getElementsByTagName("Ask")[0].childNodes[0].nodeValue);
			$('#stock_info'+i+'').append("<br>");
			$('#stock_info'+i+'').append("50 Day Moving Average: " + x[t].getElementsByTagName("FiftydayMovingAverage")[0].childNodes[0].nodeValue);
			$('#stock_info'+i+'').append("<br>");
			$('#stock_info'+i+'').append("<img src='http://chart.finance.yahoo.com/t?s=" + symbol + "&amp;lang=en-US&amp;region=US&amp;width=300&amp;height=180'>");
			$('#stock_info'+i+'').append("</p>");
			var val = x[t].getElementsByTagName("Change")[0].childNodes[0].nodeValue;
			var find = val.search("-");
			if (find != -1)
			{
				document.getElementById('change'+i+'').style.color = "red"
				document.getElementById('percentchange'+i+'').style.color = "red"
			}
			else
			{
				document.getElementById('change'+i+'').style.color = "green"
				document.getElementById('percentchange'+i+'').style.color = "green"
			}
		}
    } 
});

//jQuery for dropdown on hover
$('.dropdown-toggle').click(function() {
    var location = $(this).attr('href');
    window.location.href = location;
    return false;
});
