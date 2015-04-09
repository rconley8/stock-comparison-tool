function getSymbolData(symbol){
    $(".data_container").html("");
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
        //run calculations on symbols here
        i=0;
        
        $(".data_container").append('<div class="data_child" id="stock_info'+i+'"><table id="table_info'+i+'"> </table></div>');
		
	xmlhttp.open("GET","http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22" + symbol + "%22)&env=store://datatables.org/alltableswithkeys",false);
	xmlhttp.send();
	xmlDoc=xmlhttp.responseXML;
	x=xmlDoc.getElementsByTagName('quote');
	
	for (t=0;t<x.length;t++)
	{	
		$('#table_info'+i+'').append("<tr><td>Name</td><td>Days Low</td><td>Days High</td><td>Day Change</td><td>Percent Change</td><td>Stock Price</td><td>50 Day Moving Average</td><td>Yahoo Finance Chart</td></tr>");	
		$('#table_info'+i+'').append('<td>' + x[t].getElementsByTagName("Name")[0].childNodes[0].nodeValue + ' (' + x[t].getAttribute('symbol') + ') <button type="button" onClick="myFunction()" id="GOOG" value="GOOG">Add to Portfolio</button></td>');
		$('#table_info'+i+'').append('<td>' + x[t].getElementsByTagName("DaysLow")[0].childNodes[0].nodeValue + '</td>');
		$('#table_info'+i+'').append('<td>' + x[t].getElementsByTagName("DaysHigh")[0].childNodes[0].nodeValue + '</td>');
		$('#table_info'+i+'').append('<td>' + "<span id='change" + i + "'>" + x[t].getElementsByTagName("Change")[0].childNodes[0].nodeValue + "</span> " + '</td>');
		$('#table_info'+i+'').append('<td>' + "<span id='percentchange" + i + "'>(" + x[t].getElementsByTagName("PercentChange")[0].childNodes[0].nodeValue + ")</span>" + '</td>');
		$('#table_info'+i+'').append('<td>' + x[t].getElementsByTagName("LastTradePriceOnly")[0].childNodes[0].nodeValue + '</td>');
		$('#table_info'+i+'').append('<td>' + x[t].getElementsByTagName("FiftydayMovingAverage")[0].childNodes[0].nodeValue + '</td>');
		$('#table_info'+i+'').append('<td>' + "<img src='http://chart.finance.yahoo.com/t?s=" + symbol + "&amp;lang=en-US&amp;region=US&amp;width=300&amp;height=180'>" + '</td></tr>');

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

$( "#dialog-1" ).dialog({
   autoOpen: false,  
});


function myFunction(){
	   $( "#dialog-1" ).dialog( "open" );
}


//jQuery for dropdown on hover
$('.dropdown-toggle').click(function() {
    var location = $(this).attr('href');
    window.location.href = location;
    return false;
});
