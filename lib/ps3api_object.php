<?php

require_once 'ps3api_config.php';

class Ps3ApiObject {  
    static public function httpRequest($url) {
        $content = null;
        $info = null;
        
        if(Ps3ApiConfig::$useCurl) {
            $curlOpts = Ps3ApiConfig::$curlOpts;
            
            $curl = curl_init($url);
			
			curl_setopt_array($curl, array($curlOpts));
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_USERAGENT, Ps3ApiConfig::$userAgent);
			
			$content = curl_exec($curl);
			$info = curl_getinfo($curl);
			
			curl_close($curl);
        } else {
            $content = @file_get_contents($url);
        }
        
        return array(
            'info' => $info,
            'data' => $content
        );
    }
    
    protected function extractHere($data) {
        foreach($data as $key => $value) {
            $this->$key = $value;
        }
    }
}