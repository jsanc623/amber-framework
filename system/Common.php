<?php

class Common {
	public static function GetPHPVersion(){
		return (string)substr(PHP_VERSION, 0, 3);
	}
	
	public static function recursiveKSort(&$array){
		if(!is_array($array)){
      		return false;
  		}

		ksort($array);
  
  		foreach ($array as $key => $value) {
      		self::recursiveKSort($array[$key]);
  		}
  		return true;
	}
}
