<?php

class Functions {
	static function Tmr($tmr){
		date_default_timezone_set("UTC");
		$sym = [' ─ ',' / ',' │ ',' \ ',];
		$timr = time()+$tmr;
		$a = 0;
		while(true){
			$a +=1;
			$res=$timr-time();
			if($res < 1) {
				break;
			}
			print $sym[$a % 4].p.date('H',$res).":".p.date('i',$res).":".p.date('s',$res)."\r";usleep(100000);
		}
		print "\r           \r";
	}
	static function Config($nama_data){
		if(file_exists("Data/".nama_file."/".$nama_data)){
			$data = file_get_contents("Data/".nama_file."/".$nama_data);
		}else{
			Display::Cetak("Register",refflink);
			Display::Line();
			if(!file_exists("Data/".nama_file)){
				system("mkdir ".nama_file);
				if(PHP_OS_FAMILY == "Windows"){
					system("move ".nama_file." Data");
				}else{
					system("mv ".nama_file." Data");
				}
				print Display::Sukses("Berhasil membuat Folder untuk ".k.nama_file.n);
			}
			print Display::Isi($nama_data);
			$data = readline();echo "\n";
			file_put_contents("Data/".nama_file."/".$nama_data,$data);
		}
		return $data;
	}
	static function removeConfig($nama_data){
		unlink("Data/".nama_file."/".$nama_data);
		print Display::Sukses("Berhasil menghapus ".$nama_data." dari ".nama_file);
	}
	static function clean($string)
	{
		return str_replace(".php", "", $string);
	}
	static function temporary($newdata,$data=0){if(!$data){$data = [];}return array_merge($data,$newdata);}
	static function cfDecodeEmail($encodedString){$k = hexdec(substr($encodedString,0,2));for($i=2,$email='';$i<strlen($encodedString)-1;$i+=2){$email.=chr(hexdec(substr($encodedString,$i,2))^$k);}return $email;}
	static function getConfig($key){if(!file_exists($this->$configFile)){$config = [];}else{$config = json_decode(file_get_contents($this->$configFile),1);}return $config[$key];}
}