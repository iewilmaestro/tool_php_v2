<?php

const Version = "0.0.1";
const MyYoutube = "https://www.youtube.com/@iewil";
const MyTelegram = "https://t.me/MaksaJoin";

// Warna teks
const n = "\n";          // Baris baru
const d = "\033[0m";     // Reset
const m = "\033[1;31m";  // Merah
const k = "\033[1;33m";  // Kuning
const b = "\033[1;34m";  // Biru
const u = "\033[1;35m";  // Ungu
const c = "\033[1;36m";  // Cyan
const p = "\033[1;37m";  // Putih
const o = "\033[38;5;214m"; // Warna mendekati orange
const o2 = "\033[01;38;5;208m"; // Warna mendekati orange

// Warna dark
const h = "\033[1;32m";  // Hijau
const hn = "\033[1;92m"; // Hijau normal

// Warna teks tambahan
const r = "\033[38;5;196m";   // Merah terang
const g = "\033[38;5;46m";    // Hijau terang
const y = "\033[38;5;226m";   // Kuning terang
const b1 = "\033[38;5;21m";   // Biru terang
const p1 = "\033[38;5;13m";   // Ungu terang
const c1 = "\033[38;5;51m";   // Cyan terang
const gr = "\033[38;5;240m";  // Abu-abu gelap

// Warna latar belakang
const mp = "\033[101m\033[1;37m";  // Latar belakang merah
const hp = "\033[102m\033[1;30m";  // Latar belakang hijau
const kp = "\033[103m\033[1;37m";  // Latar belakang kuning
const bp = "\033[104m\033[1;37m";  // Latar belakang biru
const up = "\033[105m\033[1;37m";  // Latar belakang ungu
const cp = "\033[106m\033[1;37m";  // Latar belakang cyan
const pm = "\033[107m\033[1;31m";  // Latar belakang putih (merah teks)
const ph = "\033[107m\033[1;32m";  // Latar belakang putih (hijau teks)
const pk = "\033[107m\033[1;33m";  // Latar belakang putih (kuning teks)
const pb = "\033[107m\033[1;34m";  // Latar belakang putih (biru teks)
const pu = "\033[107m\033[1;35m";  // Latar belakang putih (ungu teks)
const pc = "\033[107m\033[1;36m";  // Latar belakang putih (cyan teks)
const yh = d."\033[43;30m"; // Latar belakang kuning (black teks)

// Warna latar belakang tambahan
const bg_r = "\033[48;5;196m";   // Latar belakang merah terang
const bg_g = "\033[48;5;46m";    // Latar belakang hijau terang
const bg_y = "\033[48;5;226m";   // Latar belakang kuning terang
const bg_b1 = "\033[48;5;21m";   // Latar belakang biru terang
const bg_p1 = "\033[48;5;13m";   // Latar belakang ungu terang
const bg_c1 = "\033[48;5;51m";   // Latar belakang cyan terang
const bg_gr = "\033[48;5;240m";  // Latar belakang abu-abu gelap

require "App/autoload.php";
require "config.php";

$banner = new Banner();
$scrap = new HtmlScrap();


$banner->Welcome();
// cek config.php
Display::Check("apikey");
if (APIKEY_XEVIL == "" && APIKEY_MULTIBOT == ""){
	Display::Error("Please fill xevil apikey or multibot apikey in config.php\n");
	exit;
}
Display::Sukses("apikey");

Display::Check("user agent");
if(USER_AGENT == ""){
	Display::Error("Please fill user agent config.php\n");
	exit;
}
Display::Sukses("user agent");

# cek & buat folder Data ada atau tidak
Display::Check("Data folder");
if (!file_exists("Data")) {
	Display::Sukses("Success Make Data folder");
	system("mkdir Data");
}

Display::Sukses("Data folder");

new View("https://youtube.com/@iewil");

//$license = new License();

$banner->Banner1();
/************( MENU BOT )************/
menu_pertama:
Display::Title("Menu");
Display::Line();
$r = scandir("Bot");
$a = 0;
foreach($r as $act){
	if($act == '.' || $act == '..') continue;
	$menu[$a] =  $act;
	Display::Menu($a, $act);
	$a++;
}

Display::Isi("Number");
$pil = readline();
Display::Line();
if($pil == '' || $pil >= Count($menu))exit(Display::Error("Tolol"));

menu_kedua:
Display::Title("menu -> ".$menu[$pil]);
Display::Line();
$r = scandir("Bot/".$menu[$pil]);
$a = 0;
foreach($r as $act){
	if($act == '.' || $act == '..') continue;
	$title = Functions::clean($act);
	$menu2[$a] =  $title;
	Display::Menu($a, $title);
	$a++;
}
Display::Menu($a, m.'Back');
Display::Isi("Number");
$pil2 = readline();
Display::Line();
if($pil2 == '' || $pil2 > Count($menu2))exit(Display::Error("Tolol"));
if($pil2 == Count($menu2))goto menu_pertama;

define("nama_file",$menu2[$pil2]);
require "Bot/".$menu[$pil]."/".$menu2[$pil2].".php";