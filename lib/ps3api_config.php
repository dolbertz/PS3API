<?php

class Ps3ApiConfig {
    static public $userAgent = 'Ps3Api v0.1 [%s]';
    
    static public $serverUrl = '';
    
    static public $apiEndpoint = 'ps3heroes.com/api';
    
    /**
     * Will automatically downgrade to file_get_contents() when curl
     * is not available. But if set to false, will always use
     * file_get_contents
     */
    static public $useCurl = true;
    
    static public $curlOpts = array(
	    CURLOPT_FOLLOWLOCATION => true,
	    CURLOPT_MAXREDIRS => 3,
	    CURLOPT_FAILONERROR => true
	);
}