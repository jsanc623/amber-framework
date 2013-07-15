<?php

class Uri {
	private $base;
	private $uri;
	private $params;
	private $segments;
	
	public function __construct(){
		$this->getUrl();
	}
	
	public function getSegments(){
		return $this->segments;
	}
	
	public function getParams(){
		return $this->params;
	}
	
	public function getSegment($segNum){
		foreach($this->segments as $key => $value){
			if($segNum == $key){
				return array($key, $value);
			}
		}
	}
	
	public function getParam($paramName){
		foreach($this->params as $key => $value){
			if($paramName == $key){
				return array($key, $value);
			}
		}
	}
	
	public function getBase(){
		return $this->base;
	}
	
	public function getUri(){
		return $this->uri;
	}
	
	private function getUrl(){
		$this->uri = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}
	
	private function parseUrl(){
		
	}
}
