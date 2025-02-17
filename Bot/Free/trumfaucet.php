<?php

const
title = "trumpfaucet",
versi = "0.0.1",
host = "https://trumpfaucet.com/",
refflink = "https://trumpfaucet.com/dashboard/signup?ref=5560";

function headers($data=0){
	$h[] = "Host: ".parse_url(host)['host'];
	if($data)$h[] = "Content-Length: ".strlen($data);
	$h[] = "User-Agent: ".USER_AGENT;
	$h[] = "Cookie: ".Functions::Config("cookie");
	return $h;
}
function Dashboard(){
	$r = Requests::get(host,headers())[1];
	$user = explode('</b>',explode('Welcome Back! <b>', $r)[1])[0];
	$balance = trim(explode('</h5>', explode('<h5 class="font-weight-bolder mb-0">', $r)[1])[0]);
	return ['Username'=> $user,'Balance' => $balance];
}
function Claim(){
	$r = Requests::get(host."dashboard/claim",headers())[1];
	$ready = trim(explode('</h6>',explode('<h6 class="font-weight-bolder mb-0 seconds">' , $r)[1])[0]);
	if($ready == "You Can Claim"){
		$cap = FreeCaptcha::Icon_Hash(headers(), host.'src/captcha-request.php');
		if(!$cap)return;
	}else{
		$minutes = explode(':', $ready)[0];
		$seconds = explode(':', $ready)[1];
		$timer = $minutes*60+$seconds;
		Functions::Tmr($timer);
		return;
	}
	$data = "captcha-hf=$cap&captcha-idhf=0&claim=";
	$r = Requests::post(host.'dashboard/claim', headers(), $data)[1];
}

$banner->Banner1(1);
cookie:
Functions::Config("cookie");
$scrap = new HtmlScrap();
$banner->Banner1(1);

$r = Dashboard();
if(!$r['Username']){
	Functions::removeConfig("cookie");
	print Display::Error("Cookie Expired\n");
	Display::Line();
	goto cookie;
}
Display::Cetak('Username', $r['Username']);
Display::Cetak('Balance', $r['Balance']);
Display::Line();
while(true){
	$balance = $r['Balance'];
	if(Claim()){
		Functions::removeConfig("cookie");
		goto cookie;
	}
	$r = Dashboard();
	if($r['Balance'] == $balance){
		
	}else{
		Display::Cetak('Balance', $r['Balance']);
		Display::Line();
	}
}
