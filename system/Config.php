<?php

class Config {
	public function __construct(){
		
	}
	
	public function ListConfig(){
		foreach ($config as $key => $value) {
			$output[] = array($key, $value);
		}
		return $output;
	}
}
