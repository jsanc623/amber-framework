<?php

class Uri {
	private $base;
	public $uri;
	private $params;
	private $segments;
	
	public function __construct(){
		$this->getUrl();
		$this->parseUrl();
	}
	
	public function getHostParts(){
		return $this->uri['host_parts'];
	}
	
	public function getParams(){
		return $this->uri['query_parts'];
	}
	
	public function getBase(){
		return explode("?", $this->uri['full_uri'])[0];
	}
	
	public function getUri(){
		return $this->uri['full_uri'];
	}
	
	private function getUrl(){
		$protocol = "http" . ($_SERVER['HTTPS']=='off'?"":"s") . "://";
		$this->uri = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}
	
	private function parseUrl(){
		$url = parse_url($this->uri);
		$fragment = parse_url($this->uri, PHP_URL_FRAGMENT);

		if($url !== false){
			$url['full_uri'] = $this->uri;
			$url['fragment'] = $fragment;
			
			// list the host_parts
			list($url['host_parts']['subdomain'], 
				 $url['host_parts']['domain'], 
				 $url['host_parts']['tld']) = explode(".", $url['host']);

			// list the path parts
			list($_temp, 
			     $url['path_parts']['controller'], 
			     $url['path_parts']['model']) = explode("/", $url['path']);

			// list the query parts in key=>value mode
			if(isset($url['query'])){
				foreach(explode("&", $url['query']) as $val){
					list($key, $value) = explode("=", $val);
					$_temp[$key] = $value;
				}
				$url['query_parts'] = $_temp;
				unset($_temp);
			} else {
				$url['query_parts'] = null;
			}
			
			// list the fragment parts in key=>value mode
			if(isset($url['fragment'])){
				foreach(explode("&", $url['fragment']) as $val){
					list($key, $value) = explode("=", $val);
					$_temp[$key] = $value;
				}
				$url['fragment_parts'] = $_temp;
				unset($_temp);
			} else {
				$url['fragment_parts'] = null;
			}
		}

		Common::recursiveKSort($url);
		
		$this->uri = $url;
	}
}
