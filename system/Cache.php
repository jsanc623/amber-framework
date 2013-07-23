<?php

class Cache{
    private $req_path;
    private $filename;
    private $passes;
    
	public function __construct($request_path){
	    $this->req_path = $request_path;
        if($this->IsCached() == true){
            $this->OutputCache();
        } else {
            $this->CheckAge();
            $this->IsCachable();
            $this->FilenameGenerator();
            $this->OutputCache();
        }
	}
    
    private function OutputCache(){
        
    }
    
    public function IsCached(){
        
    }
    
    public function InvalidateCache(){
        
    }
    
    private function IsCachable(){
        
    }
    
    public function CheckAge(){
        
    }
    
    private function SetAge(){
        $age = time();
    }

    private function CurrentTime(){
        
    }
    
    private function FilenameGenerator(){
        
    }
} 
