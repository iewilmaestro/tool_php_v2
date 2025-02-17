<?php

class FreeCaptcha {
	static function Icon_Hash($header, $req = host.'system/libs/captcha/request.php'){
		$data["method"] = "icon_hash";
		$head = array_merge($header, ["X-Requested-With: XMLHttpRequest"]);
		$getCap = json_decode(Requests::post($req,$head,"cID=0&rT=1&tM=light")[1],1);
		$head2 = array_merge($header, ["accept: image/avif,image/webp,image/apng,image/svg+xml,image/*,*/*;q=0.8"]);
		foreach($getCap as $c){
			$data[$c] = base64_encode(Requests::get($req.'?cid=0&hash='.$c, $head2)[1]);
		}
		$data = http_build_query($data);
		$cap = json_decode(Requests::post("https://iewilbot.my.id/res.php",0,$data)[1],1);
		if(!$cap['status'])return 0;
		Requests::postXskip($req,$head,"cID=0&pC=".$cap['result']."&rT=2");
		return $cap['result'];
	}
}
