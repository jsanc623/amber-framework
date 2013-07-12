<?php

class Error {
	public function __construct(){
		echo set_error_handler(array($this, 'ErrorHandler'), E_ALL);
	}
	
	private function ErrorHandler($error_number, $error_string, $error_file, $error_line, $error_context){
		if(!error_reporting() & $error_number){
			return;
		}
		
		switch($error_number){
			case E_USER_ERROR:
				echo "<div class='error'>";
				echo "<h2>[" . $error_number . "] " . $error_string . "<h2>";
				echo "<p>Fatal error on line [" . $error_line . "] of " . $error_file . "</p>";
				echo "</div>";
				
			case E_USER_WARNING:
				echo "<b>WARNING</b> [" . $error_number . "] " . $error_string;
				break;
				
			case E_USER_NOTICE:
				echo "<b>NOTICE</b> [" . $error_number . "] " . $error_string;
				break;
			
			default:
				echo "<b>An unknown error occurred >> Error: [" . $error_number . "] " . $error_string;
				break;
		}
	}
}

