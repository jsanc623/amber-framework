<?php

class LazyLoader{
    public static $dirRoot;
 
    public static function autoload($class_name){
    	$exploded = explode("\\", $class_name);
		$file = dirname(__FILE__) . 
		        (strlen(self::$dirRoot) > 0 ? self::$dirRoot : "") . 
		        '/' . array_pop($exploded) . '.php';

		file_exists($file) ? require_once($file) : "";
    }

	public static function SetBaseDirectory($directory_root){
		self::$dirRoot = substr($directory_root, -1) == "\\" ? 
		                 substr($directory_root, 0, -1) : "";
	}

	public static function Register(){
		return spl_autoload_register(__NAMESPACE__ .'\LazyLoader::autoload');
	}
}
 
$LazyLoader = new LazyLoader;
$LazyLoader->SetBaseDirectory($config['paths']['basepath']);
$LazyLoader->Register();

