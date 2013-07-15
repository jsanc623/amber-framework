<?php

class Error {
	public $divStyle;
	public $h2Style;
	public $pStyle; 
	
	private $number;
	private $string;
	private $line;
	private $file; 
	
	public function __construct(){
		$this->setStyles();
		set_error_handler(array($this, 'ErrorHandler'), E_ALL);
	}
	
	private function setStyles($div = "", $h2 = "", $p = ""){
		$this->divStyle = $div ? $div 
		                  : "background:#FBE6F2; border:1px solid #D893A1; color:#333; margin:10px 5px; padding:10px;";
		$this->h2Style  = $h2 ? $h2 
		                  : "";
		$this->pStyle   = $p ? $p 
		                  : "";
	}
	
	private function buildHTML(){		
		switch($this->number){
			case 256  : $type = "E_USER_ERROR"; break;
			case 512  : $type = "E_USER_WARNING"; break;
			case 1024 : $type = "E_USER_ERROR"; break;
			case $type = "Unknown";
		}
		
		$html = <<< ERROR
		<div class='error' style='{DIV}'>
			<h2 style='{H2}'>Msg: {STRING}<h2>
			<p style="{P}">Error of type $type on line [{LINE}] of {FILE}</p>
		</div>
ERROR;

		$html = 
			str_replace("{DIV}",    $this->divStyle,
			 str_replace("{H2}",     $this->h2Style,
			   str_replace("{STRING}", $this->string,
			    str_replace("{P}",      $this->pStyle,
				 str_replace("{LINE}",   $this->line,
				  str_replace("{FILE}",   $this->file, $html))))));
		return $html;
	}
	
	public function ErrorHandler($error_number, $error_string, $error_file, $error_line, $error_context){
		if(!error_reporting() & $error_number){ return; }
		
		switch($error_number){
			case E_USER_ERROR:
			case E_USER_NOTICE:
			case E_USER_WARNING:
				$this->number = $error_number;
				$this->string = $error_string;
				$this->line = $error_line;
				$this->file = $error_file;
				echo $this->buildHTML();
				break;			
			default:
				echo "<b>An unknown error occurred >> Error: [" . $error_number . "] " . $error_string;
				break;
		}
		die();
	}
}

