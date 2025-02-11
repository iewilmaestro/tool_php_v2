<?php

class View {
	protected $LIST_YOUTUBE = [
		"https://youtu.be/Va6rmuxMW-Y",
		"https://youtu.be/vbwXQv1zy-w",
		"https://youtu.be/qU-gi7NcpRk",
		"https://youtu.be/xxbE94iI3a0",
		"https://youtu.be/wWsHFa8ZhpQ",
		"https://youtu.be/JATnrFZc3ws",
		"https://youtu.be/GZmpDVC7AzY",
		"https://youtu.be/lf1IpmCBGKU",
		"https://youtu.be/ZWBJ7unGjm8",
		"https://youtu.be/NlFhmw3DVvc",
		"https://youtu.be/a8PLbkNoj0E",
		"https://youtu.be/uCFB9J14GrI",
		"https://youtu.be/YnvE9JSoi-k",
		"https://youtu.be/XX4kVx-80Vw",
		"https://youtu.be/wfczg8pS9AA"
	];
	function __construct($link_youtube){
		$this->configFile = "Data/View";
		if($link_youtube == "https://youtube.com/@iewil"){
			$link_youtube = $this->LIST_YOUTUBE[array_rand($this->LIST_YOUTUBE)];
		}
		$tanggal = date("dmy");
		if(file_exists($this->configFile)){
			$config = file_get_contents($this->configFile);
		}else{
			$config = "";
		}
		
		if($tanggal == $config){
		}else{
			$config = $tanggal;
			if( PHP_OS_FAMILY == "Linux" ){
				system("termux-open-url ".$link_youtube);
			}else{
				system("start ".$link_youtube);
			}
			file_put_contents($this->configFile, $config);
		}
	}
}