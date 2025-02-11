<?php
spl_autoload_register(function($class){
	
	$dirs = [
		'Captcha',
		'Modul'
		];
	
	$class = explode('\\', $class);
	$class = end($class);
	foreach ($dirs as $dir) {
		if($dir == '.' || $dir == '..') continue;
		if(file_exists("App/$dir/$class.php")){
			require_once "App/$dir/$class.php";
			return;
		}
	}
});