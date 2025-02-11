<?php

class Display {
	static function Check($str)
	{
		print k."check ".$str;
		sleep(2);
		print "\r                             \r";
	}
	
	static function Menu($no, $title){print h."---[".p."$no".h."] ".k."$title\n";}
	static function Cetak($label, $msg = "[No Content]"){$len = 9;$lenstr = $len-strlen($label);print h."[".p.$label.h.str_repeat(" ",$lenstr)."]─> ".p.$msg.n;}
	static function Title($activitas){print bp.str_pad(strtoupper($activitas),52, " ", STR_PAD_BOTH).d.n;}
	static function Line($len = 52){print c.str_repeat('─',$len).n;}
	static function Error($except){print m."---[".p."!".m."] ".p.$except;}
	static function Sukses($msg){print h."---[".p."✓".h."] ".p.$msg.n;}
	static function Isi($msg){print m."╭[".p."Input ".$msg.m."]".n.m."╰> ".h;}
}