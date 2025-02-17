<?php

const
title = "adbch",
versi = "0.0.1",
host = "https://adbch.top/",
refflink = "https://adbch.top/r/110267";

function headers(){
	$h[] = "Host: ".parse_url(host)['host'];
	$h[] = "Upgrade-Insecure-Requests: 1";
	$h[] = "Connection: keep-alive";
	$h[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9";
	$h[] = "user-agent: ".USER_AGENT;
	$h[] = "Referer: https://adbch.top/";
	$h[] = "Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7";
	$h[] = "cookie: ".Functions::Config("cookie");
	return $h;
}
function Dashboard(){
	$r = Requests::get(host."dashboard",headers())[1];
	$user = explode('</b></span>',explode('<span class="white-text">Ваш id: <b>',$r)[1])[0];
	$bal = explode('</b>',explode('Balance<br><b>',$r)[1])[0];
	return ["user"=>$user,"balance"=>$bal];
}

$banner->Banner1(1);
cookie:
Functions::Config("cookie");
$scrap = new HtmlScrap();
$banner->Banner1(1);

$r = Dashboard();
if(!$r["user"]){
	Functions::removeConfig("cookie");
	print Display::Error("Cookie Expired!\n");
	goto cookie;
}
Display::Cetak("Username",$r["user"]);
Display::Cetak("Balance",$r["balance"]);
Display::Line();
while(true){
	$r = Requests::get(host."surf/browse/",headers())[1];
	if(!preg_match("/Skip/",$r)){
		print Display::Error("Ads habis".n);
		Display::Line();
		break;
	}
	$htmlscrap = $scrap->Result($r);
	$data = $htmlscrap['input'];
	$data = http_build_query($data);
	$tmr = explode("'",explode("let duration = '",$r)[1])[0];
	if($tmr){Functions::Tmr($tmr);}
			
	$r = Requests::post(host."surf/browse/",headers(),$data)[1];
	$ss = explode('BCH',explode('You earned ',$r)[1])[0];
	$bal = explode('</b>',explode('class="white-text bal">Баланс: <b>',$r)[1])[0];
	Display::Cetak("Success",$ss);
	$r = Requests::get(host."dashboard",headers())[1];
	$bal = explode('</b>',explode('Balance<br><b>',$r)[1])[0];
	Display::Cetak("Balance",$bal);
	Display::Line();
}