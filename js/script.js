$('#stock_form').submit(function(event){
	event.preventDefault();
	$('#data_container_generate').trigger('click');
});


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
        
        
        $(".data_container").append('<div class="data_child" id="stock_info'+i+'"><table id="table_info'+i+'"> </table></div>');
		
		xmlhttp.open("GET","http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22" + symbol + "%22)&env=store://datatables.org/alltableswithkeys",false);
		xmlhttp.send();
		xmlDoc=xmlhttp.responseXML;
		x=xmlDoc.getElementsByTagName('quote');
		
		for (t=0;t<x.length;t++)
		{	
			$('#table_info'+i+'').append("<tr><th>Name</th><th>Days Low</th><th>Days High</th><th>Day Change</th><th>Percent Change</th><th>Stock Price</th><th>50 Day Moving Average</th><th>Yahoo Finance Chart</th></tr>");	
			$('#table_info'+i+'').append('<tr>' + 
			'<td>' + x[t].getElementsByTagName("Name")[0].childNodes[0].nodeValue + ' (' + x[t].getAttribute('symbol') + ') <button type="button" onClick="openDialog(this.id)" id="btn' + i + '" class="btn2">Add to Portfolio</button></td>' + 
			'<td>' + x[t].getElementsByTagName("DaysLow")[0].childNodes[0].nodeValue + '</td>' + 
			'<td>' + x[t].getElementsByTagName("DaysHigh")[0].childNodes[0].nodeValue + '</td>' + 
			'<td>' + "<span id='change" + i + "'>" + x[t].getElementsByTagName("Change")[0].childNodes[0].nodeValue + "</span> " + '</td>' + 
			'<td>' + "<span id='percentchange" + i + "'>(" + x[t].getElementsByTagName("PercentChange")[0].childNodes[0].nodeValue + ")</span>" + '</td>' + 
			"<td id='price" + i + "'>" + x[t].getElementsByTagName("LastTradePriceOnly")[0].childNodes[0].nodeValue + '</td>' + 
			'<td>' + x[t].getElementsByTagName("FiftydayMovingAverage")[0].childNodes[0].nodeValue + '</td>' + 
			'<td>' + "<img src='http://chart.finance.yahoo.com/t?s=" + symbol + "&amp;lang=en-US&amp;region=US&amp;width=300&amp;height=180'>" + '</td>' + '</tr>');
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

$( "#dialog-1" ).dialog({
   autoOpen: false,  
});


// $(".add_btn").click(function(){
// 	var id = this.id;
// 	alert(id);
// 	$( "#dialog-1" ).css({'display' : ''});
// 	$( "#dialog-1" ).dialog( "open" );
// });
function openDialog(clicked_id){
		//Use button ID to get i so that you can grab price+i
		var id = clicked_id;
		var thenum = id.replace( /^\D+/g, ''); // replace all leading non-digits with nothing
		var priceid = "price" + thenum
		var pricedata = document.getElementById(priceid);
		$( "#dialog_price" ).val(pricedata.innerHTML);
		$('#Cost').val(pricedata.innerHTML);
		$( "#dialog-1" ).css({'display' : ''});
		$( "#dialog-1" ).dialog( "open" );
}

$('#quantity').on('keyup',function(){
    var tot = $('#dialog_price').val() * this.value;
    $('#Cost').val(tot);
    //$('#total').val(tot);
});


//jQuery for dropdown on hover
$('.dropdown-toggle').click(function() {
    var location = $(this).attr('href');
    window.location.href = location;
    return false;
});