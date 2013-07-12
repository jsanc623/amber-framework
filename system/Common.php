<?php

class Common {
	public static function GetPHPVersion(){
		return (string)substr(PHP_VERSION, 0, 3);
	}
}
