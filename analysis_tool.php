<?php
/**
 * Created by PhpStorm.
 * User: SESA378763
 * Date: 9/15/2015
 * Time: 1:27 PM
 */


$stockSymbols = array("MMM","ACE","ABT","ANF","ADBE","AMD","AES","AET","AFL","A","APD","ARG","AKS","AKAM","AA","ATI","AGN","ALL","ALTR","MO","AMZN","AEE","AEP","AXP","AIG","AMT","AMP","ABC","AMGN","APH","APC","ADI","AON","APA","AIV","APOL","AAPL","AMAT","ADM","AIZ","T","ADSK","ADP","AN","AZO","AVB","AVY","AVP","BHI","BLL","BAC","BK","BCR","BAX","BBT","BDX","BBBY","BMS","BRK-B","BBY","BIG","BIIB","BLK","HRB","BMC","BA","BXP","BSX","BMY","BRCM","BF-B","CHRW","CA","CVC","COG","CAM","CPB","COF","CAH","CFN","KMX","CCL","CAT","CBG","CBS","CELG","CNP","CTL","CERN","CF","SCHW","CHK","CVX","CB","CI","CINF","CTAS","CSCO","C","CTXS","CLF","CLX","CME","CMS","COH","KO","CCE","CTSH","CL","CMCSA","CMA","CSC","CPWR","CAG","COP","CNX","ED","STZ","CEG","GLW","COST","CVH","COV","CSX","CMI","CVS","DHI","DHR","DRI","DVA","DF","DE","DELL","DNR","XRAY","DVN","DV","DO","DTV","DFS","DISCA","D","RRD","DOV","DOW","DPS","DTE","DD","DUK","DNB","ETFC","EMN","ETN","EBAY","ECL","EIX","EW","EP","ERTS","EMC","EMR","ETR","EOG","EQT","EFX","EQR","EL","EXC","EXPE","EXPD","ESRX","XOM","FFIV","FDO","FAST","FII","FDX","FIS","FITB","FHN","FSLR","FE","FISV","FLIR","FLS","FLR","FMC","FTI","F","FRX","FO","BEN","FCX","FTR","GME","GCI","GPS","GD","GE","GIS","GPC","GNW","GILD","GS","GR","GT","GOOG","GWW","HAL","HOG","HAR","HRS","HIG","HAS","HCP","HCN","HNZ","HP","HES","HPQ","HD","HON","HRL","HSP","HST","HCBK","HUM","HBAN","ITW","TEG","INTC","ICE","IBM","IFF","IGT","IP","IPG","INTU","ISRG","IVZ","IRM","XYL","JBL","JEC","JNS","JDSU","JNJ","JCI","JOYG","JPM","JNPR","K","KEY","KMB","KIM","KLAC","KSS","KFT","KR","LLL","LH","LM","LEG","LEN","LUK","LXK","LIFE","LLY","LTD","LNC","LLTC","LMT","L","LO","LOW","LSI","MTB","M","MRO","MAR","MMC","MI","MAS","ANR","MA","MAT","MKC","MCD","MHP","MCK","MJN","MWV","MHS","MDT","WFR","MRK","MET","PCS","MCHP","MU","MSFT","MOLX","TAP","MON","MWW","MCO","MS","MOS","MMI","MSI","MUR","MYL","NBR","NDAQ","NOV","NTAP","NFLX","NWL","NFX","NEM","NWSA","NEE","GAS","NKE","NI","NE","NBL","JWN","NSC","NTRS","NOC","NU","CMG","NVLS","NRG","NUE","NVDA","NYX","ORLY","OXY","OMC","OKE","ORCL","OI","PCAR","IR","PLL","PH","PDCO","PAYX","BTU","JCP","PBCT","POM","PEP","PKI","PFE","PCG","PM","PNW","PXD","PBI","PCL","PNC","RL","PPG","PPL","PX","PCP","PCLN","PFG","PG","PGN","PGR","PLD","PRU","PEG","PSA","PHM","QEP","PWR","QCOM","DGX","RSH","RRC","RTN","RHT","RF","RSG","RAI","RHI","ROK","COL","ROP","ROST","RDC","R","SWY","SAI","CRM","SNDK","SLE","SCG","SLB","SNI","SEE","SHLD","SRE","SHW","SIAL","SPG","SLM","SJM","SNA","SO","LUV","SWN","SE","S","STJ","SWK","SPLS","SBUX","HOT","STT","SRCL","SYK","SUN","STI","SVU","SYMC","SYY","TROW","TGT","TEL","TE","TLAB","THC","TDC","TER","TSO","TXN","TXT","HSY","TRV","TMO","TIF","TWX","TWC","TIE","TJX","TMK","TSS","TSN","TYC","USB","UNP","UNH","UPS","X","UTX","UNM","URBN","VFC","VLO","VAR","VTR","VRSN","VZ","VIA-B","V","VNO","VMC","WMT","WAG","DIS","WPO","WM","WAT","WPI","WLP","WFC","WDC","WU","WY","WHR","WFM","WMB","WIN","WEC","WYN","WYNN","XEL","XRX","XLNX","XL","YHOO","YUM","ZMH","ZION");

foreach($stockSymbols as $symbol) {
//Grabs previous days close price for current stock symbol
    //$keystats = simplexml_load_file("http://query.yahooapis.com/v1/public/yql?q=use%20%22https://raw.githubusercontent.com/rconley8/stock-comparison-tool/master/yahoo.finance.quotes.xml%22%20as%20keystatistics%3B%20SELECT%20*%20FROM%20keystatistics%20WHERE%20symbol%3D%27" . $stocksymbol . "%27");
    //$prevclose = doubleval($keystats->results->stats->PrevClose);
    //$closeprice = number_format(doubleval($keystats->results->stats->CurrentPrice), 2);
    //$marketValue = $closeprice * $row["numberofshares"];
    //$costBasis = $row["stockprice"] * $row["numberofshares"];
    //$daypricechange = number_format($closeprice - $prevclose, 2);
    //$daypercentchange = number_format(($daypricechange / $prevclose) * 100, 2) . "%";
    //$gainloss = $marketValue - $costBasis;
    //$percentChange = number_format(($gainloss / $costBasis) * 100, 2) . "%";
}

?>