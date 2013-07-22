#!/usr/bin/env php
<?php

require_once("config.php");

/**
 * Amber PHP Framework: Resin CLI Application
 * 
 *> NAME
 *>      Resin - Amber PHP Framework CLI Application
 *> 
 *> SYNOPSIS
 *>      php resin.php [OPTION]... FILE...
 *> 
 *> DESCRIPTION
 *>      Resin provides a number of helpful commands for your use while developing your Amber application.
 *> 
 *>      Mandatory arguments to long options are mandatory for short options too.
 *>            
 *>      -l 
 *>              List all Resin commands
 *> 
 *>      -n [NAME]
 *>              Create a new application
 * 
 */

class CreateApp{
	private $argc;
	private $argv;
    private $options;
    private $arguments;
    private $config;

    public function __construct($config){
		# Die if not in CLI
		if(PHP_SAPI != "cli"){
    		die();
		}
		
        $this->config = $config;
		$this->argc = $_SERVER['argc'];
		$this->argv = $_SERVER['argv'];

        $this->Start();
        $this->BuildArgumentOptions();
        $this->ParseArguments();
        $this->Fossilize();
        $this->End();
    }
    
    private function Start(){
        echo "\nResin: Amber PHP Framework CLI Application\n\n";
    }
    
    private function End(){
        echo "\n\n";
        exit;
    }
    
    private function Fossilize(){
        foreach($this->arguments as $key => $value){
            switch(strtolower($key)){
                case "l" : $this->ListCommands();
                    break;
                case "n" : $this->NewApplication($value);
                    break;
                case "v" : $this->Version();
                    break;
            }
        }
    }
    
    private function BuildArgumentOptions(){
        $this->options .= "l::v::n::";
    }
    
    private function ParseArguments(){
        $this->arguments = getopt($this->options);
    }

	private function ListCommands(){
        echo $this->FileParse($_SERVER['PHP_SELF'], array("*>"), "", "*> ", 75); 
	}
    
    private function Version(){
        echo "Resin v" . $this->FileParse("index.php", array("* v[", "];", " "), "", "v[", 4, 64);
    }
    
    private function NewApplication($name){
        if(strlen($name) == 0){
            echo "Error: -n requires application name.";
            return;
        } else {
            $base = "." . DIRECTORY_SEPARATOR . $this->config['application_directory'] . DIRECTORY_SEPARATOR ;
            $dirs[0][] = $base . $name;
            $dirs[0][] = $dirs[0][0] . DIRECTORY_SEPARATOR . "css";
            $dirs[1][] = $dirs[0][0] . DIRECTORY_SEPARATOR . "css" . DIRECTORY_SEPARATOR . "style.css"; 
            $dirs[0][] = $dirs[0][0] . DIRECTORY_SEPARATOR . "js";
            $dirs[1][] = $dirs[0][0] . DIRECTORY_SEPARATOR . "js" . DIRECTORY_SEPARATOR . "script.js"; 
            $dirs[0][] = $dirs[0][0] . DIRECTORY_SEPARATOR . "templates";
            $dirs[1][] = $dirs[0][0] . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "index.tpl"; 
            
            foreach($dirs[0] as $directory){
                if(@mkdir($directory) == false){
                    die("Application already exists. Please delete before overwriting.\n\n");
                }
            }
            
            foreach($dirs[1] as $file){
                $handle = fopen($file, 'w') or die("Could not create file. Please check permissions and try again.\n\n");
                fclose($handle);
            }
        }
    }
    
    private function FileParse($file, $replace, $replaceWith, $strposHook, $lineCount, $fgetLen = 1024){
        $output = "";
        $handle = fopen($file, 'r');
        $count = $lineCount;
        if($handle){
            while (($buffer = fgets($handle, $fgetLen)) !== false && $count != 0) {
                if(strpos($buffer, $strposHook)){
                    $output .= str_replace($replace, $replaceWith, $buffer);
                }
                $count--;
            }
        }
        fclose($handle);
        return $output;
    }
}

$CreateApp = new CreateApp($config);