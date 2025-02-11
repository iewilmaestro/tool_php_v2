<?php

class Banner {
	private function ipApi(){
		$r = json_decode(file_get_contents("http://ip-api.com/json"));
		if($r->status == "success")return $r;
	}
	private function Clear(){
		if( PHP_OS_FAMILY == "Linux" ){
			system('clear');
		}else{
			pclose(popen('cls','w'));
		}
	}
	private function Headers(){
		$api = $this->ipApi();
		$this->Clear();
		if($api){
			date_default_timezone_set($api->timezone);
			print str_pad($api->city.', '.$api->regionName.', '.$api->country, 52, " ", STR_PAD_BOTH).n;
		}
		print yh.' '.date("l").'              '.date("d/M/Y").'             '.date("H:i").' '.d."\n";
	}
	private function Footers(){
		print mp.str_pad("FREE SCRIPT NOT FOR SALE", 52, " ", STR_PAD_BOTH).d.n.n;
	}
	public function Banner1($title = 0){
		$this->Headers();
		if($title){
			print p."[".h.strtoupper(nama_file).p."]".n;
		}
		print o2." __________  ____  __     ___  __ _____         ___ \n";
		print o2."/_  __/ __ \/ __ \/ /    / _ \/ // / _ \  _  __|_  |\n";
		print o." / / / /_/ / /_/ / /__  / ___/ _  / ___/ | |/ / __/ \n";
		print y."/_/  \____/\____/____/ /_/  /_//_/_/     |___/____/ \n\n";
		$this->Footers();
	}
	public function Welcome(){
		$this->Headers();
		print o2."  _      ________   _________  __  _______ \n";
		print o2." | | /| / / __/ /  / ___/ __ \/  |/  / __/ \n";
		print o." | |/ |/ / _// /__/ /__/ /_/ / /|_/ / _/  \n";
		print y." |__/|__/___/____/\___/\____/_/  /_/___/  \n\n";
		$this->Footers();
	}
}